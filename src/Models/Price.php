<?php namespace Rtbs\ApiHelper\Models;

class Price {

    const PRICE_CATEGORY_NAME_ADULT = 'Adult';
    const PRICE_CATEGORY_NAME_CHILD = 'Child';
    const PRICE_CATEGORY_NAME_INFANT = 'Infant';
    const PRICE_CATEGORY_NAME_FOC = 'FOC';
    const PRICE_CATEGORY_NAME_EXTRA = 'Extra';
    const PRICE_CATEGORY_NAME_OTHER = 'Other';
    const PRICE_CATEGORY_NAME_GROUP = 'Group';
    const PRICE_CATEGORY_NAME_FAMILY = 'Family';

    private $price_key;
    private $price_type_key;
    private $price_category_key;
    private $price_category_name;
    private $passenger_count;
    private $name;
    private $description;
    private $rate;
    private $price_code;
    private $qty;
    private $disc;
    private $rate_incl_disc;
    private $total;
    private $total_inc_disc;
    private $max_qty;
    private $min_qty;
    private $min_qty_is_required;
    private $tags = array();
    private $sort_order = 0;

    private $date_valid_from_ymd;
    private $date_valid_to_ymd;
    private $time_valid_from_hms;
    private $time_valid_to_hms;

    private $fields = array();


    /**
     * @return string
     */
    public function get_price_key() {
        return $this->price_key;
    }


    /**
     * @param string $price_key
     */
    public function set_price_key($price_key) {
        $this->price_key = $price_key;
    }


    /**
     * @return string
     */
    public function get_price_type_key() {
        return $this->price_type_key;
    }


    /**
     * @param string $price_type_key
     */
    public function set_price_type_key($price_type_key) {
        $this->price_type_key = $price_type_key;
    }


    /**
     * @return string
     */
    public function get_price_category_key() {
        return $this->price_category_key;
    }


    /**
     * @param string $price_category_key
     */
    public function set_price_category_key($price_category_key) {
        $this->price_category_key = $price_category_key;
    }


    /**
     * @return string
     */
    public function get_price_category_name() {
        return $this->price_category_name;
    }


    /**
     * @param string $price_category_name
     */
    public function set_price_category_name($price_category_name) {
        $this->price_category_name = $price_category_name;
    }


    /**
     * @return int
     */
    public function get_passenger_count() {
        return $this->passenger_count;
    }


    /**
     * @param int $passenger_count
     */
    public function set_passenger_count($passenger_count) {
        $this->passenger_count = $passenger_count;
    }


    /**
     * @return string
     */
    public function get_name() {
        return $this->name;
    }


