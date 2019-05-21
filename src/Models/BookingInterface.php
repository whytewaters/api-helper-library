<?php namespace Rtbs\ApiHelper\Models;

interface BookingInterface {

    public function to_raw();

    public static function from_raw($raw_booking);

}
