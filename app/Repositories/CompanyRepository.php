<?php

namespace App\Repositories;
use App\Models\Company;
use App\Models\Country;

class CompanyRepository{

   public function findById(int $id){
    return Company::find($id);
   }

   public function findByCompanyId(int $id){
    return Company::where('id','=',$id)->with('country')->with('user')->with('services')->first();
   }

   public function findByPage(int $page){
    return Company::with('country')->with('user')->paginate($page);
   }

   public function findByName(string $name){
     return Company::whereRaw('LOWER(name) = :name', ['name' => strtolower($name)])->first();
   }

   public function findByCountry(Country $country){
    return Company::whereBelongsTo($country)->get();
   }
}