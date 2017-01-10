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
     * @return string|null earliest advanced date, or null if none exists
     */
    public function get_earliest_advance_date()
    {
        $earliest_date = null;

        foreach ($this->advance_dates as $advance_date) {
            if ($earliest_date == null || $advance_date->date < $earliest_date) {
                $earliest_date = $advance_date->date;
            }
        }

        return $earliest_date;
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