<?php

namespace App\Services\Dto\User;

class UserDto{
    public $name;
    public $email;
    public $image;
    public $mobile;
    public $address;
    public $password;
    public $country;

    public function __construct($name, $email, $image, $mobile, $address, $password, $country)
    {
        $this->name = $name;
        $this->email = $email;
        $this->image = $image;
        $this->mobile = $mobile;
        $this->address = $address;
        $this->password = $password;
        $this->country = $country;
    }
}
