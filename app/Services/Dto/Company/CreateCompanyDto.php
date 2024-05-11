<?php

namespace App\Services\Dto\Company;
use App\Models\Country;
use App\Models\User;

class CreateCompanyDto{
   public $name;
   public $email;
   public $country;
   public $user;

   public function __construct(string $name, string $email, Country $country, User $user) {
      $this->name = $name;
      $this->email = $email;
      $this->country = $country;
      $this->user = $user;
   }
}