<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\CompanyService;
use App\Services\Services;
use App\Services\Dto\Company\CreateCompanyDto;
use App\Services\Dto\Country\CountryDto;
use App\Services\Dto\User\UserDto;
use App\Services\Dto\User\UpdateUserDto;
use App\Services\Dto\Company\AddCompanyDto;
use App\Services\Dto\Company\UpdateCompanyDto;
use App\Services\Dto\Service\ServiceDto;
use App\Services\Dto\Service\UpdateServiceDto;

class UserController extends Controller
{
    private $userService;
    private $companyService;
    private $services;


    public function __construct(UserService $userService,CompanyService $companyService, Services $services) {
        $this->userService = $userService;
        $this->companyService = $companyService;
        $this->services = $services;
    }

    public function createUser(){

        $userDto = new UserDto(
            'John Doe',
            'john@example.com',
            'profile.jpg',
            '1234567890',
            '123 Main St',
            'password123',
            'Nigeria'
        );

        $userDto1 = new UserDto(
            'Boss Doe',
            'boss@example.com',
            'profile.jpg',
            '12345678453',
            '123 Main St',
            'password123',
            'Nigeria'
        );

        $updateUser = new UpdateUserDto();
        $updateUser->userId = 1;
        $updateUser->name = "Cackerworm";
        $updateUser->country = "Chad";

        $addCompanyDto = new AddCompanyDto('K and K', 'kunroee@mail.com');
    

        $updateCompanyDto = new UpdateCompanyDto();
        $updateCompanyDto->email = 'k@mail.com';
        $updateCompanyDto->companyId = 4;

        $serviceDto = new ServiceDto(4, 'Cleaning services');

        $updateServiceDto = new UpdateServiceDto();
        $updateServiceDto->name = "Mechanic Service";
        $updateServiceDto->serviceId = 10;
        $updateServiceDto->companyId = 4;

        $this->userService->create($userDto);
        $this->userService->update($updateUser);

        $this->companyService->add($addCompanyDto);

        $this->companyService->update($updateCompanyDto);

        //$this->companyService->delete(1);

        $this->services->create($serviceDto);

        $this->services->update($updateServiceDto);

        $this->services->delete(10);
    }
}
