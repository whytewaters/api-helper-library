<?php namespace Rtbs\ApiHelper\Models;

use Carbon\Carbon;

class ExperienceSession
{
    private $datetime;

    /** @var Session[] */
    private $tour_sessions = array();


    /**
     * @return Carbon
     */
    public function get_datetime()
    {
        return $this->datetime;
    }


    /**
     * @return Session[]
     */
    public function get_tour_sessions()
    {
        return $this->tour_sessions;
    }


    /**
     * If any of the tours is closed, then the experince should be closed too
     * @return bool
     */
    public function is_open()
    {
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
    public function get_state()
    {
        foreach ($this->tour_sessions as $tour_session) {
            if (!$tour_session->is_open()) {
                return $tour_session->get_state();
            }
        }

        return $this->tour_sessions[0]->get_state();
    }


    public static function from_raw($raw_session)
    {
        $experience_session = new ExperienceSession();
        $experience_session->datetime = Carbon::parse($raw_session->datetime);

        foreach($raw_session->tour_sessions as $raw_tour_session) {
            $experience_session->tour_sessions[] = Session::from_raw($raw_tour_session);
        }

        return $experience_session;
    }
}