<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Business\UserBusinessService;
use App\Models\UserModel;
class AccountController extends Controller
{
    
     //Uses the UserBusinessService createNewUser method and returns its result
     
    public function register(Request $request)
    {
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');

        $userBS = new UserBusinessService();
     
        $user = new UserModel(null, $firstName, $lastName,$password, null, null, null, null, $email);
        
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

       $email = $request->input('email');
       $password = $request->input('password');
       $userBS = new UserBusinessService();

       $user = new UserModel(null, null, null, $password, null, null, null, null, $email);

       $data = ['email' => $email];

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
