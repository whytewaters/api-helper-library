<?php namespace Rtbs\ApiHelper\Models;

class ResourceGroup {
	private $tour_key;
	private $activity_rn;
    private $resource_group_rn;
	private $resource_group_id;
	private $can_allocate = 0;
	private $allocation_question;
	private $unit_term;
	private $max_qty;
	private $max_pax;


	/**
	 * @return int
	 */
    public function get_resource_group_rn() {
    	return (int) $this->resource_group_rn;
    }


	/**
	 * @param string $resource_group_rn
	 */
    public function set_resource_group_rn($resource_group_rn) {
    	$this->resource_group_rn = (int) $resource_group_rn;
    }


	/**
	 * @return string
	 */
	public function get_resource_group_id() {
		return $this->resource_group_id;
	}


	/**
	 * @param string $resource_group_id
	 */
	public function set_resource_group_id($resource_group_id) {
		$this->resource_group_id = $resource_group_id;
	}


	public function get_activity_rn() {
		return (int) $this->activity_rn;
	}


	/**
	 * @param string $activity_rn
	 */
	public function set_activity_rn($activity_rn) {
		$this->activity_rn = (int) $activity_rn;
	}


	/**
	 * @return int
	 */
	public function get_can_allocate() {
		return $this->can_allocate;
	}


	/**
	 * @param int $can_allocate
	 */
	public function set_can_allocate($can_allocate) {
		$this->can_allocate = $can_allocate;
	}


	/**
	 * @return string
	 */
	public function get_allocation_question() {
		return $this->allocation_question;
	}


	/**
	 * @param string $allocation_question
	 */
	public function set_allocation_question($allocation_question) {
		$this->allocation_question = $allocation_question;
	}


	/**
	 * @return string
	 */
	public function get_unit_term() {
		return $this->unit_term;
	}


	/**
	 * @param string $unit_term
	 */
	public function set_unit_term($unit_term) {
		$this->unit_term = $unit_term;
	}


	/**
	 * @return int
	 */
	public function get_max_qty() {
		return $this->max_qty;
	}


	/**
	 * @param string $max_qty
	 */
	public function set_max_qty($max_qty) {
		$this->max_qty = $max_qty;
	}


	/**
	 * @return int
	 */
	public function get_max_pax() {
		return $this->max_pax;
	}


	/**
	 * @param string $max_pax
	 */
	public function set_max_pax($max_pax) {
		$this->max_pax = $max_pax;
	}


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
	 * @param \stdClass $raw_resource_group
	 * @return ResourceGroup
	 */
	public static function from_raw($raw_resource_group) {
		$resource_group = new self();

		$resource_group->set_tour_key($raw_resource_group->tour_key);
		$resource_group->set_resource_group_rn($raw_resource_group->resource_group_rn);
		$resource_group->set_resource_group_id($raw_resource_group->resource_group_id);
		$resource_group->set_activity_rn($raw_resource_group->activity_rn);
		$resource_group->set_can_allocate($raw_resource_group->can_allocate);
		$resource_group->set_allocation_question($raw_resource_group->allocation_question);
		$resource_group->set_unit_term($raw_resource_group->unit_term);
		$resource_group->set_max_qty($raw_resource_group->max_qty);
		$resource_group->set_max_pax($raw_resource_group->max_pax);

		return $resource_group;
	}

}