    /**
     * @param string $name
     */
    public function set_name($name) {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function get_description() {
        return ($this->description != $this->name) ? $this->description : null;
    }


    /**
     * @param string $description
     */
    public function set_description($description) {
        $this->description = $description;
    }


    /**
     * @return float
     */
    public function get_rate() {
        return $this->rate;
    }


    /**
     * @param float $rate
     */
    public function set_rate($rate) {
        $this->rate = $rate;
    }


    /**
     * @return string
     */
    public function get_price_code() {
        return $this->price_code;
    }


    /**
     * @param string $price_code
     */
    public function set_price_code($price_code) {
        $this->price_code = $price_code;
    }


    /**
     * @return int
     */
    public function get_qty() {
        return $this->qty;
    }


    /**
     * @param int $qty
     */
    public function set_qty($qty) {
        $this->qty = $qty;
    }


    /**
     * @return int
     */
    public function get_min_qty() {
        return (int) $this->min_qty;
    }


    /**
     * @param int $min_qty
     */
    public function set_min_qty($min_qty) {
        $this->min_qty = $min_qty;
    }


    /**
     * @return int
     */
    public function get_min_qty_is_required() {
        return (int) $this->min_qty_is_required;
    }


    /**
     * @param int $min_qty_is_required
     */
    public function set_min_qty_is_required($min_qty_is_required) {
        $this->min_qty_is_required = $min_qty_is_required;
    }


    /**
     * TODO 99999 is a made up qty, this should really be done in the api itself
     * @return int
     */
    public function get_max_qty() {
        return (int) ($this->max_qty == 0) ? 99999 : $this->max_qty;
    }


    /**
     * @param int $max_qty
     */
    public function set_max_qty($max_qty) {
        $this->max_qty = $max_qty;
    }


    /**
     * @return float
     */
    public function get_disc() {
        return $this->disc;
    }


    /**
     * @param float $disc
     */
    public function set_disc($disc) {
        $this->disc = $disc;
    }


    /**
     * @return float
     */
    public function get_rate_incl_disc() {
        return $this->rate_incl_disc;
    }


    /**
     * @param float $rate_incl_disc
     */
    public function set_rate_incl_disc($rate_incl_disc) {
        $this->rate_incl_disc = $rate_incl_disc;
    }


    /**
     * @return float
     */
    public function get_total() {
        return $this->total;
    }


    /**
     * @param float $total
     */
    public function set_total($total) {
        $this->total = $total;
    }


    /**
     * @return float
     */
    public function get_total_inc_disc() {
        return $this->total_inc_disc;
    }


    /**
     * @param float $total_inc_disc
     */
    public function set_total_inc_disc($total_inc_disc) {
        $this->total_inc_disc = $total_inc_disc;
    }


    /**
     * @param string $tags
     */
    public function set_tags($tags) {
        if ($tags == null) {
            $this->tags = [];
        } else {
            $this->tags = explode(' ', $tags);
        }
    }

    /**
     * @return array
     */
    public function get_tags() {
        return $this->tags;
    }

    /**
     * @param string $tags
     */
    public function has_tag($has_tag) {
        return in_array(strtoupper(trim($has_tag)), $this->tags);
    }


    /**
     * @return Field[]
     */
    public function get_fields() {
        return $this->fields;
    }

    /**
     * @return string yyyy-mm-dd
     */
    public function get_date_valid_from() {
        return $this->date_valid_from_ymd;
    }

    /**
     * @return string yyyy-mm-dd
     */
    public function get_date_valid_to() {
        return $this->date_valid_to_ymd;
    }

    /**
     * @return string hh:mm:ss
     */
    public function get_time_valid_from() {
        return $this->time_valid_from_hms;
    }

    /**
     * @return string hh:mm:ss
     */
    public function get_time_valid_to() {
        return $this->time_valid_to_hms;
    }

    public function is_valid_at(\DateTimeInterface $trip_datetime) {

        $trip_date = $trip_datetime->format('Y-m-d');

        if ($trip_date < $this->date_valid_from_ymd || $trip_date > $this->date_valid_to_ymd) {
            return false;
        }

        $trip_time = $trip_datetime->format('H:m:s');

        if ($trip_time < $this->time_valid_from_hms || $trip_time > $this->time_valid_to_hms) {
            return false;
        }

        return true;
    }

    /**
     * @return int
     */
    public function get_sort_order() {
        return $this->sort_order;
    }

    public static function from_raw($raw_price) {
        $price = new Price();

        if (property_exists($raw_price, 'price_key')) {
            $price->set_price_key($raw_price->price_key);
        }

        if (property_exists($raw_price, 'price_type_key')) {
            $price->set_price_type_key($raw_price->price_type_key);
        }

        if (property_exists($raw_price, 'price_category_key')) {
            $price->set_price_category_key($raw_price->price_category_key);
        }

        if (property_exists($raw_price, 'price_category_name')) {
            $price->set_price_category_name($raw_price->price_category_name);
        }

        if (property_exists($raw_price, 'passenger_count')) {
            $price->set_passenger_count($raw_price->passenger_count);
        }

        // sessions api calls it price name
        if (property_exists($raw_price, 'price_name')) {
            $price->set_name($raw_price->price_name);
        }

        // tours api calls it name
        if (property_exists($raw_price, 'name')) {
            $price->set_name($raw_price->name);
        }

        if (property_exists($raw_price, 'description')) {
            $price->set_description($raw_price->description);
        }

        if (property_exists($raw_price, 'rate')) {
            $price->set_rate($raw_price->rate);
        }

        if (property_exists($raw_price, 'price_code')) {
            $price->set_price_code($raw_price->price_code);
        }

        if (property_exists($raw_price, 'qty')) {
            $price->set_qty($raw_price->qty);
        }

        if (property_exists($raw_price,'max_qty')) {
            $price->set_max_qty($raw_price->max_qty);
        }

        if (property_exists($raw_price,'min_qty')) {
            $price->set_min_qty($raw_price->min_qty);
        }

        if (property_exists($raw_price,'min_qty_is_required')) {
            $price->set_min_qty_is_required($raw_price->min_qty_is_required);
        }

        if (property_exists($raw_price, 'disc')) {
            $price->set_disc($raw_price->disc);
        }

        if (property_exists($raw_price, 'rate_incl_disc')) {
            $price->set_rate_incl_disc($raw_price->rate_incl_disc);
        }

        if (property_exists($raw_price, 'total')) {
            $price->set_total($raw_price->total);
        }

        if (property_exists($raw_price, 'total_inc_disc')) {
            $price->set_total_inc_disc($raw_price->total_inc_disc);
        }

        if (property_exists($raw_price, 'total_inc_disc')) {
            $price->set_total_inc_disc($raw_price->total_inc_disc);
        }

        if (property_exists($raw_price, 'tags')) {
            $price->set_tags($raw_price->tags);
        }

        if (property_exists($raw_price, 'date_valid_from')) {
            $price->date_valid_from_ymd = $raw_price->date_valid_from;
        }

        if (property_exists($raw_price, 'date_valid_to')) {
            $price->date_valid_to_ymd = $raw_price->date_valid_to;
        }

        if (property_exists($raw_price, 'price_time_from')) {
            $price->time_valid_from_hms = $raw_price->price_time_from;
        }

        if (property_exists($raw_price, 'price_time_to')) {
            $price->time_valid_to_hms = $raw_price->price_time_to;
        }

        if (property_exists($raw_price, 'fields') && is_array($raw_price->fields)) {
            foreach($raw_price->fields as $raw_field) {
                $price->fields[] = Field::from_raw($raw_field);
            }
        }

        if (property_exists($raw_price, 'sort_order')) {
            $price->sort_order = $raw_price->sort_order;
        }

        return $price;
    }

}