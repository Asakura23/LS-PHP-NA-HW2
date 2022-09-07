<?php

class GPS implements AdditionalServices
{
    private $hourlyPrice = 15;

    public function tariffApplication(Rate $rate, &$price)
    {
        $priceGPS = $this->hourlyPrice;
        $time = $rate->time();
        $time = ceil($time/60);
        $price = $price + $priceGPS * $time;
    }
}