<?php namespace Rtbs\ApiHelper\Models;


class Tour
{
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
    private $description_html;
    private $information_html;
    private $is_show_obl;
    private $has_promo_codes;
    private $terms_html;

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
    public function get_supplier_key()
    {
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
    public function get_description_html() {
        return $this->description_html;
    }


    /**
     * @param string $description_html
     */
    public function set_description_html($description_html) {
        $this->description_html = $description_html;
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
    public function get_info_transport()
    {
        return $this->info_transport;
    }


    /**
     * @param string $info_transport
     */
    public function set_info_transport($info_transport)
    {
        $this->info_transport = $info_transport;
    }


    /**
     * @param string $default_img
     * @return string
     */
    public function get_url_img($default_img)
    {
        return ($this->url_img) ? $this->url_img : $default_img;
    }


    /**
     * @param string $url_img
     */
    public function set_url_img($url_img)
    {
        $this->url_img = $url_img;
    }


    /**
     * @return string
     */
    public function get_terms_html()
    {
        return $this->terms_html;
    }


    /**
     * @param string|null $terms_html
     */
    public function set_terms_html($terms_html)
    {
        $this->terms_html = $terms_html;
    }


    public function add_info_date_range_note($info_date_range_note)
    {
        $this->info_date_range_notes[] = $info_date_range_note;
    }


    /**
     * @return array
     */
    public function get_info_date_range_notes()
    {
        return $this->info_date_range_notes;
    }

    /**
     * @return Price[]
     */
    public function get_prices() {
        return $this->prices;
    }

    /**
     * @return Field[]
     */
    public function get_fields() {
        return $this->fields;
    }


    /**
     * @return bool
     */
    public function is_show_obl()
    {
        return $this->is_show_obl;
    }


	/**
	 * @return bool
	 */
	public function get_has_promo_codes()
	{
		return $this->has_promo_codes;
	}


    /**
     * @param \stdClass $raw_tour
     * @return Tour
     */
    public static function from_raw($raw_tour)
    {
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

        if (property_exists($raw_tour, 'description_html')) {
            $tour->set_description_html($raw_tour->description_html);
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

        if (property_exists($raw_tour, 'info_date_range_notes') && is_array($raw_tour->info_date_range_notes)) {
            foreach($raw_tour->info_date_range_notes as $raw_info_date_range_note) {
                $tour->add_info_date_range_note(InfoDateRangeNote::from_raw($raw_info_date_range_note));
            }
        }

        if (property_exists($raw_tour, 'prices') && is_array($raw_tour->prices)) {
            foreach($raw_tour->prices as $raw_price) {
                $tour->prices[] = Price::from_raw($raw_price);
            }
        }

        if (property_exists($raw_tour, 'fields') && is_array($raw_tour->fields)) {
            foreach($raw_tour->fields as $raw_field) {
                $tour->fields[] = Field::from_raw($raw_field);
            }
        }

        return $tour;
    }

}