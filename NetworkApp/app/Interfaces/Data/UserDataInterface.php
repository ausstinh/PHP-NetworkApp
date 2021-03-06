<?php
namespace App\Interfaces\Data;
interface UserDataInterface {
    /**
     * Takes in a user
     * Inserts user into the database if no user exists
     * @param $user     User information to login
     * @return true or false for login
     */
    public function createNewUser($user);
    /**
     * Takes in a user
     * Selects user from the database and create a user_id session
     * @param $user     User information to login
     * @return true or false for login
     */
    public function authenticateUser($user);
    /**
     * Takes in a user
     * Reads if user's credentials is in the database
     * @param $user     User information to login
     * @return true or false for login
     */
    public function credentials($user);
    /**
     * Takes in a user
     * Deletes user from the database
     * @param $user     User information to login
     * @return true or false for login
     */
    public function terminateUser($user);
    /**
     * Takes in a user
     * Updates user from the database
     * @param $user     User information to login
     * @return true or false for login
     */
    public function refurbishUser($user);
}