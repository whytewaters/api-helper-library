<?php


namespace RTBS\models;


class Pickup {
    private $pickup_key;
    private $name;
    private $place;
    private $minutes;
    private $lat;
    private $lng;

    /**
     * @return mixed
     */
    public function get_pickup_key()
    {
        return $this->pickup_key;
    }

    /**
     * @param mixed $pickup_key
     */
    public function set_pickup_key($pickup_key)
    {
        $this->pickup_key = $pickup_key;
    }

    /**
     * @return mixed
     */
    public function get_name()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function set_name($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function get_place()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     */
    public function set_place($place)
    {
        $this->place = $place;
    }

    /**
     * @return mixed
     */
    public function get_minutes()
    {
        return $this->minutes;
    }

    /**
     * @param mixed $minutes
     */
    public function set_minutes($minutes)
    {
        $this->minutes = $minutes;
    }

    /**
     * @return mixed
     */
    public function get_lat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function set_lat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function get_lng()
    {
        return $this->lng;
    }

    /**
     * @param mixed $lng
     */
    public function set_lng($lng)
    {
        $this->lng = $lng;
    }



    public static function from_raw($raw_pickup) {
        $pickup = new Pickup();

        $pickup->set_name($raw_pickup->name);
        $pickup->set_lat($raw_pickup->lat);
        $pickup->set_lng($raw_pickup->lng);
        $pickup->set_minutes($raw_pickup->minutes);
        $pickup->set_pickup_key($raw_pickup->pickup_key);
        $pickup->set_place($raw_pickup->place);

        return $pickup;
    }
}