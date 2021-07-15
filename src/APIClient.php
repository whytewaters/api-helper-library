<?php namespace Rtbs\ApiHelper;

use Rtbs\ApiHelper\Exceptions\ApiClientException;
use Rtbs\ApiHelper\Exceptions\ApiClientNetworkException;
use Rtbs\ApiHelper\Models\AccommodationBooking;
use Rtbs\ApiHelper\Models\Booking;
use Rtbs\ApiHelper\Models\BookingInterface;
use Rtbs\ApiHelper\Models\ResourceRequirement;
use Rtbs\ApiHelper\Models\TransportSessionRequest;

class APIClient {

    private $host;
    private $key;
    private $pwd;
    private $obl_id;
    private $xdebug_key;
    private $xdebug_profile = false;

    public function __construct($options = array()) {
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

        if (isset($options['obl_id'])) {
            $this->obl_id = $options['obl_id'];
        }
    }

    /**
     * @param string $xdebug_key such as PHPSTORM
     */
    public function set_xdebug_key($xdebug_key) {
        $this->xdebug_key = $xdebug_key;
    }

    /**
     * @param bool $xdebug_profile
     */
    public function set_xdebug_profile($xdebug_profile) {
        $this->xdebug_profile = $xdebug_profile;
    }

    public function api_categories() {
        $response = $this->call('/api/categories');

        return $response->categories;
    }

    public function api_locations() {
        $response = $this->call('/api/locations');

        return $response->locations;
    }

    //Note! Locations are identified by name, not by key.
    public function api_location_suppliers($location_name) {
        $location_name = strtr($location_name, array(' ' => '%20'));
        $response = $this->call('/api/location/' . $location_name . '/suppliers');

        return $response->suppliers;
    }

    public function api_suppliers() {
        $response = $this->call('/api/suppliers');

        return $response->suppliers;
    }

    public function api_accommodation_locations($supplier_key) {
        $response = $this->call('/api/accommodation-locations/' . $supplier_key);

        return $response->locations;
    }

    public function api_accommodation_provider_detail($provider_key) {
        $response = $this->call('/api/accommodation-provider-detail/' . $provider_key);

        return $response->provider;
    }

    public function api_accommodation_availability($provider_key, $check_in, $check_out) {
        $response = $this->call('/api/accommodation-provider-availability/' . $provider_key . '/' . $check_in . '/' . $check_out);

        return $response->availability;
    }

    public function api_accommodation_providers($location_key, $check_in, $check_out) {
        $response = $this->call('/api/accommodation-providers/' . $location_key . '/' . $check_in . '/' . $check_out);

        return $response->providers;
    }

    public function api_supplier($key) {
        $response = $this->call('/api/suppliers/' . $key);
        $suppliers = $response->suppliers;
        if (isset($suppliers[0])) {
            return $suppliers[0];
        }

        return null;
    }

    public function api_supplier2($supplier_key) {
        $response = $this->call("/api/suppliers2/{$supplier_key}");
        $suppliers = $response->suppliers;

        if (isset($suppliers[0])) {
            return $suppliers[0];
        }

        return null;
    }

    /**
     * NOTICE - private api, do not code against this as it may change unpredictably
     *
     * @param string $code
     * @return bool
     * @throws ApiClientException
     * @throws ApiClientNetworkException
     * @throws \ErrorException
     */
    public function api_private_validate_code($code) {
        $response = $this->call("/api/private-validate-code?code=" . urlencode($code));

        return (bool) $response->valid;
    }

    /**
     * @param string|string[] $keys
     * @return \stdClass
     * @throws ApiClientException
     */
    public function api_tours($keys) {
        if (!is_array($keys)) {
            $keys = array($keys);
        }

        $response = $this->call('/api/tours/' . implode(',', $keys));

        return $response->tours;
    }

    /**
     * @param string $supplier_key
     * @param string $voucher_code
     * @return \stdClass
     * @throws ApiClientException
     */
    public function api_voucher($supplier_key, $voucher_code) {
        $query_str = http_build_query(array('supplier' => $supplier_key, 'voucher' => $voucher_code));
        $response = $this->call("/api/voucher?{$query_str}");

        return $response->voucher;
    }

    //NOTE! returns an object with potentially two properties: 'sessions' & 'advance_dates'
    public function api_sessions($supplier_key, $tour_keys, $date, $search_next_available = false, $days = 1, $exclude_capacityholds = null) {
        $pattern = '/api/sessions?supplier=%s&tours=%s&date=%s&search_next_available=%d&days=%d&exclude_capacityholds=%s';
        $tours = is_array($tour_keys) ? implode(',', $tour_keys) : $tour_keys;
        $exclude_capacityholds = is_array($exclude_capacityholds) ? implode(',', $exclude_capacityholds) : $exclude_capacityholds;
        $search_next_available = $search_next_available ? 1 : 0;
        $request = sprintf($pattern, $supplier_key, $tours, $date, $search_next_available, $days, $exclude_capacityholds);

        return $this->call($request);
    }

