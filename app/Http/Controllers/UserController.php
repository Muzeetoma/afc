<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use App\Services\Dto\User\UpdateUserDto;
use Illuminate\Support\Facades\Auth;
use App\Services\CountryService;



class UserController extends Controller
{
    private $userService;
    private $countryService;

    public function __construct(UserService $userService,CountryService $countryService,) {
        $this->userService = $userService;
        $this->countryService = $countryService;
    }

    public function updateView(){
        $user = Auth::user()->with('country')->first();
        $countries = $this->countryService->getAll();
        return Inertia::render('User/UserUpdate',[
            'user' => $user,
            'countries'=>$countries
        ]);
    }

    public function update(UserUpdateRequest $request){
        $updateUser = new UpdateUserDto();
        $updateUser->name = $request->name;
        $updateUser->country = $request->country;
        $updateUser->address = $request->address;
        $updateUser->image = $request->file('image');
        $updateUser->mobile = $request->mobile;
        $updateUser->email = $request->email;
        $this->userService->update($updateUser);
    }
}
