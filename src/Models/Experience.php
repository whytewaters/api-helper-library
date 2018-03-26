<?php namespace Rtbs\ApiHelper\Models;


class Experience {
    private $experience_key;
    private $experience_name;
    private $experience_short_name;

    private $tour_keys = array();
    private $primary_tour_key;


    /** @var ResourceGroup[] */
    private $resource_groups = array();


	/**
	 * @return string
	 */
    public function get_experience_key() {
    	return $this->experience_key;
    }


	/**
	 * @return string
	 */
    public function get_primary_tour_key() {
	    return $this->primary_tour_key;
    }


	/**
	 * @param string $primary_tour_key
	 * @return string
	 */
	public function set_primary_tour_key($primary_tour_key) {
		return $this->primary_tour_key = $primary_tour_key;
	}


	/**
	 * @return array
	 */
	public function get_tour_keys() {
		return $this->tour_keys;
	}


	/**
	 * @return array
	 */
	public function add_tour_key($tour_key) {
		return $this->tour_keys[] = $tour_key;
	}


	/**
	 * @param string $experience_key
	 */
    public function set_experience_key($experience_key) {
    	$this->experience_key = $experience_key;
    }


    public function get_experience_name() {
    	return $this->experience_name;
    }


	/**
	 * @param string $experience_name
	 */
	public function set_experience_name($experience_name) {
		$this->experience_name = $experience_name;
	}


	public function get_experience_short_name() {
		return $this->experience_short_name;
	}


	/**
	 * @param string $experience_short_name
	 */
    public function set_experience_short_name($experience_short_name) {
    	$this->experience_short_name = $experience_short_name;
    }


    public function add_resource_group(ResourceGroup $resource_group) {
    	$this->resource_groups[] = $resource_group;
    }


	/**
	 * @return ResourceGroup[]
	 */
	public function get_resource_groups() {
		return $this->resource_groups;
	}


    /**
     * @param \stdClass $raw_experience
     * @return Tour
     */
    public static function from_raw($raw_experience) {
        $experience = new self();

	    $experience->set_experience_key($raw_experience->experience_key);
	    $experience->set_experience_name($raw_experience->experience_name);
	    $experience->set_experience_short_name($raw_experience->experience_short_name);

        if (property_exists($raw_experience, 'resource_groups')) {
	        if (property_exists($raw_experience, 'resource_groups')) {
		        foreach ($raw_experience->resource_groups as $raw_resource_group) {
			        $experience->add_resource_group(ResourceGroup::from_raw($raw_resource_group));
		        }
	        }
        }

	    if (property_exists($raw_experience, 'tour_keys')) {
		    foreach ($raw_experience->tour_keys as $tour_key) {
			    $experience->add_tour_key($tour_key);
		    }
	    }

	    if (property_exists($raw_experience, 'primary_tour_key')) {
		    $experience->set_primary_tour_key($raw_experience->primary_tour_key);
	    }

        return $experience;
    }

}