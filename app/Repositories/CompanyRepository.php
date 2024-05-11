<?php

namespace App\Repositories;
use App\Models\Company;
use App\Models\Country;

class CompanyRepository{

   public function findById(int $id){
    return Company::find($id);
   }

   public function findByPage(int $limit){
    return Company::with('country')->with('user')->paginate($limit);
   }

   public function findByName(string $name){
     return Company::whereRaw('LOWER(name) = :name', ['name' => strtolower($name)])->first();
   }

   public function findByCountry(Country $country){
    return Company::whereBelongsTo($country)->get();
   }
}