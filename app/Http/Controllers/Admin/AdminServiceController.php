<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Services\Services;
use App\Services\Dto\Service\ServiceDto;
use App\Services\Dto\Service\UpdateServiceDto;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminServiceController extends Controller
{
    private $services;
    
    public function __construct(Services $services) {
        $this->services = $services;
    }

    public function viewService($id){
        if(empty($id)){
            session()->flash('error', 'company id to view services must be provided');
            return;
        }
        $services = $this->services->getByCompanyId($id);
        return Inertia::render('Admin/Services/Index',[
            'services' => $services
        ]);
    }

    public function createServiceView(){
        $companies = Auth::user()->companies()->get();
        return Inertia::render('Admin/Services/ServiceCreate',[
            'companies' => $companies
        ]);
    }

    public function updateServiceView($id){
        if(empty($id)){
            session()->flash('error', 'service id to view must be provided');
            return;
        }
        $service = $this->services->getById($id);
        return Inertia::render('Admin/Services/ServiceUpdate',[
            'service'=> $service,
        ]);
    }

    public function createService(CreateServiceRequest $request){
        $serviceDto = new ServiceDto($request->company_id, $request->service);
        $this->services->create($serviceDto);
    }

    public function updateService(UpdateServiceRequest $request,$id){
        if(empty($id)){
            session()->flash('error', 'service id to update must be provided');
            return;
        }
        $updateServiceDto = new UpdateServiceDto();
        $updateServiceDto->name = $request->service;
        $updateServiceDto->serviceId = $id;
        $this->services->update($updateServiceDto);
    }

    public function deleteService($id){
        if(empty($id)){
            session()->flash('error', 'service id to delete must be provided');
            return;
        }
        $this->services->delete($id);
    }
}
