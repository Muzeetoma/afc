<?php

namespace App\Mappers;
use App\Models\Country;


class CountryMapper{


    public static function toCountry($name){
        $country  = new Country();
        $country->name = $name;
        return $country;
    }
}