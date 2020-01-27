<?php
namespace App\Models;

class ProfileModel
{
    private $website;
    private $company;
    private $phonenumber;
    private $users_id;
    
    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return mixed
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * @return mixed
     */
    public function getUsers_id()
    {
        return $this->users_id;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @param mixed $phonenumber
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;
    }

    /**
     * @param mixed $users_id
     */
    public function setUsers_id($users_id)
    {
        $this->users_id = $users_id;
    }

    public function __construct($website, $company, $phonenumber, $users_id){
        $this->website = $website;
        $this->company = $company;
        $this->phonenumber = $phonenumber;
        $this->users_id = $users_id;
    }
    
}

