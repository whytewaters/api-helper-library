<?php namespace Rtbs\ApiHelper\Models;

class PriceSelection {

    /** @var Price $price */
    private $price;
    private $qty;
    private $fields = array();
    private $is_voucher = false;

    public function __construct(Price $price, $qty, $is_voucher = false) {
        $this->price = $price;
        $this->qty = (int)$qty;
        $this->amount = $this->price->get_rate() * $this->qty;
        $this->is_voucher = $is_voucher;
    }

    /**
     * @return int
     */
    public function get_total_pax() {
        return $this->price->get_passenger_count() * $this->qty;
    }

    /**
     * @return float
     */
    public function get_amount() {
        if ($this->is_voucher) {
            return 0;
        }

        return $this->price->get_rate() * $this->qty;
    }

    /**
     * @return int
     */
    public function get_qty() {
        return $this->qty;
    }

    /**
     * @return Price|null
     */
    public function get_price() {
        return $this->price;
    }

    /**
     * @return array
     */
    public function get_fields() {
        return $this->fields;
    }

    /**
     * @param string $field_name
     * @param int $idx
     * @return mixed|null
     */
    public function get_field($field_name, $idx) {
        return isset($this->fields[$field_name][$idx]) ? $this->fields[$field_name][$idx] : null;
    }

    public function set_field($field_name, $idx, $value) {
        $this->fields[$field_name][$idx] = $value;
    }

    public function clear_fields() {
        $this->fields = array();
    }

}