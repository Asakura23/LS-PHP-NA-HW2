<?php

class additionalDriver implements AdditionalServices
{
    private $driverPrice = 100;

    public function tariffApplication(Rate $rate, &$price)
    {
        $driverPrice = $this->driverPrice;
        $price = $price + $driverPrice;
    }
}