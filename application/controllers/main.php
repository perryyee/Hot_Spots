<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	protected $view_data = array();
	protected $user_session = NULL;

	function __construct() 
	{
		parent::__construct();
		$this->user_session = $this->session->userdata('user_session');
	}

	function index()
	{	
		$this->load->view('login');
	}

	function heatmap() 
	{	
		if ($this->is_login())
        {
			$checkins = $this->get_feed_data();
			$markers = $this->get_markers();
			$heat_points = $this->get_points();

			$data = array(
				'feed' => $checkins,
				'markers' => $markers,
				'heat_points' => $heat_points,
				'page' => 'heatmap',
				'title' => 'HotSpots | Heatmap'
			);
	        $this->load->view('header', $data);
	        $this->load->view('heatmap');
    	}
        else
        {
            redirect(base_url());
        }
	}

	function topspots() 
	{
		if ($this->is_login())
        {
			$data['page'] = 'modal';
			$data['title'] = 'HotSpots | TopSpots';
	        $this->load->view('header', $data);
	        $this->load->view('topspots');
        }
        else
        {
            redirect(base_url());
        }
	}

	protected function is_login()
	{
		if(isset($this->user_session['logged_in']))
			return TRUE;
		else
			return FALSE;
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		session_destroy();
		redirect(base_url());
	}

	function get_feed_data()
    {
        $this->load->model('checkin');
        $checkins = NULL;
        if(isset($this->session->userdata['user_session']['facebookuser_id']))
        {
            $checkins = $this->checkin->get_feed_checkins($this->session->userdata['user_session']['facebookuser_id']);
        }
        $html='';

       	foreach($checkins as $checkin)
       	{
       		if (isset($checkin['website'])) {
       			$website = preg_split('~[ |;]~', $checkin['website'])[0];
       			if ($website[0]!='h')
       			{
       				$website = 'http://'.$website;
       			}
       		}
       		else 
       		{
       			$website = "http://www.facebook.com/{$checkin['place_id']}";
       		}
       		$html .=   "<div class='feed_data list-group-item'>
							<div class='col-lg-3 no-margins'>
								<img class='thumb' src='/assets/images/facebook.png' alt='FB'>
							</div>
							<div class='col-lg-8 col-lg-offset-4 no-margins'>
								<p class='live_feed'>
									<a href='http://www.facebook.com/{$checkin['author_id']}'><strong>{$checkin['author_name']}</strong></a> 
									has just checked into 
									<a href='$website'>{$checkin['place_name']}</a> 
									via Facebook.
								</p>";
			if ($checkin['time_diff']>518400) 
			{
				$html .= '		<span class="duration">1 week ago.</span>';
			}
			else if(floor($checkin['time_diff']/86400)>=1)
			{
				$diff = floor($checkin["time_diff"]/86400);
				$html .= '		<span class="duration">'.$diff.' day(s) ago.</span>';
			}
			else if(floor($checkin['time_diff']/3600)>=1)
			{
				$diff = floor($checkin["time_diff"]/3600);
				$html .= '		<span class="duration">'.$diff.' hour(s) ago.</span>';
			}
			else if(floor($checkin['time_diff']/60)>=1)
			{
				$diff = floor($checkin["time_diff"]/60);
				$html .= '		<span class="duration">'.$diff.' minute(s) ago.</span>';
			}
			else
			{
				$html .= '		<span class="duration">'.$checkin["time_diff"].' second(s) ago.</span>';
			}
			$html.="		</div>
						</div>";
       	}
       		$html.="	<div class='feed_data list-group-item'>
       						<a href='javascript:;'><h4 class='text-center'>See All Activity...</h4></a>
       					</div>";
       	return $html;
    }
    function get_markers() 
    {
    	$this->load->model('checkin');
        $checkins = NULL;
        $info = NULL;
        $array=array();
        
        if(isset($this->session->userdata['user_session']['facebookuser_id']))
        {
            $checkins = $this->checkin->get_map_checkins();
        }
        for($i=0; $i<count($checkins); $i++)
        {	
        	if (isset($checkins[$i]['website'])) {
       			$website = preg_split('~[ |;]~', $checkins[$i]['website'])[0];
       			if ($website[0]!='h')
       			{
       				$website = 'http://'.$website;
       			}
       		}
   			else 
   			{
   				$website = "http://www.facebook.com/{$checkins[$i]['id']}";
   			}
        	$info = "<div>
        				<h3 class='text-center'>{$checkins[$i]['place_name']}</h3>
        				<p>{$checkins[$i]['category']}</p>
        				<a href='$website'>$website</a>
        				<p>{$checkins[$i]['city']}, {$checkins[$i]['state']} {$checkins[$i]['country']}</p>
        				<p>
	        				<strong>Checkins:</strong> {$checkins[$i]['checkins']}<br/>
	        				<strong>Were Here:</strong> {$checkins[$i]['were_here_count']}<br/>
	        				<strong>Talking About:</strong> {$checkins[$i]['talking_about_count']}<br/>
        				</p>
        			</div>";
        	$y = $i +1;
        	$place_name = addslashes($checkins[$i]['place_name']);
        	$array[] = [$place_name, $checkins[$i]['latitude'], $checkins[$i]['longitude'], $y, $info];
        }
        return json_encode($array);
    }

    function get_points() 
    {
    	$this->load->model('checkin');
    	$points = array();
        $checkins = NULL;
        
        if(isset($this->session->userdata['user_session']['facebookuser_id']))
        {
            $checkins = $this->checkin->get_map_checkins();
        }
        foreach($checkins as $checkin)
        {	
        	$points[] = "new google.maps.LatLng({$checkin['latitude']}, {$checkin['longitude']})";
        }
        return json_encode($points);
    }

    function process_heatmap() 
    {
    	$this->session->set_userdata('address', $this->input->post('address'));
    	redirect(base_url('heatmap'));
    }
}

/* end of file */