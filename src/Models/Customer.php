<?php namespace Rtbs\ApiHelper\Models;


class Customer {
    private $customer_key;

    public static function fromRaw($raw_customer) {
        $customer = new Customer();

        $customer->set_customer_key($raw_customer->customer_key);

        return $customer;
    }

    public function set_customer_key($customer_key) {
        $this->customer_key = $customer_key;
    }

    public function get_customer_key() {
        return $this->customer_key;
    }
}