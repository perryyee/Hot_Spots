<?php

class Facebookuser extends DataMapper {

    var $has_one = array('user');
    var $created_field = 'created_at';
    var $updated_field = 'updated_at';

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

    function register($facebook_user) {
        $this->id = $facebook_user['id'];
        $this->first_name = $facebook_user['first_name'];
        $this->last_name = $facebook_user['last_name'];
        
        $sql = "INSERT INTO facebookusers (id, first_name, last_name, created_at) VALUES ($this->id, '{$this->first_name}', '{$this->last_name}', NOW())";
        $this->db->query($sql);
    }

    function is_fbmember($facebook_user) {
        $this->where('id', $facebook_user['id'])->get();
        if ($this->id)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


}

/* End of file user.php */
/* Location: ./application/models/user.php */