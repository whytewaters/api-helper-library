<?php namespace Rtbs\ApiHelper;

use Rtbs\ApiHelper\Exceptions\ApiClientException;
use Rtbs\ApiHelper\Models\AccommodationBooking;
use Rtbs\ApiHelper\Models\Booking;
use Rtbs\ApiHelper\Models\Itinerary;

class APIClient {

    function __construct($options=array()) {
        //override defaults
        if (isset($options['host'])) {
            $this->host = $options['host'];
        }
        if (isset($options['key'])) {
            $this->key = $options['key'];
        }
        if (isset($options['pwd'])) {
            $this->pwd = $options['pwd'];
        }

        $this->seed = $this->api_signature_seed();
    }

    function api_signature_seed() {
        $response = $this->call('/api/signature_seed');
        return $response->signature_seed;
    }

    function api_categories() {
        $response = $this->call('/api/categories');
        return $response->categories;
    }

    function api_locations() {
        $response = $this->call('/api/locations');
        return $response->locations;
    }

    //Note! Locations are identified by name, not by key.
    function api_location_suppliers($location_name) {
        $location_name = strtr($location_name, array(' '=>'%20'));
        $response = $this->call('/api/location/'.$location_name.'/suppliers');
        return $response->suppliers;
    }

    function api_suppliers() {
        $response = $this->call('/api/suppliers');
        return $response->suppliers;
    }

    function api_accommodation_locations($supplier_key) {
        $response = $this->call('/api/accommodation-locations/'.$supplier_key);
        return $response->locations;
    }

    function api_accommodation_provider_detail($provider_key) {
        $response = $this->call('/api/accommodation-provider-detail/'.$provider_key);
        return $response->provider;
    }

    function api_accommodation_availability($provider_key, $check_in, $check_out) {
        $response = $this->call('/api/accommodation-provider-availability/'.$provider_key.'/'.$check_in.'/'.$check_out);
        return $response->availability;
    }

    function api_accommodation_providers($location_key, $check_in, $check_out) {
        $response = $this->call('/api/accommodation-providers/'.$location_key.'/'.$check_in.'/'.$check_out);
        return $response->providers;
    }

    function api_supplier($key) {
        $response = $this->call('/api/suppliers/'.$key);
        $suppliers = $response->suppliers;
        if (isset($suppliers[0])) {
            return $suppliers[0];
        }
        return null;
    }

    function api_tours($keys) {
        $response = $this->call('/api/tours/'.implode(",", $keys));
        return $response->tours;
    }

    //NOTE! returns an object with potentially two properties: 'sessions' & 'advance_dates'
    function api_sessions($supplier_key, $tour_keys, $date) {
        $pattern = "/api/sessions?supplier=%s&tours=%s&date=%s";
        $tours = is_array($tour_keys) ? implode(",", $tour_keys) : $tour_keys;
        $request = sprintf($pattern, $supplier_key, $tours, $date);
        $response = $this->call($request);
        return $response;
    }

    function api_pickups($tour_key) {
        $method = "/api/pickups?tour=".$tour_key;
        $response = $this->call($method);
        return $response->pickups;
    }

    //returns a payment URL for the booking
    function api_booking(Booking $booking) {
        $method = '/api/booking';
        $data = $booking->to_raw_object();
        $content = "data=".rawurlencode( json_encode($data) );
        $referrer = isset($_SERVER['SCRIPT_URI']) ? $_SERVER['SCRIPT_URI'] : 'Demonstration';

        $opts=array(
            'http' => array(
                'method'  => 'POST',
                'header'  => array(
                    "Content-type: application/x-www-form-urlencoded",
                    "Referer: " . $referrer ,
                    "Connection: close",
                    "Accept-language: en"
                ),
                'content' => $content,
            ),
        );
        $response = $this->call($method, $opts);
        return $response;
    }

    function api_remove_booking($booking_id, $itinerary_key, $booking_type) {
        $method = '/api/remove-itinerary-booking';
        $data = array(
            'itinerary_key' => $itinerary_key,
            'booking_id' => $booking_id,
            'booking_type' => $booking_type
        );
        $content = "data=".rawurlencode( json_encode($data) );
        $referrer = isset($_SERVER['SCRIPT_URI']) ? $_SERVER['SCRIPT_URI'] : 'Demonstration';

        $opts=array(
            'http' => array(
                'method'  => 'POST',
                'header'  => array(
                    "Content-type: application/x-www-form-urlencoded",
                    "Referer: " . $referrer ,
                    "Connection: close",
                    "Accept-language: en",
                ),
                'content' => $content,
            ),
        );
        $response = $this->call($method, $opts);
        return $response;
    }

