<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

     protected function authenticated($request, $user){
         if($user->privilege == 'admin'){
            return redirect('/users');
         }
         elseif($user->privilege == 'executive'){
             return redirect('/home');
         }
         elseif($user->privilege == 'leasingOfficer'){
            return redirect('/home');
        }
        elseif($user->privilege == 'treasury'){
            return redirect('/residents');
        }
        elseif($user->privilege == 'resident'){  
            return redirect('/residents/'.auth()->user()->user_resident_id);
        }
        elseif($user->privilege == 'owner'){
            return redirect('/owners/'.auth()->user()->user_owner_id);
        }
         
     }
    // protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
