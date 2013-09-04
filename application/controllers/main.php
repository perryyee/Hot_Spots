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
		$checkins = $this->get_feed_data();
		$data['feed'] = $checkins;
		$data['page'] = 'heatmap';	
		$data['title'] = 'HotSpots | Heatmap';
        $this->load->view('header', $data);
        $this->load->view('heatmap');
	}

	function topspots() 
	{
		$data['page'] = 'topspots';
		$data['title'] = 'HotSpots | TopSpots';
        $this->load->view('header', $data);
        $this->load->view('topspots');
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
       		}
       		$html .=   "<div class='feed_data list-group-item'>
							<div class='col-lg-3 no-margins'>
								<img class='thumb' src='/assets/images/facebook.png' alt='FB'>
							</div>
							<div class='col-lg-8 col-lg-offset-4 no-margins'>
								<p class='live_feed'>
									<a href='www.facebook.com/'{$checkin['author_id']}'><strong>{$checkin['author_name']}</strong></a> 
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
    function process_heatmap() {
    	redirect('heatmap');
    }
}

/* end of file */