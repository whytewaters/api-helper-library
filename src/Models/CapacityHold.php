<?php namespace Rtbs\ApiHelper\Models;


class CapacityHold {

    private $capacity_hold_key;
    private $expires;

    /**
     * @param \stdClass $raw_capacity_hold
     * @return CapacityHold
     */
    public static function from_raw($raw_capacity_hold) {
        $capacity_hold = new CapacityHold();

        $capacity_hold->set_capacity_hold_key($raw_capacity_hold->capacity_hold_key);
        $capacity_hold->set_expires($raw_capacity_hold->expires);

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
}