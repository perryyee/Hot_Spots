<?php

class Checkin extends DataMapper {

    var $has_one = array('facebookuser');
    var $updated_field = 'updated_at';

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    function save_checkins($id, $checkins)
    {
        foreach ($checkins as $checkin) {
            $sql = "INSERT INTO checkins (id, facebookuser_id, author_id, latitude, longitude, created_at) VALUES ('{$checkin['checkin_id']}', $id, '{$checkin['author_uid']}', {$checkin['coords']['latitude']}, {$checkin['coords']['longitude']}, {$checkin['timestamp']})";
            $this->db->query($sql);
        }
    }
    function retrieve_checkins($id) {
        $sql = "SELECT id FROM checkins WHERE facebookuser_id = $id";
        $checkins = $this->db->query($sql)->result_array();
        return $checkins;
    }
}

/* End of file user.php */
/* Location: ./application/models/user.php */