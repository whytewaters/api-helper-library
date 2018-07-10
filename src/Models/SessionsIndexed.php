<?php namespace Rtbs\ApiHelper\Models;


class SessionsIndexed {

    private $indexed_sessions = [];
    private $indexed_dates = [];
    private $indexed_times = [];

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

            $this->indexed_sessions[$time][$date] = $tour_session;

            $this->indexed_dates[$date] = 1;
            $this->indexed_times[$time] = $tour_session->get_time_str();

            $this->indexed_sessions[$time][$date] = $tour_session;
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
    public function get_session($date, $time) {
        return isset($this->indexed_sessions[$time][$date]) ? $this->indexed_sessions[$time][$date] : null;
    }

    /**
     * @param string|\DateTimeInterface $datetime
     * @return Session
     */
    public function get_session_by_datetime($datetime) {
        $dt = Carbon::parse($datetime);

        $time = $dt->format('H:i');
        $date = $dt->format('Y-m-d');

        return $this->get_session($date, $time);
    }
}