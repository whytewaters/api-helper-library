<?php


namespace RTBS;

use RTBS\exceptions\ModelNotFoundException;
use RTBS\models\Booking;
use RTBS\models\Supplier;

class BookingServiceImpl implements BookingService {
    private $api_client;

    /**
     * @return models\Category[]
     */
    public function get_categories() {
        $categories = [];

        $raw_categories = $this->get_api_client()->api_categories();

        foreach($raw_categories as $raw_category) {
            $categories[] = models\Category::fromRaw($raw_category);
        }


        return $categories;
    }

    /**
     * @return models\Session[]
     */
    public function get_sessions_and_advance_dates($supplier_key, $tour_keys, $date) {
        $sessions_and_advance_dates = [
            'sessions' => [],
            'advance_dates' => []
        ];

        $response = $this->get_api_client()->api_sessions($supplier_key, $tour_keys, $date);

        foreach($response->sessions as $raw_session) {
            $sessions_and_advance_dates['sessions'][] = models\Session::from_raw($raw_session);
        }

        $sessions_and_advance_dates['advance_dates'] = $response->advance_dates;

        return $sessions_and_advance_dates;
    }

    /**
     * @return models\Supplier[]
     */
    public function get_suppliers() {
        $suppliers = [];

        $raw_suppliers = $this->get_api_client()->api_suppliers();

        foreach($raw_suppliers as $raw_supplier) {
            $suppliers[] = models\Supplier::fromRaw($raw_supplier);
        }


        return $suppliers;
    }

    /**
     * @param $tour_key
     * @return models\Pickup[]
     */
    public function get_pickups($tour_key) {
        $pickups = [];

        $raw_pickups = $this->get_api_client()->api_pickups($tour_key);

        foreach($raw_pickups as $raw_pickup) {
            $pickups[] = models\Pickup::from_raw($raw_pickup);
        }

        return $pickups;
    }

    /**
     * @param $tour_keys
     * @return models\Tour[]
     */
    public function get_tours($tour_keys) {
        $tours = [];

        $raw_tours = $this->get_api_client()->api_tours($tour_keys);

        foreach($raw_tours as $raw_tour) {
            $tours[] = models\Tour::from_raw($raw_tour);
        }


        return $tours;
    }

    /**
     *
     * @param $supplier_key
     * @return models\Supplier
     * @throws ModelNotFoundException
     */
    public function get_supplier($supplier_key) {
        $raw_supplier = $this->get_api_client()->api_supplier($supplier_key);

        if($raw_supplier == null) {
            throw new exceptions\ModelNotFoundException();
        }

        return models\Supplier::fromRaw($raw_supplier);
    }

    private function get_api_client() {
        if($this->api_client == null) {
            $this->api_client = new APIClient([
                "host" => RTBS_API_HOST,
                "key" => RTBS_API_KEY,
                "pwd" => RTBS_API_PASSWORD
            ]);
        }

        return $this->api_client;
    }


    /**
     * @param $booking models\Booking
     * @return string url | models\Booking
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
}