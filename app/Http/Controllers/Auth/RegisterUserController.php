<?php


namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Controllers\Controller;
use App\Services\CountryService;
use App\Services\UserService;
use App\Services\Dto\User\UserDto;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller{

    private $countryService;
    private $userService;

    public function __construct(CountryService $countryService,UserService $userService) {
        $this->countryService = $countryService;
        $this->userService = $userService;
    }
    public function view(){
        $countries = $this->countryService->getAll();
        return Inertia('Auth/RegisterForm',[
            'countries' => $countries
        ]);
    }

    public function register(UserRegisterRequest $registerRequest){

        $userDto = new UserDto($registerRequest->name, 
                            $registerRequest->email, 
                            $registerRequest->file('image'),
                            $registerRequest->mobile, 
                            $registerRequest->address, 
                            $registerRequest->password,
                            $registerRequest->country
                        );

        $user = $this->userService->create($userDto);
        
        if($user){
            Auth::login($user);
        
            return redirect('/');
        }
      
    }
}