<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("main.php");

class Users extends Main {

    function index() {
        $this->login();
    }
    function login() {
        $this->load->view('login');
    }
    function register() 
    {
        $this->load->view('register');
    }
    function edit() 
    {
        if ($this->is_login())
        {
            $data['page'] = 'modal';
            $data['title'] = 'HotSpots | Edit User Information';
            $this->load->view('header', $data);
            $this->load->view('edit');
        }
        else
        {
            redirect(base_url());
        }
    }
    function process_register()
    {
        $user_details = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'confirm_password' => $this->input->post('confirm_pass')
        );
        $this->load->model('user');

        //register either returns errors(true) or null(false)
        if ($this->user->register($user_details))
        {
            $this->session->set_flashdata('errors', $this->user->register($user_details));
            redirect(base_url('register'));
        }
        else
        { 
            $this->session->set_flashdata('message', 'Thank You for Registering');
            redirect(base_url('register'));
        }
    }
    function process_login()
    {
        $user_details = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );
        $this->load->model('user');
        $user = $this->user->login($user_details);

        if ($user)
        {
            $user_details = array(
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'username' => $user->username,
                'facebookuser_id' => $user->facebookuser_id,
                'logged_in' => TRUE
            );
            $this->session->set_userdata('user_session', $user_details);
            $this->session->set_userdata('first_time', FALSE);
            $this->session->set_userdata('account', 'default');
            $this->session->set_userdata('address', 'San Francisco, CA');
            redirect( base_url('topspots'));
        }
        else
        {
            $this->session->set_flashdata('errors', 'Invalid Username/Password Combination.' );
            redirect(base_url());
        }

    }
    function process_edit() 
    {

    }
    function facebook_request() 
    {
        $this->load->library('fbconnect');
        $data = array(
            'redirect_uri' => site_url('users/handle_facebook_login'),
            'scope' => 'email, friends_checkins'
        );
        redirect($this->fbconnect->getLoginURL($data));
    }
    //for some reason this function only correctly sets $first_time on first facebook login when persmissions are asked
    function handle_facebook_login() 
    {
        $this->load->library('fbconnect');
        $this->load->model('user');
        $this->load->model('facebookuser');

        $new_user = $this->fbconnect->user;

        if($this->fbconnect->user) 
        {
            $first_time = FALSE;
            if($this->user->is_member($new_user))
            {
                echo '1';
                //check last update before adding checkins
                if (!$this->facebookuser->is_fbmember($new_user))
                {
                    echo '2';
                    $this->facebookuser->register($new_user);
                    $first_time = 1;
                }
            //check twitter account

            }
            else
            {
                echo '3';
                if (!$this->facebookuser->is_fbmember($new_user)) 
                {
                    echo '4';
                    $first_time = 1;
                    $this->facebookuser->register($new_user);
                }
            }
            $this->user->fb_register($new_user);
            $this->fbconnect->FQL_checkin($new_user);
            //login with fb credentials (add to session)

            $user = $this->user->get_user($new_user);
            $user_details = array(
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'username' => $user->username,
                'facebookuser_id' => $user->facebookuser_id,
                'logged_in' => TRUE,
            );
            $this->session->set_userdata('user_session', $user_details);
            $this->session->set_userdata('account', 'facebook');
            $this->session->set_userdata('address', 'San Francisco, CA');
            $this->session->set_userdata('first_time', $first_time);
            //var_dump($this->session->userdata);
            redirect(base_url('topspots'));
        }
        else
        {
            echo 'could not login at the time';
        }
    }


}
/* End of file users.php */
/* Location: ./application/controllers/users.php */