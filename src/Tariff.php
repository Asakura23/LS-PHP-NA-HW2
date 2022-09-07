<?php

abstract class Tariff implements Rate
{
    protected $kilometerPrice;
    protected $minutePrice;
    protected $distance;
    protected $minutes;
    /** @var AdditionalServices[] */
    protected $services = [];

    public function __construct($distance, $minutes)
    {
        $this->distance = $distance;
        $this->minutes = $minutes;
    }
    public function price()
    {
        $distance = $this->distance;
        $kilometerPrice = $this->kilometerPrice;
        $minutes = $this->minutes;
        $minutePrice = $this->minutePrice;

        $price = $distance*$kilometerPrice+$minutes*$minutePrice;

        if ($this->services){
            foreach ($this->services as $service){
                $service->tariffApplication($this,$price);
            }
        }
        return $price;
    }

    public function additiveService(AdditionalServices $services)
    {
        array_push($this->services, $services);
        return $this;
    }

    public function time()
    {
        return $this->minutes;
    }

    public function distance()
    {
        return $this->distance;
    }
}