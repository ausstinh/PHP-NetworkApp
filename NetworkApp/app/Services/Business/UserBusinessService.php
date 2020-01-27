<?php
namespace App\Services\Business;
use App\Interfaces\Business\UserBusinessInterface;
use App\Services\Data\UserDataService;
class UserBusinessService implements UserBusinessInterface{
    
    //Refer to UserBusinessInterface
   public function authenticateUser($user) {
        $dbService = new UserDataService();
        $person = $dbService->authenticateUser($user);
        return $person;
    }
    //Refer to UserBusinessInterface
    public function createNewUser($user) {
        

        $dbService = new UserDataService();
        $persons = $dbService->CreateNewUser($user);
        return $persons;
    }
    //Refer to UserBusinessInterface
    public function terminateUser($user)
    {}
    //Refer to UserBusinessInterface
    public function refurbishUser($user)
    {}

}



?>