    /**
     * @param string $supplier_key
     * @param string $experience_key
     * @param string $date
     * @param ResourceRequirement[]|null $resource_requirements
     * @param bool $search_next_available
     * @param int $days
     * @param array|null $exclude_capacity_hold_keys
     * @return \stdClass
     * @throws ApiClientException
     */
    public function api_experience_sessions($supplier_key, $experience_key, $date, $search_next_available = false, $days = 1, array $resource_requirements = null, array $exclude_capacity_hold_keys = null) {
        $data_resource_requirements = array();

        foreach ($resource_requirements as $requirement) {
            $data_resource_requirements[] = $requirement->to_raw_object();
        }

        $data = array(
            'supplier' => $supplier_key,
            'experience_key' => $experience_key,
            'date' => $date,
            'search_next_available' => $search_next_available ? 1 : 0,
            'days' => $days,
            'exclude_capacity_holds' => $exclude_capacity_hold_keys,
            'resource_requirements' => $data_resource_requirements,
        );

        $opts = $this->build_opts($data);

        return $this->call('/api/experience_sessions', $opts);
    }

    /**
     * @param TransportSessionRequest $request
     * @return mixed
     * @throws ApiClientException
     * @throws ApiClientNetworkException
     */
    public function api_transport_sessions(TransportSessionRequest $request) {
        $data = array(
            'supplier' => $request->get_supplier_key(),
            'date' => $request->get_date(),
            'search_next_available' => $request->is_search_next_available() ? '1' : '0',
            'days' => $request->get_days(),
            'exclude_capacity_holds' => $request->get_exclude_capacity_hold_keys(),
            'origin' => $request->get_origin(),
            'destination' => $request->get_destination(),
        );

        $opts = $this->build_opts($data);

        return $this->call('/api/transport-sessions', $opts);
    }

    public function api_pickups($tour_key) {
        $method = '/api/pickups?tour=' . $tour_key;
        $response = $this->call($method);

        return $response->pickups;
    }

    // returns a payment URL for the booking
    public function api_booking(BookingInterface $booking) {
        $data = $booking->to_raw();

        $opts = $this->build_opts($data);

        return $this->call('/api/booking', $opts);
    }

    public function api_booking_update(Booking $booking) {
        $data = $booking->to_raw();
        $opts = $this->build_opts($data);
        return $this->call('/api/booking/update', $opts);
    }

    public function api_promo($promo_code, BookingInterface $booking) {
        $data = $booking->to_raw();
        $data['promo_code'] = $promo_code;

        $opts = $this->build_opts($data);

        return $this->call('/api/promo', $opts);
    }

    public function api_remove_booking($booking_id, $itinerary_key, $booking_type) {
        $data = array(
            'itinerary_key' => $itinerary_key,
            'booking_id' => $booking_id,
            'booking_type' => $booking_type,
        );

        $opts = $this->build_opts($data);

        return $this->call('/api/remove-itinerary-booking', $opts);
    }

    public function api_pay_itinerary($itinerary_key, $return_url = null) {
        $data = array(
            'itinerary_key' => $itinerary_key,
        );

        if ($return_url) {
            $data['return_url'] = $return_url;
        }

        $opts = $this->build_opts($data);

        return $this->call('/api/pay-itinerary', $opts);
    }

    public function api_create_itinerary($primary_customer_key, $additional_customer_keys = array()) {
        $data = array(
            'primary_customer_key' => $primary_customer_key,
            'additional_customer_keys' => $additional_customer_keys,
        );

        $opts = $this->build_opts($data);

        return $this->call('/api/itinerary', $opts);
    }

    public function api_itinerary_tickets_html($token) {
        return file_get_contents($this->api_itinerary_tickets_url($token));
    }

    public function api_itinerary_tickets_url($token) {
        return $this->host . '/api/itinerary/' . urlencode($token) . '/tickets?' . http_build_query(array('apikey' => $this->key, 'obl_id' => $this->obl_id));
    }

