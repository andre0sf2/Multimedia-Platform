<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

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
    protected $redirectTo = '/back-office';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
 
        if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password])) {
            $user=Auth::user();
            $success['token']=$user->createToken('FigsPlatformToken')->accessToken;
            User::where('id', $user->id)->update(['api_token'=> $success['token']]);
            Auth::login($user);
            //return response()->json(['success'=> $success], 200);
            return redirect($this->redirectTo);
        }

        else {
            //return response()->json(['error'=>'Unauthorised'], 401);
            return redirect('login');
        }
    }
}
