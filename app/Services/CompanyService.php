<?php

namespace App\Services;
use App\Repositories\CompanyRepository;
use App\Services\Dto\Company\CreateCompanyDto;
use App\Services\Dto\Company\AddCompanyDto;
use App\Services\Dto\Company\UpdateCompanyDto;
use App\Mappers\CompanyMapper;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyService{

    private $companyRepository;
    private int $maxCountries = 9;

    public function __construct(CompanyRepository $companyRepository) {
        $this->companyRepository = $companyRepository;
    }

    public function getCompanyById($id){
        return $this->companyRepository->findByCompanyId($id);
    }

    public function getAllByPage(int $page){
        return $this->companyRepository->findByPage($page);
    }
    
    public function getByUser(){
        $user = Auth::user();
        return $user->companies;
    }

    private function create(CreateCompanyDto $createCompanyDto){
        $existentCompany = $this->companyRepository->findByName($createCompanyDto->name);
        if(!empty($existentCompany)){
            throw new \Exception('Company with name ' . $createCompanyDto->name . ' already exists');
        }
        $company = new Company();
        $company->name = $createCompanyDto->name;
        $company->email = $createCompanyDto->email;
        $company->country()->associate($createCompanyDto->country);
        $company->user()->associate($createCompanyDto->user);
        if($company->save()){
            session()->flash('message','Company created successfully');
        }
    }

    public function add(AddCompanyDto $addCompanyDto){
        try{ 
            $user = Auth::user();
            if($user->companies->count() === $this->maxCountries){
                throw new \Exception('You can only have a maximum of ' . $this->maxCountries .' countries'); 
            }
            $country = $user->country;
            $createCompanyDto = new CreateCompanyDto($addCompanyDto->name, 
                                                     $addCompanyDto->email, 
                                                     $country,
                                                     $user);
            $this->create($createCompanyDto);
        }catch(\Exception $ex){
            session()->flash('error', $ex->getMessage());
        }
    }

    public function update(UpdateCompanyDto $updateCompanyDto){
        try{
            $user = Auth::user();
            $company = $this->companyRepository->findById($updateCompanyDto->companyId);
            if(empty($company)){
                throw new \Exception('Company with id ' . $updateCompanyDto->companyId . ' does not exist');
            }
            if($company->user->id !== $user->id){
                throw new \Exception('Company ' . $company->name . ' does not belong to you');   
            }
            if(!empty($updateCompanyDto->name)){
                $existentCompany = $this->companyRepository->findByName($updateCompanyDto->name);
                if(!empty($existentCompany)){
                    throw new \Exception('Company with name ' . $updateCompanyDto->name . ' already exists');
                }
            }
            $company = CompanyMapper::updateCompany($company,$updateCompanyDto);
            if($company->save()){
                session()->flash('message','Company updated successfully');
            }
        }catch(\Exception $ex){
            session()->flash('error', $ex->getMessage());
        }
    }

    public function delete($companyId){
        try{
            $user = Auth::user();
            $company = $this->companyRepository->findById($companyId);
            if(empty($company)){
                throw new \Exception('Company with id ' . $companyId . ' does not exist');
            }
            if($company->user->id !== $user->id){
                throw new \Exception('Company ' . $company->name . ' does not belong to you');   
            }
            if($company->delete()){
                session()->flash('message','Company deleted!');
            }
        }catch(\Exception $ex){
            session()->flash('error', $ex->getMessage());
        }
    }
}