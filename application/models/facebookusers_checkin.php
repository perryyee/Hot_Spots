<?php

class Facebookusers_checkin extends DataMapper {

    var $has_one = array('facebookuser', 'place');
    var $updated_field = 'updated_at';

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

    //Queries database for all of the checkins associated with the user by facebook user Id and checkin ID
    function get_fb_checkin($fb_id, $checkin_id ) {
        //$sql = "SELECT * FROM Facebookusers_checkins WHERE facebookuser_id=$fb_id AND checkin_id = $checkin_id";
        $this->where('facebookuser_id', $fb_id);
        $this->where('checkin_id', $checkin_id);
        $fb_checkin = $this->get();

        if ($fb_checkin->facebookuser_id)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}

/* End of file user.php */
/* Location: ./application/models/user.php */