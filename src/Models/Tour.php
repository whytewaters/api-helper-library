<?php namespace Rtbs\ApiHelper\Models;

class Tour {
    private $tour_key;
    private $name;
    private $info_date_range_notes = array();
    private $supplier_key;
    private $description;
    private $info_directions;
    private $info_bring;
    private $info_provided;
    private $info_transport;
    private $url_img;
    private $directions_html;
    private $description_short_html;
    private $information_html;
    private $is_show_obl;
    private $has_promo_codes;
    private $terms_html;
    private $info_restrictions;
    private $info_duration;
    private $info_season;
    private $sector_start;
    private $sector_end;
    private $scheduled_times = array();
    private $pickups = array();

    /** @var Price[] */
    private $prices = array();

    /** @var Field[] */
    private $fields = array();

    /**
     * @return string
     */
    public function get_tour_key() {
        return $this->tour_key;
    }

    /**
     * @param string $tour_key
     */
    public function set_tour_key($tour_key) {
        $this->tour_key = $tour_key;
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
    public function get_supplier_key() {
        return $this->supplier_key;
    }

    /**
     * @param string $supplier_key
     */
    public function set_supplier_key($supplier_key) {
        $this->supplier_key = $supplier_key;
    }

    /**
     * @return string
     */
    public function get_description() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function set_description($description) {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function get_info_directions() {
        return $this->info_directions;
    }

    /**
     * @param string $info_directions
     */
    public function set_info_directions($info_directions) {
        $this->info_directions = $info_directions;
    }

    /**
     * @return string
     */
    public function get_directions_html() {
        return $this->directions_html;
    }

    /**
     * @param string $directions_html
     */
    public function set_directions_html($directions_html) {
        $this->directions_html = $directions_html;
    }

    /**
     * @return string
     */
    public function get_description_short_html() {
        return $this->description_short_html;
    }

    /**
     * @param string $description_short_html
     */
    public function set_description_short_html($description_short_html) {
        $this->description_short_html = $description_short_html;
    }

    /**
     * @return string
     */
    public function get_information_html() {
        return $this->information_html;
    }

    /**
     * @param string $information_html
     */
    public function set_information_html($information_html) {
        $this->information_html = $information_html;
    }

    /**
     * @return string
     */
    public function get_info_bring() {
        return $this->info_bring;
    }

    /**
     * @param string $info_bring
     */
    public function set_info_bring($info_bring) {
        $this->info_bring = $info_bring;
    }

    /**
     * @return string
     */
    public function get_info_provided() {
        return $this->info_provided;
    }

    /**
     * @param string $info_provided
     */
    public function set_info_provided($info_provided) {
        $this->info_provided = $info_provided;
    }

    /**
     * @return string
     */
    public function get_info_transport() {
        return $this->info_transport;
    }

    /**
     * @param string $info_transport
     */
    public function set_info_transport($info_transport) {
        $this->info_transport = $info_transport;
    }

    /**
     * @return string
     */
    public function get_info_restrictions() {
        return $this->info_restrictions;
    }

    /**
     * @param string $info_restrictions
     */
    public function set_info_restrictions($info_restrictions) {
        $this->info_restrictions = $info_restrictions;
    }

    /**
     * @return string
     */
    public function get_info_duration() {
        return $this->info_duration;
    }

    /**
     * @param string $info_duration
     */
    public function set_info_duration($info_duration) {
        $this->info_duration = $info_duration;
    }

    /**
     * @return string
     */
    public function get_info_season() {
        return $this->info_season;
    }

    /**
     * @param string $info_season
     */
    public function set_info_season($info_season) {
        $this->info_season = $info_season;
    }

    /**
     * @param string|null $default_img
     * @return string
     */
    public function get_url_img($default_img = null) {
        return $this->url_img ?: $default_img;
    }

    /**
     * @param string $url_img
     */
    public function set_url_img($url_img) {
        $this->url_img = $url_img;
    }

    /**
     * @return string
     */
    public function get_terms_html() {
        return $this->terms_html;
    }

    /**
     * @param string|null $terms_html
     */
    public function set_terms_html($terms_html) {
        $this->terms_html = $terms_html;
    }

    public function add_info_date_range_note($info_date_range_note) {
        $this->info_date_range_notes[] = $info_date_range_note;
    }

    /**
     * @return array
     */
    public function get_info_date_range_notes() {
        return $this->info_date_range_notes;
    }

    /**
     * @return Price[]
     */
    public function get_prices() {
        return $this->prices;
    }

    /**
     * @return Pickup[]
     */
    public function get_pickups() {
        return $this->pickups;
    }

    /**
     * @param string $price_type_key
     *
     * @return null|Price
     */
    public function get_price_by_price_type_key($price_type_key) {
        foreach ($this->prices as $price) {
            if ($price->get_price_type_key() == $price_type_key) {
                return $price;
            }
        }

        return null;
    }

    /**
     * @param string $price_key
     *
     * @return null|Price
     */
    public function get_price_by_price_key($price_key) {
        foreach ($this->prices as $price) {
            if ($price->get_price_key() == $price_key) {
                return $price;
            }
        }

        return null;
    }

    /**
     * @return Field[]
     */
    public function get_fields() {
        return $this->fields;
    }

    /**
     * @param string $has_tag
     * @return Field|null
     */
    public function get_field_by_tag($has_tag) {
        foreach ($this->fields as $field) {
            if ($field->has_tag($has_tag)) {
                return $field;
            }
        }

        return null;
    }

    /**
     * @return bool
     */
    public function is_show_obl() {
        return $this->is_show_obl;
    }

    /**
     * @return bool
     */
    public function get_has_promo_codes() {
        return $this->has_promo_codes;
    }

    /**
     * @return string
     */
    public function get_sector_start() {
        return $this->sector_start;
    }

    /**
     * @return string
     */
    public function get_sector_end() {
        return $this->sector_end;
    }

    /**
     * @return string[]
     */
    public function get_scheduled_times() {
        return $this->scheduled_times;
    }

    /**
     * @param \stdClass $raw_tour
     * @return Tour
     */
    public static function from_raw($raw_tour) {
        $tour = new self();

        $tour->set_name($raw_tour->name);
        $tour->set_tour_key($raw_tour->tour_key);

        if (property_exists($raw_tour, 'url_img')) {
            $tour->set_url_img($raw_tour->url_img);
        }

        if (property_exists($raw_tour, 'description')) {
            $tour->set_description($raw_tour->description);
        }

        if (property_exists($raw_tour, 'info_directions')) {
            $tour->info_directions = $raw_tour->info_directions;
        }

        if (property_exists($raw_tour, 'directions_html')) {
            $tour->directions_html = $raw_tour->directions_html;
        }

        if (property_exists($raw_tour, 'description_short_html')) {
            $tour->set_description_short_html($raw_tour->description_short_html);
        }

        if (property_exists($raw_tour, 'information_html')) {
            $tour->set_information_html($raw_tour->information_html);
        }

        if (property_exists($raw_tour, 'info_bring')) {
            $tour->set_info_bring($raw_tour->info_bring);
        }

        if (property_exists($raw_tour, 'info_provided')) {
            $tour->set_info_provided($raw_tour->info_provided);
        }

        if (property_exists($raw_tour, 'info_transport')) {
            $tour->set_info_transport($raw_tour->info_transport);
        }

        if (property_exists($raw_tour, 'info_restrictions')) {
            $tour->set_info_restrictions($raw_tour->info_restrictions);
        }

        if (property_exists($raw_tour, 'info_duration')) {
            $tour->set_info_duration($raw_tour->info_duration);
        }

        if (property_exists($raw_tour, 'info_season')) {
            $tour->set_info_season($raw_tour->info_season);
        }

        if (property_exists($raw_tour, 'supplier_key')) {
            $tour->set_supplier_key($raw_tour->supplier_key);
        }

        if (property_exists($raw_tour, 'terms_html')) {
            $tour->set_terms_html($raw_tour->terms_html);
        }

        if (property_exists($raw_tour, 'is_show_obl')) {
            $tour->is_show_obl = $raw_tour->is_show_obl;
        }

        if (property_exists($raw_tour, 'has_promo_codes')) {
            $tour->has_promo_codes = $raw_tour->has_promo_codes;
        }

        if (property_exists($raw_tour, 'sector_start')) {
            $tour->sector_start = $raw_tour->sector_start;
        }

        if (property_exists($raw_tour, 'sector_end')) {
            $tour->sector_end = $raw_tour->sector_end;
        }

        if (property_exists($raw_tour, 'info_date_range_notes') && is_array($raw_tour->info_date_range_notes)) {
            foreach ($raw_tour->info_date_range_notes as $raw_info_date_range_note) {
                $tour->add_info_date_range_note(InfoDateRangeNote::from_raw($raw_info_date_range_note));
            }
        }

        if (property_exists($raw_tour, 'prices') && is_array($raw_tour->prices)) {
            foreach ($raw_tour->prices as $raw_price) {
                $tour->prices[] = Price::from_raw($raw_price);
            }
        }

        if (property_exists($raw_tour, 'fields') && is_array($raw_tour->fields)) {
            foreach ($raw_tour->fields as $raw_field) {
                $tour->fields[] = Field::from_raw($raw_field);
            }
        }

        if (property_exists($raw_tour, 'scheduled_times') && is_array($raw_tour->scheduled_times)) {
            foreach ($raw_tour->scheduled_times as $scheduled_time) {
                $tour->scheduled_times[] = $scheduled_time;
            }
        }

        if (property_exists($raw_tour, 'pickups') && is_array($raw_tour->pickups)) {
            foreach ($raw_tour->pickups as $raw_pickup) {
                $tour->pickups[] = Pickup::from_raw($raw_pickup);
            }
        }

        return $tour;
    }

}