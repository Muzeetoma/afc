<?php

namespace App\Services;
use App\Repositories\ServiceRepository;
use App\Repositories\CompanyRepository;
use App\Mappers\ServiceMapper;
use App\Services\Dto\Service\ServiceDto;
use App\Services\Dto\Service\UpdateServiceDto;
use Illuminate\Support\Facades\Auth;


class Services{

    private $serviceRepository;
    private $companyRepository;
    

    public function __construct(CompanyRepository $companyRepository, 
                                ServiceRepository $serviceRepository) {
        $this->serviceRepository = $serviceRepository;
        $this->companyRepository = $companyRepository;
    }

    public function getByCompanyId(int $id){
        return $this->serviceRepository->findByCompanyId($id);
    }

    public function getById(int $id){
        return $this->serviceRepository->findById($id);
    }

    public function create(ServiceDto $serviceDto){
        try{
            $company = $this->companyRepository->findById($serviceDto->companyId);
            if(empty($company)){
                throw new \Exception('Company with id ' . $serviceDto->companyId . ' does not exist');
            }
            $service = $this->serviceRepository->findByNameAndCompany($serviceDto->name,$company->id);
            if(!empty($service)){
                throw new \Exception('Service with name ' . $service->name . ' exists in company ' . $company->name);
            }
            $service = ServiceMapper::createService($serviceDto);
            $service->company()->associate($company);
           
            if($service->save()){
                session()->flash('message','Service added successfully');
            }
        }catch(\Exception $ex){
            session()->flash('error', $ex->getMessage());
        }
    }


    public function update(UpdateServiceDto $updateServiceDto){
        try{
            $service = $this->serviceRepository->findById($updateServiceDto->serviceId);
            if(empty($service)){
                throw new \Exception('Service with name ' . $updateServiceDto->companyId 
                                      . ' does not exist ');
            }
            $service = ServiceMapper::updateService($service,$updateServiceDto);
            
            if($service->save()){
                session()->flash('message','Service updated successfully');
            }
        }catch(\Exception $ex){
            session()->flash('error', $ex->getMessage());
        }
    }

    public function delete($id){
        try{
            $user = Auth::user();
            $userCompanies = $user->companies;

            $service = $this->serviceRepository->findById($id);
            if(empty($service)){
                throw new \Exception('Service does not exist ');
            }
            if(!$userCompanies->contains($service->company)){
                throw new \Exception('Service with name ' . $service->name 
                                      . ' does not exist in company ' . $company->name);
            }
            if($service->delete()){
                session()->flash('message','Service deleted successfully');
            }
        }catch(\Exception $ex){
            session()->flash('error', $ex->getMessage());
        }
    }

}