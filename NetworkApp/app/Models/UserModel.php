<?php
namespace App\Models;
class UserModel{
    
    private $id;
    private $password;
    private $firstname;
    private $lastname;
    private $role;
    private $company;
    private $website;
    private $phonenumber;
    private $email;
    
    public function __construct($id, $firstname, $lastname, $email, $password, $role)
    {
        $this->id = $id;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->role = $role;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getLastName()
    {
        return $this->lastname;
    }
    public function getFirstName()
    {
        return $this->firstname;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
   
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }
    
    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
    }
    
    public function setFirstName($firstname)
    {
        $this->firstname = $firstname;
    }
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
  
    
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
    
    
}
?>