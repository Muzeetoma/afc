<?php

namespace App\Services\Dto\Country;

class CountryDto{
    public $name;

    public function __construct(string $name) {
        $this->name = $name;
    }
}