    //Makes an api call.
    protected function call($endpoint, $opts = null) {
        if (strpos($endpoint, '/api/') !== 0) {
            throw new ApiClientException('All API requests must begin with /api/');
        }

        //add key
        $separator = strpos($endpoint, '?') === false ? '?' : '&';

        $params = array(
            'apikey' => $this->key,
        );

        // obl_id
        if ($this->obl_id) {
            $params['obl_id'] = $this->obl_id;
        }

        // tracer
        if (session_id()) {
            $params['tracer'] = session_id();
        }

        if ($this->xdebug_key) {
            $params['XDEBUG_SESSION_START'] = $this->xdebug_key;
            $params['XDEBUG_PROFILE'] = 1;
        }

        if ($this->xdebug_profile) {
            $params['XDEBUG_PROFILE'] = 1;
        }

        $url = $this->host . $endpoint . $separator . http_build_query($params);

        // turns warning with file_get_contents into an exception
        set_error_handler(function($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
            throw new \ErrorException($err_msg, 0, $err_severity, $err_file, $err_line);
        });

	    try {
		    //if url_fopen is available (for backwards compatibility)
		    if (ini_get('allow_url_fopen')) {
			    if ($opts == null) {
				    $response_raw = file_get_contents($url);
			    } else {
				    $context = stream_context_create($opts);

				    // 2021-07-16 disable ssl verification due to change in cacert for latest letsencrypt certs
                    $opts['ssl']['verify_peer'] = false;
                    $opts['ssl']['verify_peer_name'] = false;

				    $response_raw = file_get_contents($url, false, $context);
			    }
		    } elseif (function_exists('curl_setopt')) {
			    //if curl is available (in case url_fopen is unavailable)
			    $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url);

                // 2021-07-16 disable ssl verification due to change in cacert for latest letsencrypt certs
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

			    if ($opts) {
				    foreach ($opts AS $k => $v) {
					    curl_setopt($ch, $k, $v);
				    }
			    }

			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			    $response_raw = curl_exec($ch);
			    curl_close($ch);
		    } else {
			    //throw ApiClientException if neither url_fopen or curl is available
			    throw new ApiClientException('File Get Contents or Curl are required');
		    }
	    } catch (\Exception $ex) {
		    throw new ApiClientNetworkException($ex->getMessage(), $ex->getCode(), $ex);
	    } finally {
		    restore_error_handler();
	    }


	    $response = json_decode($response_raw);
	    if (json_last_error() !== JSON_ERROR_NONE) {
		    //json_last_error_msg() support was added in PHP 5.5.0, so minimum PHP 5.5.0
		    $json_error = json_last_error_msg();

		    throw new ApiClientException('Server response invalid JSON format: ' . $json_error . ': ' . $response_raw);
	    }

        if (isset($response->success) && $response->success == false) {
            $code = !empty($response->code) ? $response->code : null;
            $message = !empty($response->message) ? $response->message : null;

            // handle case where msg is returned instead of message
            if (!empty($response->msg)) {
                $message = $response->msg;
            }
            throw new ApiClientException($this->getUserMessageForAPIException($message), $code);
        }

