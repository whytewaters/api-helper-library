<?php


namespace RTBS;


use RTBS\models\Booking;

interface BookingService
{
    /**
     * @return models\Category[]
     */
    public function get_categories();

    /**
     * @return models\Supplier[]
     */
    public function get_suppliers();

    /**
     * @param $supplier_key
     * @param $tour_keys
     * @param $date
     * @return associative array with two keys: sessions => Session[] and advanced_dates => mixed
     */
    public function get_sessions_and_advance_dates($supplier_key, $tour_keys, $date);

    /**
     * @param $tour_key
     * @return models\Pickup[]
     */
    public function get_pickups($tour_key);

    /**
     * @param $booking models\Booking
     * @return string url | models\Booking
     */
    public function make_booking(Booking $booking);
}