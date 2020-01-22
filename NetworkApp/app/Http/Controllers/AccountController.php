<?php

namespace App\Http\Controllers;

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
