<?php namespace Rtbs\ApiHelper\Models;


class Field
{
	const TYPE_SELECT_SINGLE = 'select';
	const TYPE_SELECT_MULTIPLE = 'multi-select';
	const TYPE_TEXTAREA = 'textarea';
	const TYPE_TEXT = 'text';
	const TYPE_COUNTRY = 'country';

	private $name;
    private $description;
    private $type;
    private $default_value;
    private $options;
    private $is_required;
    private $is_listbox_choose_one = false;

	/**
	 * @return string
	 */
    public function get_name()
    {
        return $this->name;
    }


	/**
	 * @return string
	 */
	public function get_description()
	{
		return $this->description;
	}


    /**
     * @return string
     */
    public function get_type()
    {
        return $this->type;
    }


    /**
     * @return string
     */
    public function get_default_value()
    {
        return $this->default_value;
    }


    /**
     * @return string[]
     */
    public function get_options()
    {
        return $this->options;
    }


    /**
     * @return bool
     */
    public function is_required()
    {
        return $this->is_required;
    }


	/**
	 * @return bool
	 */
	public function is_listbox_choose_one()
	{
		return $this->is_listbox_choose_one;
	}


	/**
	 * @param \stdClass $raw_field
	 *
	 * @return Field
	 */
    public static function from_raw($raw_field) {
        $field = new Field();

	    $field->name = $raw_field->name;
	    $field->description = $raw_field->description;
        $field->type = $raw_field->type;
        $field->default_value = $raw_field->default_value;
        $field->options = $raw_field->options;
        $field->is_required = $raw_field->is_required;
	    $field->is_listbox_choose_one = $raw_field->is_listbox_choose_one;

        return $field;
    }
}