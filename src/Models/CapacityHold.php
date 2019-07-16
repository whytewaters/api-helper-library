<?php namespace Rtbs\ApiHelper\Models;


class CapacityHold {

    protected $capacity_hold_key;
    protected $expires;
    protected $tour_key;
    protected $trip_datetime;
    protected $pax_held;
    protected $hold_length_mins;

    /**
     * @param \stdClass $raw_capacity_hold
     * @return CapacityHold
     */
    public static function from_raw($raw_capacity_hold) {
        $capacity_hold = new CapacityHold();

        $capacity_hold->set_capacity_hold_key($raw_capacity_hold->capacity_hold_key);
        $capacity_hold->set_expires($raw_capacity_hold->expires);
        $capacity_hold->set_tour_key($raw_capacity_hold->tour_key);
        $capacity_hold->set_trip_datetime($raw_capacity_hold->trip_datetime);
        $capacity_hold->set_pax_held($raw_capacity_hold->pax_held);
        $capacity_hold->set_hold_length_mins($raw_capacity_hold->hold_length_mins);

        return $capacity_hold;
    }

    public function get_capacity_hold_key() {
        return $this->capacity_hold_key;
    }

    public function set_capacity_hold_key($capacity_hold_key) {
        $this->capacity_hold_key = $capacity_hold_key;
    }

    public function get_expires() {
        return $this->expires;
    }

    public function set_expires($expires) {
        $this->expires = $expires;
    }

    public function is_expired()
    {
        return (strtotime($this->expires) <= time());
    }

    public function get_tour_key() {
        return $this->tour_key;
    }

    public function set_tour_key($tour_key) {
        $this->tour_key = $tour_key;
    }

    public function get_trip_datetime() {
        return $this->trip_datetime;
    }

    public function set_trip_datetime($trip_datetime) {
        $this->trip_datetime = $trip_datetime;
    }

    public function get_pax_held() {
        return $this->pax_held;
    }

    public function set_pax_held($pax_held) {
        $this->pax_held = $pax_held;
    }

    public function get_hold_length_mins() {
        return $this->hold_length_mins;
    }

    public function set_hold_length_mins($hold_length_mins) {
        $this->hold_length_mins = $hold_length_mins;
    }

}