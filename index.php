<?php
//include 'src/functions.php';
include 'src/AdditionalServices.php';
include 'src/Rate.php';
include 'src/Tariff.php';
include 'src/baseRate.php';
include 'src/studentRate.php';
include 'src/hourlyRate.php';
include 'src/GPS.php';
include 'src/additionalDriver.php';

//task7();
$rate = new studentRate(5,23);
$rate->additiveService(new additionalDriver());
$rate->additiveService(new GPS());
echo $rate->price();