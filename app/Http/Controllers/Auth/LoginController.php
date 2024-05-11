<?php


namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller{


    public function view(){
        return Inertia('Auth/LoginForm');
    }

    public function login(LoginRequest $loginRequest){
        $loginRequest->authenticate();
        $loginRequest->session()->regenerate();
        return redirect('/');
    }
}