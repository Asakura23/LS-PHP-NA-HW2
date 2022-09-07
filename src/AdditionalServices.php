<?php

interface AdditionalServices
{
    public function tariffApplication(Rate $rate, &$price);
}