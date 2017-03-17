<?php namespace Rtbs\ApiHelper\Models;


class Obl {
    private $id;
    private $browser_title;
    private $style_css;
    private $url_complete;
    private $url_banner_img;
    private $tour_keys = [];


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
     * @param \stdClass $raw_obl
     * @return Obl
     */
    public static function from_raw($raw_obl)
    {
        $obl = new self();

        $obl->set_id($raw_obl->obl_id);
        $obl->set_browser_title($raw_obl->browser_title);
        $obl->set_style_css($raw_obl->style_css);
        $obl->set_url_complete($raw_obl->url_complete);
        $obl->set_url_banner_img($raw_obl->url_banner_img);
        $obl->set_tour_keys($raw_obl->tour_keys);

        return $obl;
    }

}