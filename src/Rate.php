<?php

interface Rate
{
    public function price();
    public function additiveService(AdditionalServices $services);
    public function time();
    public function distance();
}