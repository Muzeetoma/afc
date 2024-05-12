<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Services\CompanyService;
use App\Services\Dto\Company\AddCompanyDto;
use App\Services\Dto\Company\UpdateCompanyDto;
use App\Http\Controllers\Controller;
use App\Services\CountryService;

class AdminCompanyController extends Controller
{
    private $companyService;
    private $countryService;
    private int $maxPage=10;

    public function __construct(CompanyService $companyService,CountryService $countryService) {
        $this->companyService = $companyService;
        $this->countryService = $countryService;
    }

    public function viewCompany(){
        $companies = $this->companyService->getByUser();
        return Inertia::render('Admin/Company/Index',[
            'companies'=> $companies
        ]);
    }

    public function viewCompanyCreate(){
        $companies = $this->companyService->getByUser();
        return Inertia::render('Admin/Company/CreateCompany',[
            'companies'=> $companies
        ]);
    }

    public function viewCompanyUpdate($id){
        if(empty($id)){
            session()->flash('error', 'company id to view must be provided');
            return;
        }
        $countries = $this->countryService->getAll();
        $company = $this->companyService->getCompanyById($id);
        return Inertia::render('Admin/Company/UpdateCompany',[
            'company'=> $company,
            'countries'=>$countries,
        ]);
    }

    public function createCompany(CreateCompanyRequest $request){
        $addCompanyDto = new AddCompanyDto($request->name, $request->email);
        $this->companyService->add($addCompanyDto);
    }

    public function updateCompany(UpdateCompanyRequest $request,$id){
        if(empty($id)){
            session()->flash('error', 'company id to update must be provided');
            return;
        }
        $updateCompanyDto = new UpdateCompanyDto();
        $updateCompanyDto->email = $request->email;
        $updateCompanyDto->name = $request->name;
        $updateCompanyDto->companyId = $id;
        $this->companyService->update($updateCompanyDto);
    }

    public function deleteCompany($id){
        if(empty($id)){
            session()->flash('error', 'company id to delete must be provided');
            return;
        }
        $this->companyService->delete($id);
    }
}