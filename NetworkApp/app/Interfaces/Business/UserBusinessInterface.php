<?php
namespace App\Interfaces\Business;
use App\Models\User;

interface UserBusinessInterface{
    
    /**
     * Takes in a user
     * Uses the UserDataService method to authenticateUser() and returns it's result
     * @param $user     User information to login
     * @return true or false for login
     */
    public function authenticateUser($user);
    
    
    
    /**
     * Takes in a user
     * Uses the UserDataService method to createNewUser() and returns it's result
     * @param $user     User information to register
     * @return true or false for createNewUser
     */  
    public function createNewUser($user);
}
