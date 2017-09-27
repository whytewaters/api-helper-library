<?php namespace Rtbs\ApiHelper\Models;


class Obl
{
    private $browser_title;
    private $id;
    private $style_css;
    private $supplier_key;
    private $theme;
    private $tour_keys = array();
    private $url_banner_img;
    private $url_complete;
    private $url_website;
    private $url_facebook;
    private $is_latipay_payment_gateway;
    private $operator_status_msg;
    private $is_mouseflow_tracking;
    private $is_show_promo_codes;
    private $is_active;
    private $operator_email;
    private $operator_phone;
    private $operator_phone_free;
    private $operator_name;


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
     * @param string|null $append
     * @return string
     */
    public function get_browser_title($append = null)
    {
        if (!empty($this->browser_title)) {
            $browser_title = $this->browser_title;

            if ($append) {
                $browser_title .= " - {$append}";
            }
        } else {
            $browser_title = $append;
        }

        return $browser_title;
    }


    /**
     * @return string
     */
    public function get_style_css()
    {
        return $this->style_css;
    }


    /**
     * @return string
     */
    public function get_url_complete()
    {
        return $this->url_complete;
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
     * @return string
     */
    public function get_supplier_key()
    {
        return $this->supplier_key;
    }


    /**
     * @return string
     */
    public function get_theme()
    {
        return $this->theme;
    }


    /**
     * @return string
     */
    public function get_is_latipay_payment_gateway()
    {
        return $this->is_latipay_payment_gateway;
    }


    /**
     * @return string
     */
    public function get_operator_status_msg()
    {
        return $this->operator_status_msg;
    }


    /**
     * @return string
     */
    public function get_operator_email()
    {
        return $this->operator_email;
    }


    /**
     * @return string
     */
    public function get_operator_phone()
    {
        return $this->operator_phone;
    }


    /**
     * @return string
     */
    public function get_operator_phone_free()
    {
        return $this->operator_phone_free;
    }


    /**
     * @return string
     */
    public function get_operator_name()
    {
        return $this->operator_name;
    }


    /**
     * @return bool
     */
    public function get_is_mouseflow_tracking()
    {
        return $this->is_mouseflow_tracking;
    }


    /**
     * @return bool
     */
    public function get_is_show_promo_codes()
    {
        return $this->is_show_promo_codes;
    }


    /**
     * @return bool
     */
    public function get_is_active()
    {
        return $this->is_active;
    }


	/**
	 * @return string|null
	 */
    public function get_url_facebook()
    {
    	return $this->url_facebook;
    }


	/**
	 * @param string|null $url_facebook
	 */
    public function set_url_facebook($url_facebook)
    {
    	$this->url_facebook = $url_facebook;
    }

    /**
     * @param \stdClass $raw_obl
     * @return Obl
     */
    public static function from_raw($raw_obl)
    {
        $obl = new self();

        $obl->id = $raw_obl->obl_id;
        $obl->browser_title = $raw_obl->browser_title;
        $obl->style_css = $raw_obl->style_css;

        if (!empty($raw_obl->theme)) {
            $obl->theme = $raw_obl->theme;
        }

        $obl->url_complete = $raw_obl->url_complete;
        $obl->url_website = $raw_obl->url_website;
        $obl->url_banner_img = $raw_obl->url_banner_img;
        $obl->tour_keys = $raw_obl->tour_keys;

        if (property_exists($raw_obl, 'is_latipay_payment_gateway')) {
            $obl->is_latipay_payment_gateway = $raw_obl->is_latipay_payment_gateway;
        }

        if (property_exists($raw_obl, 'is_mouseflow_tracking')) {
            $obl->is_mouseflow_tracking = $raw_obl->is_mouseflow_tracking;
        }

        if (property_exists($raw_obl, 'is_show_promo_codes')) {
            $obl->is_show_promo_codes = $raw_obl->is_show_promo_codes;
        }

        if (property_exists($raw_obl, 'is_active')) {
            $obl->is_active = $raw_obl->is_active;
        }

        if (property_exists($raw_obl, 'operator_status_msg')) {
            $obl->operator_status_msg = $raw_obl->operator_status_msg;
        }

        if (property_exists($raw_obl, 'operator_email')) {
            $obl->operator_email = $raw_obl->operator_email;
        }

        if (property_exists($raw_obl, 'operator_phone')) {
            $obl->operator_phone = $raw_obl->operator_phone;
        }

        if (property_exists($raw_obl, 'operator_phone_free')) {
            $obl->operator_phone_free = $raw_obl->operator_phone_free;
        }

        if (property_exists($raw_obl, 'operator_name')) {
            $obl->operator_name = $raw_obl->operator_name;
        }

	    if (property_exists($raw_obl, 'url_facebook')) {
		    $obl->url_facebook = $raw_obl->url_facebook;
	    }

        if (!empty($raw_obl->supplier_key)) {
            $obl->supplier_key = $raw_obl->supplier_key;
        }

        return $obl;
    }

}