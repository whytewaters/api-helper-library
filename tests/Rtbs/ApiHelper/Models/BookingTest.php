<?php namespace Rtbs\ApiHelper\Models;


class BookingTest extends \PHPUnit_Framework_TestCase
{

    public function testGetterSetters()
    {
        $booking_id = 'booking_id';
        $promo_code = 'promo_code';
        $comment = 'comment';
        $datetime = 'datetime';
        $first_name = 'first_name';
        $last_name = 'last_name';
        $email = 'email';
        $phone = 'phone';
        $promo_key = 'promo_key';
        $return_url = 'return_url';
        $pickup_key = 'pickup_key';
        $itinerary_key = 'intinerary_key';
        $capacity_hold_key = 'capacity_hold_key';

        $booking = new Booking();

        $booking->set_booking_id($booking_id);
        $booking->set_promo_code($promo_code);
        $booking->set_comment($comment);
        $booking->set_datetime($datetime);
        $booking->set_first_name($first_name);
        $booking->set_last_name($last_name);
        $booking->set_email($email);
        $booking->set_phone($phone);
        $booking->set_promo_key($promo_key);
        $booking->set_return_url($return_url);
//        $booking->add_price_selection($return_url);
//        $booking->add_price_selection_keys($return_url);
//        $booking->add_field_data($return_url);
        $booking->set_pickup_key($pickup_key);
        $booking->set_itinerary_key($itinerary_key);
        $booking->set_capacity_hold_key($capacity_hold_key);



        $this->assertEquals($booking_id, $booking->get_booking_id());
        $this->assertEquals($promo_code, $booking->get_promo_code());
        $this->assertEquals($comment, $booking->get_comment());
        $this->assertEquals($datetime, $booking->get_datetime());
        $this->assertEquals($first_name, $booking->get_first_name());
        $this->assertEquals($last_name, $booking->get_last_name());
        $this->assertEquals($email, $booking->get_email());
        $this->assertEquals($phone, $booking->get_phone());
        $this->assertEquals($promo_key, $booking->get_promo_key());
//        $this->assertEquals($return_url, $booking->get_re
//        $this->assertEquals($pickup_key, $booking->get_p());
        $this->assertEquals($itinerary_key, $booking->get_itinerary_key());
//        $this->assertEquals($capacity_hold_key, $booking->g());


        //get_status
//get_booking_id
//get_id
//get_valid_until
//get_is_used
//get_supplier_key
//get_supplier_name
//get_tour_name
//get_promo_code
//get_pickup_time
//get_pickup_point
//get_comment
//get_total
//get_total_disc
//get_total_inc_disc
//get_tour_key
//get_datetime
//get_first_name
//get_last_name
//get_email
//get_phone
//get_promo_key
//get_prices
//get_price_selections
//get_itinerary_key

    }

}