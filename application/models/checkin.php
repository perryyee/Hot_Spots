<?php

class Checkin extends DataMapper {

    var $has_one = array('facebookuser', 'place');
    var $updated_field = 'updated_at';

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    function save_checkins($id, $checkins)
    {
        $fb_checkin = new facebookusers_checkin();
        foreach ($checkins as $checkin) {
            if (!$this->get_checkin($checkin['checkin_id']))
            { 
                $sql = "INSERT INTO checkins (id, author_id, latitude, longitude, created_at) VALUES ('{$checkin['checkin_id']}', '{$checkin['author_uid']}', {$checkin['coords']['latitude']}, {$checkin['coords']['longitude']}, {$checkin['timestamp']})";
                $this->db->query($sql);
            }
                if(!$fb_checkin->get_fb_checkin($id, $checkin['checkin_id']))
                {
                    $sql = "INSERT INTO facebookusers_checkins (facebookuser_id, checkin_id) VALUES ($id, '{$checkin['checkin_id']}')";
                    $this->db->query($sql);    
                }
        }
    }
    function add_checkins($checkins)
    {
        $places = array();
        $ci =& get_instance();
        $ci->config->load('facebook', TRUE);
        $config = $ci->config->item('facebook');

        $facebook = new Facebook($config);
        $place_obj = new Place();

        foreach ($checkins as $checkin) 
        {
            $message = NULL;
            $place_id = $facebook->api("/{$checkin['checkin_id']}");

            if(isset($place_id['message']))
            {
                $message = $place_id['message'];
            }
            if (!$place_obj->get_place($place_id['id']))
            {
                $place = $facebook->api("/{$place_id['place']['id']}?fields=name,category,checkins,location,talking_about_count,website,id,were_here_count");
                $place_obj->add_place($place);
            }
            $sql = "UPDATE checkins SET place_id=?, place_name=?, author_name=?, message=? WHERE id=?";
            $this->db->query($sql, array($place_id['place']['id'], $place_id['place']['name'], $place_id['from']['name'],  $message, $checkin['checkin_id']));
            
        }
        return $places;
    }
    //make a general get_checkins($selects) function
    function retrieve_checkin_ids($id) {
        $sql = "SELECT checkin_id FROM facebookusers_checkins WHERE facebookuser_id = $id";
        $checkins = $this->db->query($sql)->result_array();
        return $checkins;
    }
    function get_checkin($id) {
        $checkin = $this->where('id', $id)->get();
        if ($checkin->id)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    function get_feed_checkins($id) {
        $sql = "SELECT place_name, place_id, website, author_id, author_name, message, latitude, longitude, (UNIX_TIMESTAMP(NOW())-checkins.created_at) as time_diff FROM checkins
            LEFT JOIN places on place_id = places.id
            LEFT JOIN facebookusers_checkins on checkins.id = facebookusers_checkins.checkin_id
            WHERE facebookuser_id = $id ORDER BY checkins.created_at DESC LIMIT 10";    
        return $this->db->query($sql)->result_array();
    }
    function get_map_checkins() {
        $sql = "SELECT places.id, author_name, message, place_name, website, 
                checkins, were_here_count, talking_about_count, category,
                locations.latitude, locations.longitude, city, state, country, checkins.created_at 
                FROM checkins
                LEFT JOIN places on places.id = place_id
                LEFT JOIN locations on places.id = locations.place_id";
        return $this->db->query($sql)->result_array();
    }
}

/* End of file user.php */
/* Location: ./application/models/user.php */