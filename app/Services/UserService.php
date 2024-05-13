<?php

namespace App\Services;
use App\Repositories\UserRepository;
use App\Services\Dto\User\UserDto;
use App\Services\Dto\User\UpdateUserDto;
use App\Services\Dto\Country\CountryDto;
use App\Services\Dto\Service\ServiceDto;
use App\Services\Dto\Company\CreateCompanyDto;
use App\Mappers\UserMapper;
use App\Services\CountryService;
use Illuminate\Support\Facades\Auth;

class UserService{

    private $userRepository;
    private $countryService;

    public function __construct(UserRepository $userRepository,
                                CountryService $countryService) {
        $this->userRepository = $userRepository;
        $this->countryService = $countryService;
    }

    public function create(UserDto $userDto){
        try {
            $userByEmailOrMobile = $this->userRepository->findByEmailOrMobile($userDto->email, $userDto->mobile); 
       
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

            $userDto->image = $this->uploadImage($userDto->image);

            $user = UserMapper::createUser($userDto);

            $user->country()->associate($country);
            
            if($user->save()){
                session()->flash('message','User created successfully');
                return $user;
            }
        } catch (\Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
    }

    public function update(UpdateUserDto $updateUserDto){
        try{
            if (
                empty($updateUserDto->name) &&
                empty($updateUserDto->country) &&
                empty($updateUserDto->address) &&
                empty($updateUserDto->image) &&
                empty($updateUserDto->mobile) &&
                empty($updateUserDto->email)
            ) {
                throw new \Exception('No value was added to be updated.');  
            } 

            $user = Auth::user();
            $oldImage = "";
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

            if(!empty($updateUserDto->image)){
               $updateUserDto->image = $this->uploadImage($updateUserDto->image);
               $oldImage = $user->image;
            }

            $user = UserMapper::updateUser($user, $updateUserDto);

            if($user->save()){
                session()->flash('message','User updated successfully');
                //delete image here
                return $user;
            }
        } catch (\Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
    }

    public function uploadImage($file){
        try{
             if(empty($file)){
                 throw new \Exception('image file does not exist');
             }
             $imageName = $file->getClientOriginalName();
             $ext = $file->getClientOriginalExtension();
             $destinationPath = 'uploads';
             $file->move($destinationPath, $imageName);
             return $imageName;
        } catch (\Exception $ex) {
           session()->flash('error', $ex->getMessage());
        }
     }

}