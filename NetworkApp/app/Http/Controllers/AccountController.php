<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Business\UserBusinessService;
use App\Models\UserModel;
class AccountController extends Controller
{
    /**
     * Takes in a new user
     * Calls the business service to register
     * If successful, return the login form
     * If not, return the register form
     *
     * @param newUser	user to register
     * @return login view page
     */
    public function register(Request $request)
    {
        //variables to store user input
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        //new instance of business service
        $userBS = new UserBusinessService();
        //create new user and with variables holding user input
        
        $user = new UserModel(null, $firstName, $lastName, $email, $password, 0);
        //if statement checking if createNewUser returns true
        if($userBS->createNewUser($user))
        {
            //if true, return login view
            return view("login");
        }
        else{
            //if false, re-return register page so user can try again
            return view("register");
        }
        
    }
    
    /**
     * Takes in a user to log in with
     * Calls the business service to login
     * If successful, return index page If not, return the login form
     *
     * @param attemptedLogin	user to log in with
     * @return home view page with user data
     */
    public function login(Request $request)
    {
        //two variables to store user email and password
        $email = $request->input('email');
        $password = $request->input('password');
        //create new instance of userBusinessService
        $userBS = new UserBusinessService();
        
        //create new user with variables storing user input
        $attemptedUser = new UserModel(null, null, null, $email, $password, 0);
        
        //attempt to authenticate user
        $user = $userBS->authenticateUser($attemptedUser);
        //if statement using authenticate method from business service class passing new user created
        if($user)
        {
            //if user is successfully authenticated, return view displaying success
            return view("home");
            
            $_SESSION['user_id'] = $user->getId();
            Log::get($user->getId());
            Log::get($_SESSION['user_id'] );
            exit;
            $_SESSION['role'] = $user->getRole();
            
            $data = ['model' => $user];
            
            return view("home")->with($data);
        }
        else
            //if user is not authenticated successfully, return login view so user can attempt to login again
            return view("login");
            
    }
    /**
     * Takes in a user to loggout with
     * returns a redirect to destroy session and login view page
     *
     * @param attemptedLogin	user to log in with
     * @return redirect to login view page with session destroyed
     */
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
    
}
