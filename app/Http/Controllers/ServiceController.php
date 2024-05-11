<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\CreateServiceRequest;
use App\Services\Services;
use App\Services\Dto\Service\ServiceDto;
use App\Services\Dto\Service\UpdateServiceDto;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    private $services;
    
    public function __construct(Services $services) {
        $this->services = $services;
    }

    public function view(){
        $user = Auth::user();
        return Inertia::render('Admin/ServiceCreate',[
            'companies' => $user->companies]);
    }

    public function getByCompany($id){
        $services = $this->services->getByCompany(1);
        return response()->json(['company' => $services], 200);
    }

    public function create(CreateServiceRequest $request){
        $serviceDto = new ServiceDto($request->company_id, $request->service);
        $this->services->create($serviceDto);
    }

    public function update(Request $request){
        $updateServiceDto = new UpdateServiceDto();
        $updateServiceDto->name = "Mechanic Service";
        $updateServiceDto->serviceId = 10;
        $updateServiceDto->companyId = 4;
        $this->services->update($updateServiceDto);
    }

    public function delete($id){
        $this->services->delete($id);
    }
}
