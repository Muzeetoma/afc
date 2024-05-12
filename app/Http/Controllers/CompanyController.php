<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Requests\CreateCompanyRequest;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    private $companyService;
    private int $maxPage=10;

    public function __construct(CompanyService $companyService) {
        $this->companyService = $companyService;
    }

    public function getById($id){
        $company = $this->companyService->getCompanyById($id);
        return Inertia::render('Company/Index', [
            'company' => $company
        ]);
    }
}