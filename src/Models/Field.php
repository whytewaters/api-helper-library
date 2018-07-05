<?php namespace Rtbs\ApiHelper\Models;

class Field {
    const TYPE_SELECT_SINGLE = 'select';
    const TYPE_SELECT_MULTIPLE = 'multi-select';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_TEXT = 'text';
    const TYPE_COUNTRY = 'country';
    const TYPE_DATE = 'date';
    const TYPE_HEADING = 'heading';

    private $name;
    private $description;
    private $type;
    private $default_value;
    private $options;
    private $is_required;
    private $is_listbox_choose_one = false;
    private $is_other_please_specify = false;
    private $tags;

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
    public function get_type() {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function set_type($type) {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function get_default_value() {
        return $this->default_value;
    }

    /**
     * @param string $default_value
     */
    public function set_default_value($default_value) {
        $this->default_value = $default_value;
    }

    /**
     * @return string[]
     */
    public function get_options() {
        return $this->options;
    }

    /**
     * @param string $options
     */
    public function set_options($options) {
        $this->options = $options;
    }

    /**
     * @return bool
     */
    public function is_required() {
        return $this->is_required;
    }

    /**
     * @param bool|int $is_required
     */
    public function set_is_required($is_required) {
        $this->is_required = (bool)$is_required;
    }

    /**
     * @return bool
     */
    public function is_listbox_choose_one() {
        return $this->is_listbox_choose_one;
    }

    /**
     * @param bool|int $is_listbox_choose_one
     */
    public function set_is_listbox_choose_one($is_listbox_choose_one) {
        $this->is_listbox_choose_one = (bool)$is_listbox_choose_one;
    }

    /**
     * @return bool
     */
    public function is_listbox_other_please_specify() {
        return $this->is_other_please_specify;
    }

    /**
     * @param $is_other_please_specify
     */
    public function set_listbox_other_please_specify($is_other_please_specify) {
        $this->is_other_please_specify = (bool)$is_other_please_specify;
    }

    /**
     * @param string $tags
     */
    public function set_tags($tags) {
        if (!$tags) {
            $this->tags = array();
        } else {
            $this->tags = explode(' ', $tags);
        }
    }

    /**
     * @param $has_tag
     * @return bool
     */
    public function has_tag($has_tag) {
        return in_array(strtoupper(trim($has_tag)), $this->tags, true);
    }

    /**
     * @param \stdClass $raw_field
     * @return Field
     */
    public static function from_raw($raw_field) {
        $field = new self();

        $field->set_name($raw_field->name);
        $field->set_description($raw_field->description);
        $field->set_type($raw_field->type);
        $field->set_default_value($raw_field->default_value);
        $field->set_options($raw_field->options);
        $field->set_is_required($raw_field->is_required);
        $field->set_is_listbox_choose_one($raw_field->is_listbox_choose_one);
        $field->set_tags($raw_field->tags);

        if (property_exists($raw_field, 'is_listbox_other_please_specify')) {
            $field->set_listbox_other_please_specify($raw_field->is_listbox_other_please_specify);
        }

        return $field;
    }

}