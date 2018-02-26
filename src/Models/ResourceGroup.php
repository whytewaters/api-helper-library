<?php namespace Rtbs\ApiHelper\Models;

class ResourceGroup {
    private $resource_group_rn;
	private $activity_rn;


	/**
	 * @return int
	 */
    public function get_resource_group_rn() {
    	return $this->resource_group_rn;
    }


	/**
	 * @param string $resource_group_rn
	 */
    public function set_resource_group_rn($resource_group_rn) {
    	$this->resource_group_rn = $resource_group_rn;
    }


	public function get_activity_rn() {
		return $this->activity_rn;
	}


	/**
	 * @param string $activity_rn
	 */
	public function set_activity_rn($activity_rn) {
		$this->activity_rn = $activity_rn;
	}


	/**
	 * @param \stdClass $raw_resource_group
	 * @return ResourceGroup
	 */
	public static function from_raw($raw_resource_group) {
		$resource_group = new self();

		$resource_group->set_resource_group_rn($raw_resource_group->resource_group_rn);
		$resource_group->set_activity_rn($raw_resource_group->activity_rn);

		return $resource_group;
	}

}