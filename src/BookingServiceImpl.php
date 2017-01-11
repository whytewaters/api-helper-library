<?php namespace Rtbs\ApiHelper;

use Rtbs\ApiHelper\Exceptions\ModelNotFoundException;
use Rtbs\ApiHelper\Models\Booking;
use Rtbs\ApiHelper\Models\Category;
use Rtbs\ApiHelper\Models\Customer;
use Rtbs\ApiHelper\Models\Pickup;
use Rtbs\ApiHelper\Models\Session;
use Rtbs\ApiHelper\Models\SessionAndAdvanceDates;
use Rtbs\ApiHelper\Models\Supplier;
use Rtbs\ApiHelper\Models\Tour;
use Rtbs\ApiHelper\Models\Itinerary;

class BookingServiceImpl implements BookingService {
    private $api_client;
    private $credentials;

    /**
     * BookingServiceImpl constructor.
     * @param array $credentials
     */
    public function __construct($credentials) {
        $this->credentials = $credentials;
    }

    /**
     * @return Category[]
     */
    public function get_categories() {
        $categories = array();

        $raw_categories = $this->get_api_client()->api_categories();

        foreach($raw_categories as $raw_category) {
            $categories[] = Category::fromRaw($raw_category);
        }


        return $categories;
    }

    /**
     * @param string $supplier_key
     * @param string|array $tour_keys
     * @param string $date
     * @param bool $search_next_available
     * @return SessionAndAdvanceDates
     */
    public function get_sessions_and_advance_dates($supplier_key, $tour_keys, $date, $search_next_available = false) {

        $response = $this->get_api_client()->api_sessions($supplier_key, $tour_keys, $date, $search_next_available);

        $sessions_and_advance_dates = new SessionAndAdvanceDates();

        foreach($response->sessions as $raw_session) {
            $sessions_and_advance_dates->add_session(Session::from_raw($raw_session));
        }

        $sessions_and_advance_dates->set_advance_dates($response->advance_dates);

        return $sessions_and_advance_dates;
    }

    /**
     * @return Supplier[]
     */
    public function get_suppliers() {
        $suppliers = array();

        $raw_suppliers = $this->get_api_client()->api_suppliers();

        foreach($raw_suppliers as $raw_supplier) {
            $suppliers[] = Supplier::fromRaw($raw_supplier);
        }


        return $suppliers;
    }

    /**
     * @param $tour_key
     * @return Pickup[]
     */
    public function get_pickups($tour_key) {
        $pickups = array();

        $raw_pickups = $this->get_api_client()->api_pickups($tour_key);

        foreach($raw_pickups as $raw_pickup) {
            $pickups[] = Pickup::from_raw($raw_pickup);
        }

        return $pickups;
    }

    /**
     * @param $tour_keys
     * @return Tour[]
     */
    public function get_tours($tour_keys) {
        $tours = array();

        $raw_tours = $this->get_api_client()->api_tours($tour_keys);

        foreach($raw_tours as $raw_tour) {
            $tours[] = Tour::from_raw($raw_tour);
        }


        return $tours;
    }

    /**
     *
     * @param string $supplier_key
     * @return Supplier
     * @throws ModelNotFoundException
     */
    public function get_supplier($supplier_key) {
        $raw_supplier = $this->get_api_client()->api_supplier($supplier_key);

        if($raw_supplier == null) {
            throw new ModelNotFoundException('Supplier Not Found, check Expose to API setting in RTBS');
        }

        return Supplier::fromRaw($raw_supplier);
    }


    private function get_api_client() {
        if($this->api_client == null) {
            $this->api_client = new APIClient($this->credentials);
        }

        return $this->api_client;
    }


    /**
     * @param $booking Booking
     * @return string url | Booking
     */
    public function make_booking(Booking $booking) {
        $response = $this->get_api_client()->api_booking($booking);

        if(isset($response->url)) {
            return $response->url;
        }
        else {
            $booking->from_raw($response->booking);
            return $booking;
        }
    }

    /**
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $phone
     * @return \Rtbs\ApiHelper\Models\Customer
     */
    public function create_customer($first_name, $last_name, $email, $phone) {
        $raw_customer = $this->get_api_client()->api_create_customer($first_name, $last_name, $email, $phone);

        return Customer::fromRaw($raw_customer->customer);
    }

    /**
     * @param Customer $customer
     * @return \Rtbs\ApiHelper\Models\Itinerary
     */
    public function create_itinerary(Customer $customer) {
        $raw_itinerary = $this->get_api_client()->api_create_itinerary($customer->get_customer_key());

        return Itinerary::from_raw($raw_itinerary->itinerary);
    }

    /**
     * @param Itinerary $itinerary
     * @return string payment_url
     */
    public function pay_itinerary(Itinerary $itinerary) {
        $response = $this->get_api_client()->api_pay_itinerary($itinerary->get_itinerary_key());

        return $response->url;
    }
}