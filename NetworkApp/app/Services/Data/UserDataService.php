<?php
namespace App\Services\Data;
use App\Models\DatabaseModel;
use App\Interfaces\Data\UserDataInterface;
session_start();

class UserDataService implements UserDataInterface{

    
    /*
     * @see UserBusinessService createNewUser
     */
    public function createNewUser($user){
        //create new instance of DataBaseModel
        $db = new DatabaseModel();
        //grab connection to database
        $connection = $db->getConnection();
        //call credentials method created below. If credentials equals false: (pass $user in parameter)
        if(!$this->credentials($user))
       {
        //create sql statement to insert user into database
        $stmt = $connection->prepare("INSERT INTO users (firstname, lastname, password, role, company, website, phonenumber, email) VALUES (?,?,?,?,?,?,?,?)");
        //if sql statement fails. display error message
        if (!$stmt){
            echo "Something went wrong in the binding process. sql error?";
            exit;
        }
        //create varibales to retrieve properties of user
        $fn = $user->getFirstName();
        $ln = $user->getLastName();
        $role = $user->getRole();
        $password = $user->getPassword();
        $company = $user->getCompany();
        $website = $user->getWebsite();
        $email = $user->getEmail();
        $phonenumber = $user->getPhonenumber();
        //insert sql statement with variables storing user information 
        $stmt->bind_param("sssissis", $fn, $ln, $password, $role, $company, $website, $phonenumber, $email);
        $stmt->execute();
        
        //if number of affected rows within the database is greater than 0, meaning user got successfully entered
        if ($stmt->affected_rows > 0){
            //return true
            return true;
        }
        //else return false
        else{
            return false;
        }
        //close connection to database
        mysqli_close($connection);
     }
}

    /*
     * @see UserBusinessService authenticateUser
     */
    public function authenticateUser($user)
    {
       //create new instance of DataBaseModel
        $db = new DatabaseModel();
        ////grab connection to DB
        $connection = $db->getConnection();
        //create varibales holding user entered credentials 
        $attemptedLoginEmail = $user->getEmail();
        $attemptedPassword = $user->getPassword();
        //sql statement selecting information from Database with user fields
        $stmt = "SELECT id, firstname, lastname, password, role, company, website, phonenumber, email FROM users WHERE email = '$attemptedLoginEmail' AND password = '$attemptedPassword' LIMIT 1";
        //create variable that will be used to connect the databse connection and the sql statement
        $result = mysqli_query($connection, $stmt);
       
        //if result vaiable doesn't find user with entered credentials
        if (!$result){ 
            //return false
            return false;
        }
        //else if result found user in database
        else if ($result) {
            if (mysqli_num_rows($result) == 1) {
                //varibale that fetches user information from databse using $result variable
                $row = mysqli_fetch_assoc($result);
                //session variables storing user email, id, and role
                $_SESSION = null;
                $_SESSION['email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
            //return true
            return true;
        }
        //close connection to database
        mysqli_close($connection);
    }
 }
    
 /**
  * Takes in a user
  * @param $user     User information to login
  * @return true or false for seeing if user exist in database
  */  
    public function credentials($user)
    {   
        //create new instance of DatabaseModel
        $db = new DatabaseModel();
        //get connection from Database
        $connection = $db->getConnection();
        //variables to retrieve email and password from $user
        $attemptedLoginEmail = $user->getEmail();
        $attemptedPassword = $user->getPassword();
        //Select sql statement to look through database using user entered email and password
        $stmt = "SELECT id, firstname, lastname, password, role, company, website, phonenumber, email FROM users WHERE email = '$attemptedLoginEmail' AND password = '$attemptedPassword' LIMIT 1";
        //variable to store sql statment and connection to database
        $result = mysqli_query($connection, $stmt);
        
        if (!$result){
             
            return true;
        }
            //if sql statement finds a row in database with specified user credentials
            if (mysqli_num_rows($result) == 1) {
            //return true
            return true;
        }
        //if result doesn't find user within database
        else{
            //return false
            return false;
        }
    }
    /*
     * @see UserBusinessService deleteNewUser
     */
    public function terminateUser($user)
    {}
    /*
     * @see UserBusinessService updateNewUser
     */
    public function refurbishUser($user)
    {}

}


?>