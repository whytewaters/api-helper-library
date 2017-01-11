<?php namespace Rtbs\ApiHelper\Models;


class SessionAndAdvanceDates {

    /** @var Session[] $sessions */
    private $sessions = array();

    private $advance_dates = array();

    /**
     * @return Session[]
     */
    public function get_sessions()
    {
        return $this->sessions;
    }

    /**
     * @param Session $session
     */
    public function add_session($session)
    {
        $this->sessions[] = $session;
    }

    /**
     * @return array
     */
    public function get_advance_dates()
    {
        return $this->advance_dates;
    }

    /**
     * @param array $advance_dates
     */
    public function set_advance_dates($advance_dates)
    {
        $this->advance_dates = $advance_dates;
    }


    /**
     * @param array|string $tour_keys
     * @return null|string first open session datetime, or null if none exists
     */
    public function get_first_open_session_datetime($tour_keys = null) {

        $first_open_datetime = null;

        if (!empty($tour_keys) && !is_array($tour_keys)) {
            $tour_keys = array($tour_keys);
        }

        foreach ($this->sessions as $session) {

            if (!empty($tour_keys) && !in_array($session->get_tour_key(), $tour_keys)) {
                continue;
            }

            if (!$session->is_open()) {
                continue;
            }

            if (empty($first_open_datetime)) {
                $first_open_datetime = $session->get_datetime();
            }

            if ($session->get_datetime() < $first_open_datetime) {
                $first_open_datetime = $session->get_datetime();
            }
        }
        return $first_open_datetime;
    }
    
}