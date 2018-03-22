<?php namespace Rtbs\ApiHelper\Models;


class Session {
	private $datetime;
	private $time_str;
	private $max_pax;
	private $min_pax;
	private $open;
	private $remaining;
	private $state;
	private $tour_key;


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
		$min_price = null;

		foreach ($this->prices as $price) {
			if ($price->get_price_category_name() == Price::PRICE_CATEGORY_NAME_ADULT && $price->get_passenger_count() > 0
			    && ($min_price === null || $price->get_rate() < $min_price)) {
				$min_price = $price->get_rate();
			}
		}

		return $min_price;
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

		foreach ($raw_session->prices as $raw_price) {
			$session->prices[] = Price::from_raw($raw_price);
		}

		return $session;
	}

}