<?php

namespace App\Mappers;
use App\Services\Dto\Company\CreateCompanyDto;
use App\Services\Dto\Company\UpdateCompanyDto;
use App\Models\Company;

class CompanyMapper{

    public static function toCompany(CreateCompanyDto $createCompanyDto){
       $company = new Company();
       $company->name = $createCompanyDto->name;
       $company->email = $createCompanyDto->email;
       return $company;
    }

    public static function updateCompany(Company $company, UpdateCompanyDto $updateCompanyDto)
    {
        if (!empty($updateCompanyDto->name)) {
            $company->name = $updateCompanyDto->name;
        }
        if (!empty($updateCompanyDto->email)) {
            $company->email = $updateCompanyDto->email;
        }
        return $company;
    }
}