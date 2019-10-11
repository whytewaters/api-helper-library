<?php

namespace Rtbs\ApiHelper\Models;

class TransportSessionRequest {
    private $supplier_key;
    private $date;
    private $days = 1;
    private $is_search_next_available;
    private $exclude_capacity_hold_keys;
    private $origin;
    private $destination;

    public function get_supplier_key() {
        return $this->supplier_key;
    }

    public function set_supplier_key($supplier_key) {
        $this->supplier_key = $supplier_key;
    }

    public function get_date() {
        return $this->date;
    }

    public function set_date($date) {
        if ($date instanceof \DateTimeInterface) {
            $date = $date->format('Y-m-d');
        }
        $this->date = $date;
    }

    public function is_search_next_available() {
        return (bool)$this->is_search_next_available;
    }

    public function set_is_search_next_available($is_search_next_available) {
        $this->is_search_next_available = (bool)$is_search_next_available;
    }

    public function get_days() {
        return $this->days;
    }

    public function set_days($days) {
        $this->days = $days;
    }

    public function get_exclude_capacity_hold_keys() {
        return $this->exclude_capacity_hold_keys;
    }

    public function set_exclude_capacity_hold_keys($exclude_capacity_hold_keys) {
        $this->exclude_capacity_hold_keys = $exclude_capacity_hold_keys;
    }

    public function get_origin() {
        return $this->origin;
    }

    public function set_origin_and_destination($origin, $destination) {
        $this->origin = $origin;
        $this->destination = $destination;
    }

    public function get_destination() {
        return $this->destination;
    }
}