<?php
namespace App\Services\Business;
use App\Interfaces\Business\UserBusinessInterface;
use App\Services\Data\UserDataService;
class UserBusinessService implements UserBusinessInterface{
    
    //method that will allow user to login
   public function authenticateUser($user) {
        $dbService = new UserDataService();
        $person = $dbService->authenticateUser($user);
        return $person;
    }
    
    public function createNewUser($user) {
        

        $dbService = new UserDataService();
        $persons = $dbService->CreateNewUser($user);
        return $persons;
    }
    public function deleteUser($user)
    {}

    public function updateUser($user)
    {}

}



?>