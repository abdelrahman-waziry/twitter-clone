<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/tweets';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $auth_user = Socialite::driver($provider)->user();
        
        $user = User::updateOrCreate(
            [
                'email' => $auth_user->email
            ],
            [
                'token' => bcrypt($auth_user->token),
                'name'  =>  $auth_user->name, 
                'username' => $auth_user->nickname ?: explode(" ", $auth_user->name)[0] . str_random(5),
                'avatar' => $auth_user->avatar_original
            ]
        );

        // if(!$user->username){

        //     $user->save();  
        // }
        
        Auth::login($user, true);
        return redirect()->to('/');
    }
}
