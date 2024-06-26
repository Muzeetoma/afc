<?php

namespace App\Repositories;
use App\Models\Service;
use App\Models\Company;


class ServiceRepository{
    
    public function findByCompanyId(int $companyId){
        return Service::where('company_id','=',$companyId)
                        ->get();
    }

    public function findByNameAndCompany(string $name,int $companyId){
        return Service::where('name','=',$name)
                        ->where('company_id','=',$companyId)
                        ->first();
    }
    public function findByIdAndCompany(int $serviceId,int $companyId){
        return Service::where('id','=',$serviceId)
                        ->where('company_id','=',$companyId)
                        ->first();
    }
    public function findById(int $serviceId){
        return Service::where('id','=',$serviceId)
                        ->first();
    }
}