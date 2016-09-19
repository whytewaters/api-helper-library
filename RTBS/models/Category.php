<?php

namespace RTBS\models;

class Category {
    private $category_key;
    private $name;
    private $description;
    private $sub_categories = [];

    /**
     * @return mixed
     */
    public function get_category_key() {
        return $this->category_key;
    }

    /**
     * @param mixed $category_key
     */
    public function set_category_key($category_key) {
        $this->category_key = $category_key;
    }

    /**
     * @return mixed
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function set_name($name) {
        $this->name = $name;
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
     * @return array
     */
    public function get_sub_categories() {
        return $this->sub_categories;
    }

    public function add_sub_category($sub_category) {
        $this->sub_categories[] = $sub_category;
    }



    public static function fromRaw($raw_category) {
        $category = new Category();
        $category->set_name($raw_category->name);
        $category->set_category_key($raw_category->category_key);
        $category->set_description($raw_category->description);

        foreach($raw_category->nodes as $node) {
            $category->add_sub_category(Category::fromRaw($node));
        }

        return $category;
    }


}