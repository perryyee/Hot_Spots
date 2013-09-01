<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("main.php");

class Checkins extends Main {

    function index() {
        redirect(base_url('/topspots');
    }
    function add_checkins() {
        //set session data first_time as FALSE
        $this->load->model('checkin');
        $checkins = $this->checkin->retrieve_checkins($session_fb_id);
        redirect(base_url('/topspots'));
    }


}
/* End of file checkins.php */
/* Location: ./application/controllers/checkins.php */