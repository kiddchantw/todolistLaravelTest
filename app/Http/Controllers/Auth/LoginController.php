<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


/**
 * @group user Login 
 * 
 * auth的所有操作
 */

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * login API
     * 登入. 
     * 
     * @bodyParam  name string required.
     * @bodyParam password string required.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            do {
                $loginToken = Str::random(60);
                $checkTokenExist = Users::where('remember_token', '=', $loginToken)->first();
            } while ($checkTokenExist);

            $user = Users::where('name', '=', $request->name)->first();
            $user->remember_token =  $loginToken;
            $user->token_expire_time = date('Y/m/d H:i:s', time() + 10 * 60);
            $user->save();
            $response = array("token" => $user->remember_token, "expire_time" => $user->token_expire_time);
        } else {
            $response = "login error";
        }

        return response()->json(['message' => $response], 200);
    }


    public function logout(Request $request)
    {
        // if (Auth::check()) {
        //     dd("1");
        // } else {
        //     dd("2");
        // }


        $user = $request->user();
        $user->remember_token = Null;
        $user->token_expire_time = Null;
        $user->save();
        
        return response()->json(['message' => "logout success!"], 200);
    }


     /**
     * show API
     * 顯示個人資料. 
     * 
     * @bodyParam remember_token string required.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        # code...
        return $request->user();
    }

    /**
     * resetPassword API
     * 重設密碼. 
     * 
     * @bodyParam  reset_password string required.
     * @bodyParam remember_token string required.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function resetPassword (Request $request)
    {
        $user =  $request->user() ;
        $user->password = $request->reset_password ;
        $user->save();
        return response()->json(['message' => "reset Password success!"], 200);
    }


    public function refreshToken(Request $request){
        $user = $request->user();
        $user->token_expire_time = date('Y/m/d H:i:s', time()+5*60);
        $user->save();

        $response = array("token"=>$user->remember_token , "expire_time"=> $user->token_expire_time) ;   
        return response()->json(['message' => $response], 200);
    }

}
