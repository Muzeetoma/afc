<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository{

    public function findByUserId(int $id){
        return User::find($id);
    }
    public function findByEmail(string $email){
        return User::whereRaw('LOWER(email) = :email', ['email' => strtolower($email)])->first();
    }

    public function findByMobile(string $mobile){
        return User::where('mobile', $mobile)->first();
    }

    public function findByEmailOrMobile(string $email,string $mobile){
       return User::whereRaw('LOWER(email) = LOWER(:email) OR mobile = :mobile', [
                                'email' => $email,
                                'mobile' => $mobile,
                            ])->first();
    }
    
}
