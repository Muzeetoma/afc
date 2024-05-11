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

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function update(){
        $updateUser = new UpdateUserDto();
        $updateUser->userId = 1;
        $updateUser->name = "Cackerworm";
        $updateUser->country = "Chad";

        $this->userService->update($updateUser);
    }
}
