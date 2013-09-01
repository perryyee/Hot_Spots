<?php

class User extends DataMapper {

    var $created_field = 'created_at';
    var $updated_field = 'updated_at';

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

    var $validation = array(
        'first_name' => array(
            'label' => 'First name',
            'rules' => array('required', 'trim', 'alpha_dash', 'min_length' => 1, 'max_length' => 15),
        ),
        'last_name' => array(
            'label' => 'Last Name',
            'rules' => array('required', 'trim', 'alpha_dash', 'min_length' => 1, 'max_length' => 15),
        ),
        'email' => array(
            'label' => 'Email Address',
            'rules' => array('required', 'trim', 'valid_email')
        ),
        'username' => array(
            'label' => 'Username',
            'rules' => array('required', 'alpha_numeric', 'unique', 'min_length' => 3),
        ),
        'password' => array(
            'label' => 'Password',
            'rules' => array('required', 'min_length' => 6, 'encrypt'),
        ),
        'confirm_password' => array(
            'label' => 'Confirm Password',
            'rules' => array('required', 'encrypt', 'matches' => 'password'),
        )
    );

    function login($user_details)
    {
        $user = new User();
        $user->where('username', $user_details['username'])->get();
        
        
        $this->username = $user_details['username'];
        $this->password = $user_details['password'];
        $this->salt = $user->salt;
        $user = $this->validate()->get();

        if (empty($this->id))
        {
            return FALSE;
        }
        else
        {
            return $user;
        }
    }
    function register($user_details)
    {
        foreach($user_details as $key => $value)
        {
            $this->$key = $value;
        }

        if ($this->save())
        {
            return NULL;
        }
        else
        { 
            return $this->error->string;
        }
    }
    function edit() {

    }
    function get_user($user) {
        return $this->where('id', $user['id'])->get();
    }
    function is_member($facebook_user)
    {
        $this->where('email', $facebook_user['email'])->get();
        if ($this->id)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function fb_register($user)
    {
        if (!$this->is_member($user))
        {
            $this->facebookuser_id =  $user['id'];
            $this->first_name =  $user['first_name'];
            $this->last_name =  $user['last_name'];
            $this->email =  $user['email'];

            $this->skip_validation()->save();   
        }
        else 
        {
            $this->where('email', $user['email'])->update('facebookuser_id', $user['id']);
        }
    }

    // function twitter_register($user)
    // {   

    // }
    // function instagram_register($user)
    // {   

    // }

    function _encrypt($field)
    {   
        if (!empty($this->{$field}))
        {
            if (empty($this->salt))
            {
                $this->salt = md5(uniqid(rand(), true));
            }
            $this->{$field} = sha1($this->salt . $this->{$field});
        }
    }
}

/* End of file user.php */
/* Location: ./application/models/user.php */