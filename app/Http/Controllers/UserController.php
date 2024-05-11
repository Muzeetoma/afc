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

    public function create(){

        $userDto = new UserDto(
            'John Doe',
            'john@example.com',
            'profile.jpg',
            '1234567890',
            '123 Main St',
            'password123',
            'Nigeria'
        );

        $this->userService->create($userDto);
    }

    public function update(){
        $updateUser = new UpdateUserDto();
        $updateUser->userId = 1;
        $updateUser->name = "Cackerworm";
        $updateUser->country = "Chad";

        $this->userService->update($updateUser);
    }
}
