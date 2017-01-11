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
     * @return null|string earliest advanced date, or null if none exists
     */
    public function get_earliest_advance_date($tour_keys = null)
    {
        $earliest_date = null;

        if (!empty($tour_keys) && !is_array($tour_keys)) {
            $tour_keys = array($tour_keys);
        }

        foreach ($this->advance_dates as $advance_date) {

            if (!empty($tour_keys) && !in_array($advance_date->tour_key, $tour_keys)) {
                continue;
            }

            if (empty($earliest_date)) {
                $earliest_date = $advance_date->date;
            }

            if ($advance_date->date < $earliest_date) {
                $earliest_date = $advance_date->date;
            }
        }

        return $earliest_date;
    }


    /**
     * @param array|string $tour_keys
     * @return null|string first available date, or null if none exists
     */
    public function get_first_available_session_date($tour_keys = null) {

        $first_available_date = null;

        if (!empty($tour_keys) && !is_array($tour_keys)) {
            $tour_keys = array($tour_keys);
        }

        foreach ($this->sessions as $session) {

            if (!empty($tour_keys) && !in_array($session->get_tour_key(), $tour_keys)) {
                continue;
            }

            if (empty($first_available_date)) {
                $first_available_date = $session->get_datetime();
            }

            if ($session->get_datetime() < $first_available_date) {
                $first_available_date = $session->get_datetime();
            }
        }
        return $first_available_date;
    }



    /**
     * Checks if any of the sessions are open. If not, then you should requery the sessions using the get_earliest_advance_date
     * @return bool
     */
    public function has_open_session()
    {
        $has_open_session = false;

        foreach ($this->sessions as $session) {
            if ($session->is_open()) {
                $has_open_session = true;
                break;
            }
        }

        return $has_open_session;
    }
}