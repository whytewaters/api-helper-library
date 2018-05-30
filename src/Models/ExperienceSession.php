<?php namespace Rtbs\ApiHelper\Models;

use Carbon\Carbon;

class ExperienceSession {
    private $datetime;
    private $experience_key;

    /** @var Session[] */
    private $tour_sessions = array();


    /**
     * @return Carbon
     */
    public function get_datetime() {
        return $this->datetime;
    }


    /**
     * @return Session[]
     */
    public function get_tour_sessions() {
        return $this->tour_sessions;
    }


	/**
	 * @return Session
	 */
	public function get_primary_tour_session() {
		foreach ($this->tour_sessions as $tour_session) {
			if ($tour_session->is_primary()) {
				return $tour_session;
			}
		}

		return null;
	}


	/**
	 * @return Session
	 */
	public function get_tour_session($tour_key) {
		foreach ($this->tour_sessions as $tour_session) {
			if ($tour_session->get_tour_key() === $tour_key) {
				return $tour_session;
			}
		}

		return null;
	}


	/**
     * If any of the tours is closed, then the experince should be closed too
     * @return bool
     */
    public function is_open() {
        foreach ($this->tour_sessions as $tour_session) {
            if (!$tour_session->is_open()) {
                return false;
            }
        }

        return true;
    }


    /**
     * If any of the tours is closed, use that state otherwise, show the first state
     * TODO need to review how this works, what if one tour is call for availability, how am i supposed to know what the lowest setting should be
     * @return string
     */
    public function get_state() {
        foreach ($this->tour_sessions as $tour_session) {
            if (!$tour_session->is_open()) {
                return $tour_session->get_state();
            }
        }

        return $this->tour_sessions[0]->get_state();
    }


	/**
	 * Aggregate remaing pax from all tours
	 * @return int
	 */
	public function get_remaining() {

		$pax_remaining = 999999;

		foreach ($this->tour_sessions as $tour_session) {
			if (!$tour_session->is_open()) {
				return 0;
			}

			$pax_remaining = min($pax_remaining, $tour_session->get_remaining());
		}

		return $pax_remaining;
	}


	/**
	 * Aggregate max pax from all tours
	 * @return int
	 */
	public function get_max_pax() {

		$max_pax = 999999;

		foreach ($this->tour_sessions as $tour_session) {
			if (!$tour_session->is_open()) {
				return 0;
			}

			$max_pax = min($max_pax, $tour_session->get_max_pax());
		}

		return $max_pax;
	}


	/**
	 * Aggregate min pax from all tours
	 * @return int
	 */
	public function get_min_pax() {

		$min_pax = 0;

		foreach ($this->tour_sessions as $tour_session) {
			if (!$tour_session->is_open()) {
				return 0;
			}

			$min_pax = max($min_pax, $tour_session->get_min_pax());
		}

		return $min_pax;
	}


	/**
	 * @return string
	 */
	public function get_experience_key() {
		return $this->experience_key;
	}


//	/**
//	 * @param string $time_formatted
//	 */
//	public function set_time_formatted($time_formatted) {
//		$this->time_formatted = $time_formatted;
//	}
//
//
//	/**
//	 * @return string
//	 */
//	public function get_time_formatted() {
//		return $this->time_formatted;
//	}


    public static function from_raw($raw_experience_session) {
        $experience_session = new ExperienceSession();
        $experience_session->datetime = Carbon::parse($raw_experience_session->datetime);
        $experience_session->experience_key = $raw_experience_session->experience_key;

        foreach($raw_experience_session->tour_sessions as $raw_tour_session) {
            $experience_session->tour_sessions[] = Session::from_raw($raw_tour_session);
        }

        return $experience_session;
    }
}