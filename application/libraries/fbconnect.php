<?php 

include (APPPATH.'libraries/facebook/facebook.php');

class Fbconnect extends Facebook{

	public $user = null;
	public $user_id = null;
	public $fb = false;
	public $fbSession = false;
	public $appkey = 0;

	function FbConnect() 
	{
		$ci =& get_instance();
		$ci->config->load('facebook', TRUE);
		
		$config = $ci->config->item('facebook');
		//returns value in array form from config file
		parent::__construct($config);

		$this->user_id = $this->getUser();
		$me = null;
		if ($this->user_id)
		{
			try 
			{
				$me = $this->api('/me');
				$this->user = $me;
			}
			catch (FacebookApiException $e)
			{
				error_log(e);
			}
		}
	}
	function FQL_checkin($facebook_user) 
	{
		$ci =& get_instance();
		$ci->config->load('facebook', TRUE);
        //calculates one week ago from now
        $time = time() - 604800;
        $params = array(
        	'method' => 'fql.query',
        	'query' => "SELECT checkin_id, author_uid, coords, timestamp FROM checkin WHERE author_uid IN (SELECT uid2 FROM friend WHERE uid1 = {$facebook_user['id']}) AND timestamp > $time",
        );
        $results = $this->api($params);
        
        $new_checkin = new Checkin();
        $new_checkin->save_checkins($facebook_user['id'], $results);
	}
}

/* End of file fbconnect.php */
/* Location: ./application/libraries/fbconnect.php */