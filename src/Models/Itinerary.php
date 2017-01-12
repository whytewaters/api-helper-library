<?php namespace Rtbs\ApiHelper\Models;


class Itinerary {

    private $itinerary_key;

    public static function from_raw($raw_itinerary) {
        $itinerary = new Itinerary();

        $itinerary->set_itinerary_key($raw_itinerary->itinerary_key);

        return $itinerary;
    }

    public function get_itinerary_key() {
        return $this->itinerary_key;
    }

    public function set_itinerary_key($itinerary_key) {
        $this->itinerary_key = $itinerary_key;
    }
}