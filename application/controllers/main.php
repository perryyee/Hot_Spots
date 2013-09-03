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
}

/* end of file */