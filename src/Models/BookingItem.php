<?php namespace Rtbs\ApiHelper\Models;

class BookingItem {
    private $uuid;
    private $price;
    private $qty;
    private $fields;

    /**
     * BookingItem constructor.
     * @param Price $price
     * @param int $qty
     * @param string[] $fields
     */
    public function __construct($price, $qty, $fields) {
        $this->price = $price;
        $this->qty = $qty;
        $this->fields = $fields;

        // uuid to identify the record internally
        $this->uuid = uniqid('rtbs-apihelper', true);
    }

}