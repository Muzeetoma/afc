<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\CompanyService;

class DashboardController extends Controller
{
    private $companyService;
    private int $maxPage=10;

    public function __construct(CompanyService $companyService) {
        $this->companyService = $companyService;
    }

    public function index(){
        $companies = $this->companyService->getAllByPage($this->maxPage);
        return Inertia::render('Index', [
            'companies' => $companies
        ]);
    }

}