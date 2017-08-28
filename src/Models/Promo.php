<?php namespace Rtbs\ApiHelper\Models;


class Promo
{
    private $discount_amount;


    /**
     * @return float|null
     */
    public function get_discount_amount()
    {
        return $this->discount_amount;
    }


    /**
     * @param float|null $discount_amount
     */
    public function set_discount_amount($discount_amount)
    {
        $this->discount_amount = $discount_amount;
    }


    /**
     * @param \stdClass $raw_promo
     * @return Promo
     */
    public static function from_raw($raw_promo)
    {
        $promo = new self();

        if (property_exists($raw_promo, 'discount_amount')) {
            $promo->set_discount_amount($raw_promo->discount_amount);
        }

        return $promo;
    }

}