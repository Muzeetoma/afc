<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    private $companyService;

    public function __construct(CompanyService $companyService) {
        $this->companyService = $companyService;
    }

    public function getAll(){
        $companies = $this->companyService->getAllByPage(3);
        return response()->json(['company' => $companies], 200);
    }

    public function getByUser(){
        $companies = $this->companyService->getByUser();
        return response()->json(['company' => $companies], 200);
    }
}