<?php namespace Rtbs\ApiHelper\Models;


class ItineraryBooking
{
    private $bookings = array();
    private $customer;
    private $itinerary;


    /**
     * @param Customer $customer
     */
    public function set_customer(Customer $customer)
    {
        $this->customer = $customer;
    }


    /**
     * @param Itinerary $itinerary
     */
    public function set_itinerary($itinerary)
    {
        $this->itinerary = $itinerary;
    }


    /**
     * @return Itinerary
     */
    public function get_itinerary()
    {
        return $this->itinerary;
    }


    /**
     * @param Booking $booking
     */
    public function add_booking($booking)
    {
        $this->bookings[] = $booking;
    }


    /**
     * @return Booking[]
     */
    public function get_bookings()
    {
        return $this->bookings;
    }


    /**
     * @return array
     */
    public function to_raw()
    {
        $raw_bookings = array();

        foreach ($this->bookings as $booking) {
            $raw_bookings[] = $booking->to_raw();
        }

        return array(
            'customer' => $this->customer->to_raw(),
            'itinerary' => $this->itinerary->to_raw(),
            'bookings' => $raw_bookings,
        );
    }


    /**
     * @param \stdClass $raw_obj
     */
    public function from_raw($raw_obj)
    {
        $itinerary_booking = new self();
        $itinerary_booking->customer = Customer::from_raw($raw_obj->customer);
        $itinerary_booking->itinerary = Itinerary::from_raw($raw_obj->itinerary);

        $itinerary_booking->bookings = array();

        foreach ($raw_obj->bookings as $raw_booking) {
            $itinerary_booking->bookings[] = Booking::from_raw($raw_booking);
        }
    }

}