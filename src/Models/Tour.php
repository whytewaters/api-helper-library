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

    /** @var Price[] */
    private $prices = array();

    /** @var Field[] */
	private $fields = array();

    /**
     * @return mixed
     */
    public function get_tour_key() {
        return $this->tour_key;
    }

    /**
     * @param mixed $tour_key
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
     * @return mixed
     */
    public function get_supplier_key()
    {
        return $this->supplier_key;
    }

    /**
     * @param mixed $supplier_key
     */
    public function set_supplier_key($supplier_key) {
        $this->supplier_key = $supplier_key;
    }

    /**
     * @return mixed
     */
    public function get_description() {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function set_description($description) {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function get_info_directions() {
        return $this->info_directions;
    }

    /**
     * @param mixed $info_directions
     */
    public function set_info_directions($info_directions) {
        $this->info_directions = $info_directions;
    }

    /**
     * @return mixed
     */
    public function get_info_bring() {
        return $this->info_bring;
    }

    /**
     * @param mixed $info_bring
     */
    public function set_info_bring($info_bring) {
        $this->info_bring = $info_bring;
    }

    /**
     * @return mixed
     */
    public function get_info_provided() {
        return $this->info_provided;
    }

    /**
     * @param mixed $info_provided
     */
    public function set_info_provided($info_provided) {
        $this->info_provided = $info_provided;
    }

    /**
     * @return mixed
     */
    public function get_info_transport() {
        return $this->info_transport;
    }

    /**
     * @param mixed $info_transport
     */
    public function set_info_transport($info_transport) {
        $this->info_transport = $info_transport;
    }

    public function add_info_date_range_note($info_date_range_note) {
        $this->info_date_range_notes[] = $info_date_range_note;
    }

    public function add_price(Price $price) {
        $this->prices[] = $price;
    }

	public function add_field(Field $field) {
		$this->fields[] = $field;
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


	public static function from_raw($raw_tour) {
        $tour = new Tour();

        $tour->set_name($raw_tour->name);
        $tour->set_tour_key($raw_tour->tour_key);

        if(property_exists($raw_tour, 'description')) {
            $tour->set_description($raw_tour->description);
        }

        if(property_exists($raw_tour, 'info_directions')) {
            $tour->set_info_directions($raw_tour->info_directions);
        }

        if(property_exists($raw_tour, 'info_bring')) {
            $tour->set_info_bring($raw_tour->info_bring);
        }

        if(property_exists($raw_tour, 'info_provided')) {
            $tour->set_info_provided($raw_tour->info_provided);
        }

        if(property_exists($raw_tour, 'info_transport')) {
            $tour->set_info_transport($raw_tour->info_transport);
        }

        if(property_exists($raw_tour, 'supplier_key')) {
            $tour->set_supplier_key($raw_tour->supplier_key);
        }

        if(property_exists($raw_tour, 'info_date_range_notes') && is_array($raw_tour->info_date_range_notes)) {
            foreach($raw_tour->info_date_range_notes as $raw_info_date_range_note) {
                $tour->add_info_date_range_note(InfoDateRangeNote::from_raw($raw_info_date_range_note));
            }
        }

        if(property_exists($raw_tour, 'prices') && is_array($raw_tour->prices)) {
            foreach($raw_tour->prices as $raw_price) {
                $tour->add_price(Price::from_raw($raw_price));
            }
        }

        if (property_exists($raw_tour, 'fields') && is_array($raw_tour->fields)) {
	        foreach($raw_tour->fields as $raw_field) {
		        $tour->add_field(Field::from_raw($raw_field));
	        }
	    }

        return $tour;
    }
}