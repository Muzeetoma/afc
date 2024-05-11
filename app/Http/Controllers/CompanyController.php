<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Requests\CreateCompanyRequest;
use App\Services\CompanyService;
use App\Services\Dto\Company\AddCompanyDto;
use App\Services\Dto\Company\UpdateCompanyDto;

class CompanyController extends Controller
{
    private $companyService;
    private int $maxPage=10;

    public function __construct(CompanyService $companyService) {
        $this->companyService = $companyService;
    }

    public function view(){
        return Inertia::render('Admin/CompanyCreate');
    }

    public function getById($id){
        $company = $this->companyService->getCompanyById($id);
        return Inertia::render('Company/Index', [
            'company' => $company
        ]);
    }
    public function getAll(){
        $companies = $this->companyService->getAllByPage($this->maxPage);
        return Inertia::render('Index', [
            'companies' => $companies
        ]);
    }

    public function getByUser(){
        $companies = $this->companyService->getByUser();
    }

    public function create(CreateCompanyRequest $request){
        $addCompanyDto = new AddCompanyDto($request->name, $request->email);
        $this->companyService->add($addCompanyDto);
    }

    public function update(){
        $updateCompanyDto = new UpdateCompanyDto();
        $updateCompanyDto->email = 'k@mail.com';
        $updateCompanyDto->companyId = 4;
        $this->companyService->update($updateCompanyDto);
    }
}