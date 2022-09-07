<?php

class hourlyRate extends Tariff
{
    protected $kilometerPrice = 0;
    protected $minutePrice = 200/60;

    public function __construct($distance, $minutes)
    {
        parent::__construct($distance, $minutes);
        $minutes = $this->minutes;
        $this->minutes = $minutes - $minutes % 60 +60;
    }
}