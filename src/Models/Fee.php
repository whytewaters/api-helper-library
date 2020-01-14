<?php

namespace Rtbs\ApiHelper\Models;

class Fee {
    private $fee_name;
    private $fee_code;
    private $fee_description;
    private $fee_percent_amount;
    private $fee_fixed_amount;
    private $fee_is_per_itinerary;

    public function get_fee_name() {
        return $this->fee_name;
    }

    public function set_fee_name($fee_name) {
        $this->fee_name = $fee_name;
    }

    public function get_fee_code() {
        return $this->fee_code;
    }

    public function set_fee_code($fee_code) {
        $this->fee_code = $fee_code;
    }

    public function get_fee_description() {
        return $this->fee_description;
    }

    public function set_fee_description($fee_description) {
        $this->fee_description = $fee_description;
    }

    public function get_fee_percent_amount() {
        return $this->fee_percent_amount;
    }

    public function set_fee_percent_amount($fee_percent_amount) {
        $this->fee_percent_amount = $fee_percent_amount;
    }

    public function get_fee_fixed_amount() {
        return $this->fee_fixed_amount;
    }

    public function set_fee_fixed_amount($fee_fixed_amount) {
        $this->fee_fixed_amount = $fee_fixed_amount;
    }

    public function get_fee_is_per_itinerary() {
        return $this->fee_is_per_itinerary;
    }

    public function set_fee_is_per_itinerary($fee_is_per_itinerary) {
        $this->fee_is_per_itinerary = $fee_is_per_itinerary;
    }

    /**
     * @param $raw_fee
     * @return Fee
     */
    public static function from_raw($raw_fee) {
        $fee = new self();
        $fee->fee_name = $raw_fee->fee_name;
        $fee->fee_code = $raw_fee->fee_code;
        $fee->fee_description = $raw_fee->fee_description;
        $fee->fee_percent_amount = (float)$raw_fee->fee_percent_amount;
        $fee->fee_fixed_amount = (float)$raw_fee->fee_fixed_amount;
        $fee->fee_is_per_itinerary = $raw_fee->fee_is_per_itinerary;

        return $fee;
    }
}