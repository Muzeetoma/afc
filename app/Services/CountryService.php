<?php

namespace App\Services;
use App\Repositories\CountryRepository;
use App\Mappers\CountryMapper;

class CountryService{

    private $countryRepository;
    
    public function __construct(CountryRepository $countryRepository) {
        $this->countryRepository = $countryRepository;
    }

    public function getByName(string $name){
        return $this->countryRepository->findByName($name);
    }

    public function getAll(){
        return $this->countryRepository->findAll();
    }
}