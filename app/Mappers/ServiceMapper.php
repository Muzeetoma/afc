<?php

namespace App\Mappers;
use App\Models\Service;
use App\Services\Dto\Service\UpdateServiceDto;

class ServiceMapper{

    public static function createService(string $name){
        $service = new Service();
        $service->name = $name;
        return $service;
    }

    public static function updateService(Service $service, UpdateServiceDto $updateServiceDto)
    {
        if (!empty($updateServiceDto->name)) {
            $service->name = $updateServiceDto->name;
        }
        return $service;
    }
}