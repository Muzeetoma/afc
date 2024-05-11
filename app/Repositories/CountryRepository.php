<?php

namespace App\Repositories;
use App\Models\Country;

class CountryRepository{

    public function findByName(string $name){
        return Country::where('name','=',$name)->first();
    }

    public function findAll(){
        return Country::all();
     }
}