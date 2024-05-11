<?php

namespace App\Mappers;
use App\Models\User;
use App\Services\Dto\User\UserDto;
use App\Services\Dto\User\UpdateUserDto;
use Illuminate\Support\Facades\Hash;

class UserMapper{

    public static function createUser(UserDto $userDto){
        $user = new User();
        $user->name = $userDto->name;
        $user->email = $userDto->email;
        $user->image = $userDto->image;
        $user->mobile = $userDto->mobile;
        $user->address = $userDto->address;
        $user->password = Hash::make($userDto->password);
        return $user;
    }

    public static function updateUser(User $user, UpdateUserDto $userDto)
    {
        if (!empty($userDto->name)) {
            $user->name = $userDto->name;
        }

        if (!empty($userDto->email)) {
            $user->email = $userDto->email;
        }

        if (!empty($userDto->image)) {
            $user->image = $userDto->image;
        }

        if (!empty($userDto->mobile)) {
            $user->mobile = $userDto->mobile;
        }

        if (!empty($userDto->address)) {
            $user->address = $userDto->address;
        }

        return $user;
    }
}