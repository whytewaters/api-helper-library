<?php

namespace Rtbs\ApiHelper\Models;

/**
 * TransportSession wraps a Session and adds properties relative to transport, such as origin and destination.
 */
class TransportSession extends Session {

    private $origin;
    private $destination;

    public function get_origin() {
        return $this->origin;
    }

    public function get_destination() {
        return $this->destination;
    }

    public static function from_raw_session($raw_transport_session) {
        $transport_session = TransportSession::from_raw($raw_transport_session);

        if (property_exists($raw_transport_session, 'origin')) {
            $transport_session->origin = $raw_transport_session->origin;
        }
        if (property_exists($raw_transport_session, 'destination')) {
            $transport_session->destination = $raw_transport_session->destination;
        }

        return $transport_session;
    }

}
