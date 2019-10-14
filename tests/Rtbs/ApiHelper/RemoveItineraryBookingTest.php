<?php namespace Rtbs\ApiHelper;

use Rtbs\ApiHelper\Models\Booking;

class RemoveItineraryBookingTest extends \PHPUnit_Framework_TestCase {

    public function testNullPost() {
        $api = new BookingServiceImpl(array(
            'host' => 'http://rtbstraining.local',
            'key' => 'itqy5lczwh',
        ));

        $booking_id = null;
        $itinerary_key = null;

        $this->setExpectedException('Rtbs\ApiHelper\Exceptions\ApiClientException');
        $api->remove_activity_booking($booking_id, $itinerary_key);
    }

    public function testInvalidItineraryKey() {
        $api = new BookingServiceImpl(array(
            'host' => 'http://rtbstraining.local',
            'key' => 'itqy5lczwh',
        ));

        $booking_id = 123456;
        $itinerary_key = 'INVALID';

        $this->setExpectedException('Rtbs\ApiHelper\Exceptions\ApiClientException', 'Permission denied for itinerary');
        $api->remove_activity_booking($booking_id, $itinerary_key);
    }

    public function testInvalidBookingId() {
        $api = new BookingServiceImpl(array(
            'host' => 'http://rtbstraining.local',
            'key' => 'itqy5lczwh',
        ));

        $booking_id = 'INVALID';

        $customer = $api->create_customer('first name', 'last name', 'alex.ryder@whytewaters.com', '0210787328');
        $itinerary = $api->create_itinerary($customer);

        $this->setExpectedException('Rtbs\ApiHelper\Exceptions\ApiClientException', 'Activity Booking with id');
        $api->remove_activity_booking($booking_id, $itinerary->get_itinerary_key());
    }

    public function testValidBooking() {
        $api = new BookingServiceImpl(array(
            'host' => 'http://rtbstraining.local',
            'key' => 'itqy5lczwh',
        ));

        $tour_key = 'cidzljubey'; // half day cycle tour

        $customer = $api->create_customer('first name', 'last name', 'alex.ryder@whytewaters.com', '0210787328');
        $itinerary = $api->create_itinerary($customer);

        $datetime_next_year = new \DateTime();
        $datetime_next_year->add(new \DateInterval('P1Y'));

        $booking_model = new Booking();
        $booking_model->set_itinerary_key($itinerary->get_itinerary_key());
        $booking_model->set_tour_key($tour_key);
        $booking_model->set_datetime($datetime_next_year);
        $booking_model->set_first_name('firstname');
        $booking_model->set_last_name('lastname');
        $booking_model->set_email('alex.ryder@whytewaters.com');
        $booking_model->set_phone('phone');
        $booking_model->add_price_selection_keys(31070, 1);

        $booking = $api->make_booking($booking_model);

        $api->remove_activity_booking($booking->get_booking_id(), $itinerary->get_itinerary_key());

        // 2nd removal should fail
        $this->setExpectedException('Rtbs\ApiHelper\Exceptions\ApiClientException', 'is not part of itinerary');
        $api->remove_activity_booking($booking->get_booking_id(), $itinerary->get_itinerary_key());
    }
}