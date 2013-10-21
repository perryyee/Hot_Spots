<?php

class Place extends DataMapper {

    var $has_many = array('checkin');
    var $created_field = 'created_at';
    var $updated_field = 'updated_at';

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

    //Adds Facebook Place data into database
    function add_place($place)
    {   
        $place_website = NULL;
        $location_street = NULL;
        $location_city = NULL;
        $location_state = NULL;
        $location_country = NULL;
        $location_zip = NULL;

        if (isset($place['website']))
        {
            $place_website = $place['website'];
        }
        if (isset($place['location']['street']))
        {
            $location_street = $place['location']['street'];
        }
        if (isset($place['location']['city']))
        {
            $location_city = $place['location']['city'];
        }

        if (isset($place['location']['state']))
        {
            $location_state = $place['location']['state'];
        }

        if (isset($place['location']['country']))
        {
            $location_country = $place['location']['country'];
        }
        if (isset($place['location']['zip']))
        {
            $location_zip = $place['location']['zip'];
        }

        if (!$this->get_place($place['id']))
        {
            $sql = "INSERT INTO places (id, name, website, checkins, category, were_here_count, talking_about_count) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $this->db->query($sql, array($place['id'], $place['name'], $place_website, $place['checkins'], $place['category'], $place['were_here_count'], $place['talking_about_count']));

            $sql = "INSERT INTO locations (place_id, street, city, state, country, zip, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $this->db->query($sql, array($place['id'], $location_street,$location_city, $location_state, $location_country, $location_zip, $place['location']['latitude'], $place['location']['longitude']));
        }
    }

    //Queries Facebook for all of the Places
    function retrieve_places($facebook_user) {

    }

    //Checks if specific Place exists in the database by Place ID
    function get_place($place_id) {
        $user = $this->where('id', $place_id)->get();
        if ($user->id)
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