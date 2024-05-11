<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Services\Dto\Company\AddCompanyDto;
use App\Services\Dto\Company\UpdateCompanyDto;

class CompanyController extends Controller
{
    private $companyService;

    public function __construct(CompanyService $companyService) {
        $this->companyService = $companyService;
    }

    public function getAll(){
        $companies = $this->companyService->getAllByPage(3);
        return Inertia::render('Index', [
            'companies' => $companies
          ]);
       // return response()->json(['company' => $companies], 200);
    }

    public function getByUser(){
        $companies = $this->companyService->getByUser();
        return response()->json(['company' => $companies], 200);
    }

    public function create(Request $request){
        $addCompanyDto = new AddCompanyDto('K and K', 'kunroee@mail.com');
        $this->companyService->add($addCompanyDto);
    }

    public function update(Request $request){
        $updateCompanyDto = new UpdateCompanyDto();
        $updateCompanyDto->email = 'k@mail.com';
        $updateCompanyDto->companyId = 4;

        $this->companyService->update($updateCompanyDto);
    }
}