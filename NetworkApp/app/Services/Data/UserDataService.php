<?php
namespace App\Services\Data;
use App\Models\Database;
use App\Interfaces\Data\UserDataInterface;
session_start();

class UserDataService implements UserDataInterface{

    
    /*
     * @see UserBusinessService createNewUser
     */
    public function createNewUser($user){

        $db = new Database();

        $connection = $db->getConnection();

        if(!$this->credentials($user))
       {

        $stmt = $connection->prepare("INSERT INTO users (firstname, lastname, password, role, company, website, phonenumber, email) VALUES (?,?,?,?,?,?,?,?)");

        if (!$stmt){
            echo "Something went wrong in the binding process. sql error?";
            exit;
        }

        $fn = $user->getFirstName();
        $ln = $user->getLastName();
        $role = $user->getRole();
        $password = $user->getPassword();
        $company = $user->getCompany();
        $website = $user->getWebsite();
        $email = $user->getEmail();
        $phonenumber = $user->getPhonenumber();

        $stmt->bind_param("sssissis", $fn, $ln, $password, $role, $company, $website, $phonenumber, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0){
            return true;
        }

        else{
            return false;
        }

        mysqli_close($connection);
     }
}

    /*
     * @see UserBusinessService authenticateUser
     */
    public function authenticateUser($user)
    {
        $db = new Database();
        $connection = $db->getConnection();
        $attemptedLoginEmail = $user->getEmail();
        $attemptedPassword = $user->getPassword();
        $stmt = "SELECT id, firstname, lastname, password, role, company, website, phonenumber, email FROM users WHERE email = '$attemptedLoginEmail' AND password = '$attemptedPassword' LIMIT 1";
     
        $result = mysqli_query($connection, $stmt);
       

        if (!$result){ 
            return false;
        }

        else if ($result) {
            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_assoc($result);
                $_SESSION = null;
                $_SESSION['email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['role'] = $row['role'];

            return true;
        }

        mysqli_close($connection);
    }
 }

    public function credentials($user)
    {
        $db = new Database();
        $connection = $db->getConnection();

        $attemptedLoginEmail = $user->getEmail();
        $attemptedPassword = $user->getPassword();

        $stmt = "SELECT id, firstname, lastname, password, role, company, website, phonenumber, email FROM users WHERE email = '$attemptedLoginEmail' AND password = '$attemptedPassword' LIMIT 1";

        $result = mysqli_query($connection, $stmt);
        
        
        if (!$result){
            return true;
        }
    
            if (mysqli_num_rows($result) == 1) {
            return true;
        }
        else{

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