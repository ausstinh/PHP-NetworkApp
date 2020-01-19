<?php
namespace App\Interfaces\Data;
interface UserDataInterface {
    public function createNewUser($user);
    public function authenticateUser($user);
    public function credentials($user);
}