<?php

namespace Rtbs\ApiHelper\Models;

class BookingFee {
    private $fee_name;
    private $fee_code;
    private $fee_description;
    private $fee_amount;

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

    public function get_fee_amount() {
        return $this->fee_amount;
    }

    public function set_fee_amount($fee_amount) {
        $this->fee_amount = $fee_amount;
    }

    /**
     * @param $raw_booking_fee
     * @return BookingFee
     */
    public static function from_raw($raw_booking_fee) {
        $booking_fee = new self();
        $booking_fee->fee_name = $raw_booking_fee->fee_name;
        $booking_fee->fee_code = $raw_booking_fee->fee_code;
        $booking_fee->fee_description = $raw_booking_fee->fee_description;
        $booking_fee->fee_amount = $raw_booking_fee->fee_amount;

        return $booking_fee;
    }
}