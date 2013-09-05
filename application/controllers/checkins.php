<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("main.php");

class Checkins extends Main {

    function index() {
        redirect(base_url('/topspots'));
    }
    function add_checkins() {
        $this->load->library('fbconnect');
        $this->session->set_userdata('completion', TRUE);
        $this->load->model('checkin');
        
        $checkins = $this->checkin->retrieve_checkin_ids($this->session->userdata['user_session']['facebookuser_id']);
        $this->checkin->add_checkins($checkins);
        
        $outcome = 'Success';
        $data['outcome'] = $outcome; 
        echo json_encode($data);
    }
}
/* End of file checkins.php */
/* Location: ./application/controllers/checkins.php */