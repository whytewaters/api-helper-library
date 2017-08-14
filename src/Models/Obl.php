<?php namespace Rtbs\ApiHelper\Models;


class Obl {
    private $browser_title;
    private $id;
    private $style_css;
    private $supplier_key;
    private $theme;
    private $tour_keys = array();
    private $url_banner_img;
    private $url_complete;
    private $url_website;
    private $is_latipay_payment_gateway;


    /**
     * @return string
     */
    public function get_id()
    {
        return $this->id;
    }


    /**
     * @param string $obl_id
     */
    public function set_id($obl_id)
    {
        $this->id = $obl_id;
    }


    /**
     * @return string
     */
    public function get_browser_title()
    {
        return $this->browser_title;
    }


    /**
     * @param string $browser_title
     */
    public function set_browser_title($browser_title)
    {
        $this->browser_title = $browser_title;
    }


    /**
     * @return string
     */
    public function get_style_css()
    {
        return $this->style_css;
    }


    /**
     * @param string $style_css
     */
    public function set_style_css($style_css)
    {
        $this->style_css = $style_css;
    }


    /**
     * @return string
     */
    public function get_url_complete()
    {
        return $this->url_complete;
    }


    /**
     * @param string $url_complete
     */
    public function set_url_complete($url_complete)
    {
        $this->url_complete = $url_complete;
    }


    /**
     * @return string
     */
    public function get_url_banner_img()
    {
        return $this->url_banner_img;
    }


    /**
     * @param string $url_banner_img
     */
    public function set_url_banner_img($url_banner_img)
    {
        $this->url_banner_img = $url_banner_img;
    }


    /**
     * @return string
     */
    public function get_url_website()
    {
        return $this->url_website;
    }


    /**
     * @param string $url_website
     */
    public function set_url_website($url_website)
    {
        $this->url_website = $url_website;
    }


    /**
     * @return string[]
     */
    public function get_tour_keys()
    {
        return $this->tour_keys;
    }


    /**
     * @param string[] $tour_keys
     */
    public function set_tour_keys($tour_keys)
    {
        $this->tour_keys = $tour_keys;
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
    public function set_supplier_key($supplier_key)
    {
        $this->supplier_key = $supplier_key;
    }


    /**
     * @return string
     */
    public function get_theme()
    {
        return $this->theme;
    }


    /**
     * @param string $theme
     */
    public function set_theme($theme)
    {
        $this->theme = $theme;
    }


    public function get_is_latipay_payment_gateway()
    {
        return $this->is_latipay_payment_gateway;
    }


    public function set_is_latipay_payment_gateway($is_latipay_payment_gateway)
    {
        $this->is_latipay_payment_gateway = $is_latipay_payment_gateway;
    }


    public function get_operator_status_msg()
    {
        return $this->operator_status_msg;
    }


    public function set_operator_status_msg($operator_status_msg)
    {
        $this->operator_status_msg = $operator_status_msg;
    }





    /**
     * @param \stdClass $raw_obl
     * @return Obl
     */
    public static function from_raw($raw_obl)
    {
        $obl = new self();

        $obl->set_id($raw_obl->obl_id);
        $obl->set_browser_title($raw_obl->browser_title);
        $obl->set_style_css($raw_obl->style_css);

        if (!empty($raw_obl->theme)) {
            $obl->set_theme($raw_obl->theme);
        }

        $obl->set_url_complete($raw_obl->url_complete);
        $obl->set_url_website($raw_obl->url_website);
        $obl->set_url_banner_img($raw_obl->url_banner_img);
        $obl->set_tour_keys($raw_obl->tour_keys);

        if (property_exists($raw_obl, 'is_latipay_payment_gateway')) {
            $obl->set_is_latipay_payment_gateway($raw_obl->is_latipay_payment_gateway);
        }

        if (property_exists($raw_obl, 'operator_status_msg')) {
            $obl->set_operator_status_msg($raw_obl->operator_status_msg);
        }

        if (!empty($raw_obl->supplier_key)) {
            $obl->set_supplier_key($raw_obl->supplier_key);
        }

        return $obl;
    }

}