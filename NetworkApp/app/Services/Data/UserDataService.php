<?php
namespace App\Services\Data;
use App\Models\DatabaseModel;
use App\Interfaces\Data\UserDataInterface;
use App\Models\UserModel;
session_start();

class UserDataService implements UserDataInterface{

    
    /*
     * @see UserBusinessService createNewUser
     */
    public function createNewUser($user){

        $db = new DatabaseModel();

        $connection = $db->getConnection();

        if(!$this->credentials($user))
       {

        $stmt = $connection->prepare("INSERT INTO users (firstname, lastname, email, password, role) VALUES (?,?,?,?,?)");

        if (!$stmt){
            echo "Something went wrong in the binding process. sql error?";
            exit;
        }
        $email = $user->getEmail();
        $fn = $user->getFirstName();
        $ln = $user->getLastName();
        $role = $user->getRole();
        $password = $user->getPassword();


        $stmt->bind_param("ssssi", $fn, $ln, $email, $password, $role);
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
        $db = new DatabaseModel();
        $connection = $db->getConnection();  
        $attemptedLoginEmail = $user->getEmail();
        $attemptedPassword = $user->getPassword();
        $stmt = "SELECT id, firstname, lastname, password, role, email FROM users WHERE email = '$attemptedLoginEmail' AND password = '$attemptedPassword' LIMIT 1";
        
        $result = mysqli_query($connection, $stmt);
        
        
        if (!$result){
            return true;
        }
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
           $id = $row['id'];
           $fn =  $row['firstname'];
           $ln = $row['lastname'];
           $role = $row['role'];
        }
   
        $p = new UserModel($id, $fn, $ln, $attemptedLoginEmail, $attemptedPassword, $role);
               
        return $p;      
 }

    public function credentials($user)
    {
        $db = new DatabaseModel();
        $connection = $db->getConnection();

        $attemptedLoginEmail = $user->getEmail();
        $attemptedPassword = $user->getPassword();

        $stmt = "SELECT id, firstname, lastname, password, role, email FROM users WHERE email = '$attemptedLoginEmail' AND password = '$attemptedPassword' LIMIT 1";

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