        return $response;
    }

    private function getUserMessageForAPIException($err_msg) {
        return strtr($err_msg, array(
            'datetime past' => 'The chosen date and time has passed, please choose a later date',
            'Trip is closed' => 'The tour is unavailable at the chosen date and time, please choose a different date',
        ));
    }

    public function api_create_customer($first_name, $last_name, $email, $phone) {
        $data = array(
            'fname' => $first_name,
            'lname' => $last_name,
            'email' => $email,
            'phone' => $phone,
        );

        $opts = $this->build_opts($data);

        return $this->call('/api/customer', $opts);
    }

    public function api_accommodation_booking(AccommodationBooking $accommodation_booking) {
        $method = '/api/accommodation-booking';
        $data = get_object_vars($accommodation_booking);
        $content = 'data=' . rawurlencode(json_encode($data));
        $referrer = isset($_SERVER['SCRIPT_URI']) ? $_SERVER['SCRIPT_URI'] : 'Demonstration';

        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => array(
                    'Content-type: application/x-www-form-urlencoded',
                    'Referer: ' . $referrer,
                    'Connection: close',
                    'Accept-language: en',
                    'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                ),
                'content' => $content,
            ),
        );

        return $this->call($method, $opts);
    }

    /**
     * @param string $supplier_key
     * @param string $tour_key
     * @param \DateTimeInterface|string $datetime
     * @param int $pax
     * @param int $expiry_mins
     * @return mixed
     * @throws ApiClientException
     */
    public function api_reserve_capacity($supplier_key, $tour_key, $datetime, $pax, $expiry_mins = 10) {
        if ($datetime instanceof \DateTimeInterface) {
            $datetime = $datetime->format('Y-m-d H:i:s');
        }

        $method = '/api/reserve-capacity?' . http_build_query(array('supplier' => $supplier_key));
        $data = array(
            'tour_key' => $tour_key,
            'datetime' => $datetime,
            'pax' => $pax,
            'expiry_mins' => $expiry_mins,
        );

        $opts = $this->build_opts($data);

        return $this->call($method, $opts);
    }

    /**
     * @param string $supplier_key
     * @param string $capacity_hold_key
     * @return mixed
     * @throws ApiClientException
     */
    public function api_release_capacity($supplier_key, $capacity_hold_key) {
        $method = '/api/release-capacity?' . http_build_query(array('supplier' => $supplier_key));
        $data = array(
            'capacity_hold_key' => $capacity_hold_key,
        );

        $opts = $this->build_opts($data);

        return $this->call($method, $opts);
    }

    private function build_opts($data) {
		//these variables don't change based on fopen or cURL, so define them once here
	    $content = 'data=' . rawurlencode(json_encode($data));
	    $referrer = isset($_SERVER['SCRIPT_URI']) ? $_SERVER['SCRIPT_URI'] : 'Demonstration';
	    $headers = array(
		    'Content-type: application/x-www-form-urlencoded',
		    'Referer: ' . $referrer,
		    'Connection: close',
		    'Accept-language: en',
	    );
	    
	    if (ini_get('allow_url_fopen')) {
		    //is url_fopen is allowed, opts for file_get_contents
		    return array(
			    'http' => array(
				    'method' => 'POST',
				    'header' => $headers,
				    'content' => $content,
			    ),
		    );
	    } elseif (function_exists('curl_setopt')) {
		    //is url_fopen is not allowed and cURL is available, opts for cURL
		    return array(
			    CURLOPT_POST => 1,
			    CURLOPT_POSTFIELDS => $content,
			    CURLOPT_HTTPHEADER => $headers
		    );
	    } else {
		    //throw ApiClientException if neither url_fopen or curl is available
		    throw new ApiClientException('File Get Contents or Curl are required');
	    }
    }

    /**
     * For Internal Use Only
     * @param string $obl_id
     * @return \stdClass
     * @throws ApiClientException
     */
    public function api_obl($obl_id) {
        $response = $this->call("/api/obl/{$obl_id}");

        return $response->obl;
    }

    public function api_ticket_url($token) {
        return $this->host . '/api/ticket?token=' . urlencode($token);
    }

    public function api_ticket_html($token) {
        return file_get_contents($this->api_ticket_url($token));
    }

    /**
     * @param string $token_or_booking_id
     * @return \stdClass
     * @throws ApiClientException
     */
    public function api_booking_status($token_or_booking_id) {
        $token_or_booking_id = urlencode($token_or_booking_id);
        $response = $this->call("/api/booking/{$token_or_booking_id}/status");

        return $response->booking;
    }

    /**
     * @param string $token_or_booking_id
     * @return \stdClass
     * @throws ApiClientException
     */
    public function api_booking_used($token_or_booking_id) {
        $token_or_booking_id = urlencode($token_or_booking_id);
        return $this->call("/api/booking/{$token_or_booking_id}/used");
    }

    /**
     * @param string $token_or_booking_id
     * @return \stdClass
     * @throws ApiClientException
     */
    public function api_booking_status2($token_or_booking_id) {
        $token_or_booking_id = urlencode($token_or_booking_id);
        $response = $this->call("/api/booking/{$token_or_booking_id}/status2");

        return $response->data->booking;
    }

    /**
     * @param string $token
     * @return Booking[]
     * @throws ApiClientException
     */
    public function api_itinerary_status($token) {
        $token = urlencode($token);
        $response = $this->call("/api/itinerary/{$token}/status");

        return $response->itinerary;
    }

    /**
     * @param string $supplier_key
     * @return \stdClass
     * @throws ApiClientException
     */
    public function api_experiences($supplier_key) {
        $query_str = http_build_query(array('supplier' => $supplier_key));
        $response = $this->call("/api/experiences?{$query_str}");

        return $response->experiences;
    }


	/**
	 * @param string $booking_id
	 *
	 * @return mixed
	 * @throws \Rtbs\ApiHelper\Exceptions\ApiClientException
	 * @throws \Rtbs\ApiHelper\Exceptions\ApiClientNetworkException
	 */
	public function api_cancel_booking($booking_id) {
		return $this->call('/api/booking/'.urlencode($booking_id).'/cancel');
	}

    /**
     * @param Booking $booking
     * @return mixed
     * @throws ApiClientException
     * @throws ApiClientNetworkException
     */
    public function api_booking_fees(Booking $booking) {
        $data = $booking->to_raw();
        $opts = $this->build_opts($data);
        return $this->call('/api/booking/fees', $opts);
    }
}
