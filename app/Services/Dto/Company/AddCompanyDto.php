<?php

namespace App\Services\Dto\Company;

class AddCompanyDto{
   public $name;
   public $email;

   public function __construct(string $name,
                               string $email,
                              ) {
      $this->name = $name;
      $this->email = $email;
   }
}