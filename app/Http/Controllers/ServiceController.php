<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Services;

class ServiceController extends Controller
{
    private $services;
    

    public function __construct(Services $services) {
        $this->services = $services;
    }

    public function getByCompany(){
        $services = $this->services->getByCompany(1);
        return response()->json(['company' => $services], 200);
    }
}
