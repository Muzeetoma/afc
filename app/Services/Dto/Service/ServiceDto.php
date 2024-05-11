<?php

namespace App\Services\Dto\Service;

class ServiceDto{
    public $companyId;
    public $name;

    public function __construct(int $companyId,string $name) {
        $this->companyId = $companyId;
        $this->name = $name;
    }
}