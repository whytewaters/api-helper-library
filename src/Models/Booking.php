<?php namespace Rtbs\ApiHelper\Models;


class Booking
{
	private $experience_key;
	private $tour_key;
    private $datetime;
    private $first_name;
    private $last_name;
    private $email;
    private $phone;
    private $promo_key;
    private $price_selections = array();
    private $prices = array();

    private $status;
    private $booking_id;
    private $id;
    private $valid_until;
    private $is_used;
    private $supplier_key;
    private $supplier_name;
    private $tour_name;
    private $promo_code;
    private $pickup_time;
    private $pickup_point;
	private $pickup_location;
    private $comment;
    private $total;
    private $total_disc;
    private $total_inc_disc;

    private $tour_fields;

    private $price_fields;

    private $return_url;
    private $pickup_key;
    private $itinerary_key;
    private $capacity_hold_key;
    private $voucher_key;
	private $obl_id;
	private $token;

	/** @var ResourceRequirement[] $resource_requirements */
	private $resource_requirements;


	/**
     * @return mixed
     */
    public function get_status()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function get_booking_id()
    {
        return $this->booking_id;
    }

    /**
     * @param mixed $booking_id
     */
    public function set_booking_id($booking_id)
    {
        $this->booking_id = $booking_id;
    }

    /**
     * @return mixed
     */
    public function get_id()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    protected function set_id($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function get_valid_until()
    {
        return $this->valid_until;
    }

    /**
     * @param mixed $valid_until
     */
    protected function set_valid_until($valid_until)
    {
        $this->valid_until = $valid_until;
    }

    /**
     * @return mixed
     */
    public function get_is_used()
    {
        return $this->is_used;
    }

    /**
     * @param mixed $is_used
     */
    protected function set_is_used($is_used)
    {
        $this->is_used = $is_used;
    }

    /**
     * @return mixed
     */
    public function get_supplier_key()
    {
        return $this->supplier_key;
    }

    /**
     * @param mixed $supplier_key
     */
    protected function set_supplier_key($supplier_key)
    {
        $this->supplier_key = $supplier_key;
    }

    /**
     * @return mixed
     */
    public function get_supplier_name()
    {
        return $this->supplier_name;
    }

    /**
     * @param mixed $supplier_name
     */
    protected function set_supplier_name($supplier_name)
    {
        $this->supplier_name = $supplier_name;
    }

    /**
     * @return mixed
     */
    public function get_tour_name()
    {
        return $this->tour_name;
    }

    /**
     * @param mixed $tour_name
     */
    protected function set_tour_name($tour_name)
    {
        $this->tour_name = $tour_name;
    }

    /**
     * @return mixed
     */
    public function get_promo_code()
    {
        return $this->promo_code;
    }

    /**
     * @param mixed $promo_code
     */
	public function set_promo_code($promo_code)
    {
        $this->promo_code = $promo_code;
    }

    /**
     * @return mixed
     */
    public function get_pickup_time()
    {
        return $this->pickup_time;
    }

    /**
     * @param mixed $pickup_time
     */
    protected function set_pickup_time($pickup_time)
    {
        $this->pickup_time = $pickup_time;
    }

    /**
     * @return mixed
     */
    public function get_pickup_point()
    {
        return $this->pickup_point;
    }

    /**
     * @param string|null $pickup_point
     */
	protected function set_pickup_point($pickup_point)
    {
        $this->pickup_point = $pickup_point;
    }


	/**
	 * @param string|null $pickup_location
	 */
	public function set_pickup_location($pickup_location) {
		$this->pickup_location = $pickup_location;
	}


    /**
     * @return mixed
     */
    public function get_comment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function set_comment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function get_total()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    private function set_total($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function get_total_disc()
    {
        return $this->total_disc;
    }

    /**
     * @param mixed $total_disc
     */
    protected function set_total_disc($total_disc)
    {
        $this->total_disc = $total_disc;
    }

    /**
     * @return mixed
     */
    public function get_total_inc_disc()
    {
        return $this->total_inc_disc;
    }

    /**
     * @param mixed $total_inc_disc
     */
    protected function set_total_inc_disc($total_inc_disc)
    {
        $this->total_inc_disc = $total_inc_disc;
    }



    /**
     * @return mixed
     */
    public function get_tour_key()
    {
        return $this->tour_key;
    }

    /**
     * @param mixed $tour_key
     */
    public function set_tour_key($tour_key)
    {
        $this->tour_key = $tour_key;
    }

    /**
     * @return mixed
     */
    public function get_datetime()
    {
        return $this->datetime;
    }

    /**
     * @param \DateTimeInterface|string $datetime
     */
    public function set_datetime($datetime)
    {
        if ($datetime instanceof \DateTimeInterface) {
            $this->datetime = $datetime->format('Y-m-d H:i:s');
        } else {
            $this->datetime = $datetime;
        }
    }

    /**
     * @return mixed
     */
    public function get_first_name()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function set_first_name($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function get_last_name()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function set_last_name($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function get_email()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function set_email($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function get_phone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function set_phone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function get_promo_key()
    {
        return $this->promo_key;
    }

    /**
     * @param mixed $promo_key
     */
    public function set_promo_key($promo_key)
    {
        $this->promo_key = $promo_key;
    }


    public function add_price_selection(Price $price, $quantity, $fields = null) {
        $this->price_selections[] = array(
            'price_key' => $price->get_price_key(),
            'qty' => (int) $quantity,
	        'fields' => $fields,
        );
    }


    public function add_price_selection_keys($price_key, $quantity, $fields = null) {
        $this->price_selections[] = array(
            'price_key' => $price_key,
            'qty' => (int) $quantity,
	        'fields' => $fields,
        );
    }


    protected function add_price(Price $price) {
        $this->prices[] = $price;
    }


	/**
	 * @return Price[]
	 */
    public function get_prices()
    {
        return $this->prices;
    }


    public function add_tour_field($field_name, $value) {
    	$this->tour_fields[] = array(
    		'name' => $field_name,
		    'value' => $value,
	    );
    }

    /**
     * @return array
     */
    public function get_price_selections() {
        return $this->price_selections;
    }

    /**
     * @param string $return_url
     */
    public function set_return_url($return_url) {
        $this->return_url = $return_url;
    }

    /**
     * @param string $pickup_key
     */
    public function set_pickup_key($pickup_key) {
        $this->pickup_key = $pickup_key;
    }

    /**
     * @param string|null $itinerary_key
     */
    public function set_itinerary_key($itinerary_key) {
        $this->itinerary_key = $itinerary_key;
    }


    /**
     * @return string|null
     */
    public function get_itinerary_key() {
        return $this->itinerary_key;
    }


	public function set_capacity_hold_key($capacity_hold_key)
	{
		$this->capacity_hold_key = $capacity_hold_key;
	}


	/**
	 * @param string $voucher_key
	 */
	public function set_voucher_key($voucher_key)
	{
		$this->voucher_key = $voucher_key;
	}


	/**
	 * @param string $obl_id
	 */
	public function set_obl_id($obl_id)
	{
		$this->obl_id = $obl_id;
	}


	/**
	 * @return string
	 */
	public function get_token()
	{
		return $this->token;
	}


	/**
	 * @param $experience_key
	 */
	public function set_experience_key($experience_key)
	{
		$this->experience_key = $experience_key;
	}


	/**
	 * @param ResourceRequirement[] $resource_requirements
	 */
	public function set_resource_requirements($resource_requirements)
	{
		$this->resource_requirements = $resource_requirements;
	}


    public function to_raw() {
        $raw = array(
            'tour_key' => $this->tour_key,
            'experience_key' => $this->experience_key,
            'datetime' => $this->datetime,
            'fname' => $this->first_name,
            'lname' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
	        'fields' => $this->tour_fields,
	        'prices' => $this->price_selections,
	        'resource_requirements' => [],
        );

        if (isset($this->resource_requirements)) {
            foreach ($this->resource_requirements as $resource_requirement) {
	            $raw['resource_requirements'][] = $resource_requirement->to_raw_object();
            }
        }

        if(is_numeric($this->promo_key)) {
		    $raw['promo_key'] = $this->promo_key;
	    }

	    if(!empty($this->promo_code)) {
		    $raw['promo_code'] = $this->promo_code;
	    }

        if (!empty($this->return_url)) {
            $raw['return_url'] = $this->return_url;
        }

        if (!empty($this->pickup_key)) {
            $raw['pickup_key'] = $this->pickup_key;
        }

	    if (!empty($this->pickup_location)) {
		    $raw['pickup_location'] = $this->pickup_location;
	    }

	    if (!empty($this->pickup_notes)) {
		    $raw['pickup_key'] = $this->pickup_key;
	    }

        if (!empty($this->comment)) {
            $raw['comment'] = $this->comment;
        }

        if (!empty($this->itinerary_key)) {
            $raw['itinerary_key'] = $this->itinerary_key;
        }

        if (!empty($this->capacity_hold_key)) {
            $raw['capacity_hold_key'] = $this->capacity_hold_key;
        }

	    if (!empty($this->voucher_key)) {
		    $raw['voucher_key'] = $this->voucher_key;
	    }

	    if (!empty($this->obl_id)) {
		    $raw['obl_id'] = $this->obl_id;
	    }

        return $raw;
    }


    public static function from_raw($raw_booking)
    {
		$booking = new Booking();

	    $booking->status = $raw_booking->status;
	    $booking->set_booking_id($raw_booking->booking_id);
	    $booking->set_id($raw_booking->id);
	    $booking->set_first_name($raw_booking->fname);
	    $booking->set_last_name($raw_booking->lname);
	    $booking->set_email($raw_booking->email);
	    $booking->set_phone($raw_booking->phone);
	    $booking->set_datetime($raw_booking->datetime);
	    $booking->set_valid_until($raw_booking->valid_until);
	    $booking->set_is_used($raw_booking->is_used);
	    $booking->set_supplier_key($raw_booking->supplier_key);
	    $booking->set_supplier_name($raw_booking->supplier_name);
	    $booking->set_tour_key($raw_booking->tour_key);
	    $booking->set_tour_name($raw_booking->tour_name);
	    $booking->set_promo_code($raw_booking->promo_code);
	    $booking->set_pickup_time($raw_booking->pickup_time);
	    $booking->set_pickup_point($raw_booking->pickup_point);
	    $booking->set_comment($raw_booking->comment);
	    $booking->set_total($raw_booking->total);

	    if (property_exists($raw_booking, 'itinerary_key')) {
		    $booking->itinerary_key = $raw_booking->itinerary_key;
	    }

	    if (property_exists($raw_booking, 'token')) {
		    $booking->token = $raw_booking->token;
        }

        foreach($raw_booking->prices as $raw_price) {
	        $booking->add_price(Price::from_raw($raw_price));
        }

        return $booking;
    }
}