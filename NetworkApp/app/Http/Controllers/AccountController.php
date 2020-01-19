<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Business\UserBusinessService;
use App\Models\User;
class AccountController extends Controller
{
    
     //Uses the UserBusinessService createNewUser method and returns its result
     
    public function register(Request $request)
    {
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        $username = $request->input('username');
        $password = $request->input('password');

        $userBS = new UserBusinessService();
     
        $user = new User(null, $firstName, $lastName, $username, $password, null, null, null, null, null);
        
        if($userBS->createNewUser($user))
        {
            return view("login");
        }
        else{

            return view("register");
        }
        
    }
    
    //Uses the UserBusinessService authenticateUser method and returns its result
    public function login(Request $request)
    {

       $username = $request->input('username');
       $password = $request->input('password');
       $userBS = new UserBusinessService();

       $user = new User(null, null, null, $username, $password, null, null, null, null, null);

       $data = ['username' => $username];

       if($userBS->authenticateUser($user))
       {

          return view("home")->with($data);
       }
       else

         return view("login");
       
    }

    public function logout(Request $request) {
        Auth::logout();
        //return login screen upon logging out
        return redirect('/login');
    }
    
}
