<?php namespace Rtbs\ApiHelper\Models;


class Session {
	private $datetime;
	private $time_str;
	private $max_pax;
	private $min_pax;
	private $open;
	private $remaining;
    private $resources_remaining;
	private $state;
	private $tour_key;
	private $is_primary = false;
	private $linked_pax_group = null;


	/** @var Price[] $prices */
	private $prices = array();


	/**
	 * @return string
	 */
	public function get_datetime() {
		return $this->datetime;
	}


	/**
	 * @return string
	 */
	public function get_time_str() {
		return $this->time_str;
	}


	/**
	 * @return string
	 */
	public function get_tour_key() {
		return $this->tour_key;
	}


	/**
	 * @return boolean
	 */
	public function is_open() {
		return ($this->open && $this->has_prices());
	}


	/**
	 * @return Price[]
	 */
	public function get_prices() {
		return $this->prices;
	}


	/**
	 * @param string $price_type_key
	 * @return Price|null
	 */
	public function get_price($price_type_key) {
		foreach ($this->prices as $price) {
			if ($price->get_price_type_key() == $price_type_key) {
				return $price;
			}
		}

		return null;
	}


    /**
     * @param string $price_category_name
     * @return Price|null
     */
    public function get_price_by_category_name($price_category_name) {
        foreach ($this->prices as $price) {
            if ($price->get_price_category_name() === $price_category_name) {
                return $price;
            }
        }

        return null;
    }

	/**
	 * @param Price[] $prices
	 */
	public function set_prices($prices) {
		$this->prices = $prices;
	}


	/**
	 * @return bool
	 */
	public function has_prices() {
		return (count($this->prices) > 0);
	}


	/**
	 * @return float|null
	 */
	public function get_min_price() {
		$adult_min_price = 999999;
        $other_min_price = 999999;

		foreach ($this->prices as $price) {
		    if ($price->get_passenger_count() > 0) {
		        switch ($price->get_price_category_name()) {
                    case Price::PRICE_CATEGORY_NAME_ADULT:
                        $adult_min_price = min($adult_min_price, $price->get_rate());
                        break;

                    case Price::PRICE_CATEGORY_NAME_EXTRA:
                    case Price::PRICE_CATEGORY_NAME_FOC:
                        // ignore these price types
                        break;

                    default:
                        $other_min_price = min($other_min_price, $price->get_rate());
                        break;
                }
			}
		}

		if ($adult_min_price != 999999) {
		    return $adult_min_price;
        }

        if ($other_min_price != 999999) {
		    return $other_min_price;
        }

		return 0;
	}


	/**
	 * @return string
	 */
	public function get_state() {
		return ($this->has_prices()) ? $this->state : 'Not Available';
	}


	/**
	 * @return mixed
	 */
	public function get_remaining() {
		return $this->remaining;
	}


    /**
     * @return mixed
     */
    public function get_resources_remaining() {
        return $this->resources_remaining;
    }


	/**
	 * @return int
	 */
	public function get_min_pax() {
		return $this->min_pax;
	}


	/**
	 * @return int
	 */
	public function get_max_pax() {
		return $this->max_pax;
	}


	/**
	 * @return bool
	 */
	public function is_primary() {
		return $this->is_primary;
	}


	/**
	 * @return string
	 */
	public function get_linked_pax_group() {
		return $this->linked_pax_group;
	}


	/**
	 * @param \stdClass $raw_session
	 *
	 * @return Session
	 */
	public static function from_raw($raw_session) {
		$session = new Session();

		$session->datetime = $raw_session->datetime;
		$session->time_str = $raw_session->time_str;
		$session->tour_key = $raw_session->tour_key;
		$session->open = $raw_session->open;
		$session->state = $raw_session->state;
		$session->remaining = $raw_session->remaining;

		if (property_exists($raw_session, 'min_pax')) {
			$session->min_pax = $raw_session->min_pax;
		}

		if (property_exists($raw_session, 'max_pax')) {
			$session->max_pax = $raw_session->max_pax;
		}

        if (property_exists($raw_session, 'resources_remaining')) {
            $session->resources_remaining = $raw_session->resources_remaining;
        }

		if (property_exists($raw_session, 'is_primary')) {
			$session->is_primary = $raw_session->is_primary;
		}

		if (property_exists($raw_session, 'linked_pax_group')) {
			$session->linked_pax_group = $raw_session->linked_pax_group;
		}

		foreach ($raw_session->prices as $raw_price) {
			$session->prices[] = Price::from_raw($raw_price);
		}

		return $session;
	}

}