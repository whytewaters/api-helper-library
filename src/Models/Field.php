<?php namespace Rtbs\ApiHelper\Models;


class Field {
    private $name;
    private $description;

	/**
	 * @return string
	 */
    public function get_name()
    {
        return $this->name;
    }

	/**
	 * @param string $name
	 */
	public function set_name($name)
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function get_description()
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function set_description($description)
	{
		$this->description = $description;
	}

	/**
	 * @param \stdClass $raw_field
	 *
	 * @return Field
	 */
    public static function from_raw($raw_field) {
        $field = new Field();

        if (property_exists($raw_field, 'name')) {
	        $field->set_name($raw_field->name);
        }

	    if (property_exists($raw_field, 'description')) {
		    $field->set_description($raw_field->description);
	    }

        return $field;
    }
}