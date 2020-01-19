<?php
namespace App\Interfaces\Business;
interface UserBusinessInterface{
    
    public function authenticateUser($user);
    public function createNewUser($user);
}
