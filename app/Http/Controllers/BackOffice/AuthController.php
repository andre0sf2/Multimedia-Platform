<?php 

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use DB;

class AuthController extends Controller {

    public $successStatus=200;

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */
    /* public function register(Request $request) {
        $validator=Validator::make($request->all(), [ 'name'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required',
            'c_password'=> 'required|same:password',
            ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input=$request->all();
        $input['password']=bcrypt($input['password']);
        $user=User::create($input);
        $success['token']=$user->createToken('FigsPlatformToken')->accessToken;
        $success['name']=$user->name;
        return response()->json(['success'=>$success], $this->successStatus);
    } */

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function details() {
        $user=Auth::user();
        return response()->json(['success'=> $user], $this-> successStatus);
    }

    public function logout(Request $request) {        
        User::where('id', $user->id)->update(['api_token'=> null]);

        return response()->json(null, 204);
    }

}
