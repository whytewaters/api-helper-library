<?php namespace Rtbs\ApiHelper\Models;

use Carbon\Carbon;

class SessionsIndexed {

    private $indexed_sessions = [];
    private $indexed_dates = [];
    private $indexed_times = [];
    private $next_available_session;

    /**
     * SessionsIndexed constructor.
     * @param Session[] $tour_sessions
     */
    public function __construct($tour_sessions) {

        foreach ($tour_sessions as $tour_session) {
            // index experience sessions based on the time of the first non-shuttle tour
            $dt = Carbon::parse($tour_session->get_datetime());

            $time = $dt->format('H:i');
            $date = $dt->format('Y-m-d');

            $this->indexed_sessions[$date][$time] = $tour_session;

            $this->indexed_dates[$date] = 1;
            $this->indexed_times[$time] = $tour_session->get_time_str();

            $this->indexed_sessions[$date][$time] = $tour_session;

            if (!$this->next_available_session && $tour_session->is_open()) {
                $this->next_available_session = $tour_session;
            }
        }

        $this->indexed_dates = array_keys($this->indexed_dates);
        asort($this->indexed_dates);
        ksort($this->indexed_times);
    }

    /**
     * @return array
     */
    public function get_dates() {
        return $this->indexed_dates;
    }

    /**
     * @return array
     */
    public function get_times() {
        return $this->indexed_times;
    }

    /**
     * @param string $date
     * @param string $time
     * @return Session
     */
    public function get_session_by_date_time($date, $time) {
        return isset($this->indexed_sessions[$date][$time]) ? $this->indexed_sessions[$date][$time] : null;
    }

    /**
     * @param string|\DateTimeInterface $datetime
     * @return Session
     */
    public function get_session(\DateTimeInterface $datetime) {
        $time = $datetime->format('H:i');
        $date = $datetime->format('Y-m-d');

        return $this->get_session_by_date_time($date, $time);
    }

    /**
     * @return bool
     */
    public function has_sessions() {
        return count($this->indexed_sessions) > 0;
    }

    /**
     * @param \DateTimeInterface $datetime
     * @return bool
     */
    public function is_advance_dates_only(\DateTimeInterface $datetime) {
        return count($this->indexed_dates) > 0 && $this->indexed_dates[0] !== $datetime->format('Y-m-d');
    }

    /**
     * @return \DateTime|null
     */
    public function get_next_available_date() {
        if ($this->next_available_session) {
            return $this->next_available_session->get_datetime_obj();
        }

        return null;
    }

    /**
     * @return Session
     */
    public function get_next_available_session() {
        return $this->next_available_session;
    }

}