    function api_pay_itinerary(Itinerary $itinerary) {
        $method = '/api/pay-itinerary';
        $data = get_object_vars($itinerary);
        $content = "data=".rawurlencode( json_encode($data) );

        $referrer = isset($_SERVER['SCRIPT_URI']) ? $_SERVER['SCRIPT_URI'] : 'Demonstration';

        $opts=array(
            'http' => array(
                'method'  => 'POST',
                'header'  => array(
                    "Content-type: application/x-www-form-urlencoded",
                    "Referer: " . $referrer ,
                    "Connection: close",
                    "Accept-language: en",
                ),
                'content' => $content,
            ),
        );
        $response = $this->call($method, $opts);
        return $response;
    }

    function api_create_itinerary($primary_customer_key, $additional_customer_keys = array()) {
        $method = '/api/itinerary';

        $data = array(
            'primary_customer_key' => $primary_customer_key,
            'additional_customer_keys' => $additional_customer_keys
        );

        $content = "data=".rawurlencode( json_encode($data) );
        $referrer = isset($_SERVER['SCRIPT_URI']) ? $_SERVER['SCRIPT_URI'] : 'Demonstration';

        $opts=array(
            'http' => array(
                'method'  => 'POST',
                'header'  => array(
                    "Content-type: application/x-www-form-urlencoded",
                    "Referer: " . $referrer ,
                    "Connection: close",
                    "Accept-language: en",
                ),
                'content' => $content,
            ),
        );
        $response = $this->call($method, $opts);
        return $response;
    }

    //Makes an api call.
    protected function call($request, $opts = null) {
        if (substr($request, 0,5) !== "/api/") {
            throw new ApiClientException("All API requests must begin with /api/");
        }

        //add key
        $separator = strpos($request, '?') === false ? '?' : '&';
        $request .= $separator.'apikey='.$this->key;

        //sign
        $is_signature_needed = strpos($request, "/api/signature_seed") === false;
        if ($is_signature_needed) {
            if (empty($this->seed)) {
                throw new ApiClientException("Did not sign request: no seed");
            }
            if (!isset($this->seed->expires) || !isset($this->seed->seed)) {
                throw new ApiClientException("Did not sign request: seed invalid");
            }
            if (strtotime($this->seed->expires) < time()) {
                throw new ApiClientException("Did not sign request: seed expired");
            }
            $signature = sha1($request . $this->seed->seed . $this->pwd);
            $request.="&signature=".$signature;
        }

        $url = $this->host.$request;

        if ($opts == null) {
            $response_raw = file_get_contents($url);
        }
        else {
            $context = stream_context_create($opts);
            $response_raw = file_get_contents($url, false, $context);
        }

        $response = json_decode($response_raw);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ApiClientException("Server response invalid JSON format: ". $response_raw);
        }
        if (isset($response->success) && $response->success == false) {
            throw new ApiClientException("API call did not succeed: ". $response->message);
        }
        return $response;
    }

    public function api_create_customer($first_name, $last_name, $email, $phone) {
        $data = array(
            'fname' => $first_name,
            'lname' => $last_name,
            'email' => $email,
            'phone' => $phone
        );

        $content = "data=".rawurlencode( json_encode($data) );
        $referrer = isset($_SERVER['SCRIPT_URI']) ? $_SERVER['SCRIPT_URI'] : 'Demonstration';

        $opts=array(
            'http' => array(
                'method'  => 'POST',
                'header'  => array(
                    "Content-type: application/x-www-form-urlencoded",
                    "Referer: " . $referrer ,
                    "Connection: close",
                    "Accept-language: en",
                ),
                'content' => $content,
            ),
        );
        $response = $this->call('/api/customer', $opts);
        return $response;
    }

    public function api_accommodation_booking(AccommodationBooking $accommodation_booking) {
        $method = '/api/accommodation-booking';
        $data = get_object_vars($accommodation_booking);
        $content = "data=".rawurlencode( json_encode($data) );
        $referrer = isset($_SERVER['SCRIPT_URI']) ? $_SERVER['SCRIPT_URI'] : 'Demonstration';

        $opts=array(
            'http' => array(
                'method'  => 'POST',
                'header'  => array(
                    "Content-type: application/x-www-form-urlencoded",
                    "Referer: " . $referrer ,
                    "Connection: close",
                    "Accept-language: en",
                    "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8"
                ),
                'content' => $content,
            ),
        );
        $response = $this->call($method, $opts);
        return $response;
    }
}