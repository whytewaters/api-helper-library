<?php namespace Rtbs\ApiHelper\Models;

use Carbon\Carbon;

class ExperienceSession
{
    private $datetime;
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