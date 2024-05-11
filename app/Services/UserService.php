<?php

namespace App\Services;
use App\Repositories\UserRepository;
use App\Services\Dto\User\UserDto;
use App\Services\Dto\User\UpdateUserDto;
use App\Services\Dto\Country\CountryDto;
use App\Services\Dto\Service\ServiceDto;
use App\Services\Dto\Company\CreateCompanyDto;
use App\Mappers\UserMapper;
use App\Services\CompanyService;
use App\Services\CountryService;
use Illuminate\Support\Facades\DB;

class UserService{

    private $userRepository;
    private $companyService;
    private $countryService;

    public function __construct(UserRepository $userRepository,
                                CompanyService $companyService,
                                CountryService $countryService) {
        $this->userRepository = $userRepository;
        $this->companyService = $companyService;
        $this->countryService = $countryService;
    }

    public function create(UserDto $userDto){
        try {
        $userByEmailOrMobile = $this->userRepository->findByEmailOrMobile($userDto->email,$userDto->mobile); 
        if (!empty($userByEmailOrMobile)) {
            if ($userByEmailOrMobile->email === $userDto->email) {
                $error = 'User with email ' . $userDto->email . ' already exists';
            } else {
                $error = 'User with mobile ' . $userDto->mobile . ' already exists';
            }
            throw new \Exception($error);
            }

            $country = $this->countryService->getByName($userDto->country);

            if(empty($country)){
                throw new \Exception('Country with name ' . $userDto->country . ' does not exists');
            }

            $user = UserMapper::createUser($userDto);
            $user->country()->associate($country);
            $user->save();

            return $user;
        } catch (\Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

    public function update(UpdateUserDto $updateUserDto){
        try{
            $user = $this->userRepository->findByUserId($updateUserDto->userId);
            if(empty($user)){
                throw new \Exception('User with id ' . $updateUserDto->userId . ' does not exist');  
            }

            if(!empty($updateUserDto->mobile)){
                $userByMobile = $this->userRepository->findByMobile($updateUserDto->mobile); 
                if(!empty($userByMobile)){
                    throw new \Exception('User with mobile ' . $updateUserDto->mobile . ' exists already');  
                }
            }

            if(!empty($updateUserDto->email)){
                $userByEmail = $this->userRepository->findByEmail($updateUserDto->email); 
                if(!empty($userByEmail)){
                    throw new \Exception('User with email ' . $updateUserDto->email . ' exists already');  
                }
            }

            if(!empty($updateUserDto->country)){
                $country = $this->countryService->getByName($updateUserDto->country);
                if(empty($country)){
                    throw new \Exception('Country with name ' . $updateUserDto->country . ' does not exists');
                }
                $user->country()->associate($country);
            }

            $newUser = UserMapper::updateUser($user, $updateUserDto);
            $user->save();

            return $user;
        } catch (\Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

}