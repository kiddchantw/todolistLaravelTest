<?php

namespace App\Http\Controllers;

use App\Users;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{

	public function loginTest(Request $request)
	{
		$loginName = $request->input_name;
		$loginPassword = $request->input("input_password");

		switch ($request['action']) {

			case 'register':
				$user = new Users;
				$user->name = $loginName;
				// $user->password = $loginPassword;
				//$resultUserPW = Hash::make($resultLoginInfo->password);
				$user->password = Hash::make($loginPassword);


				$user->save();

				$resultLoginInfo = Users::where('name', $loginName)->first();

				$resultUserId = $resultLoginInfo->id;
				Session::put('resultUserId', $resultUserId);
				Session::put('resultUserName', $loginName);

				Log::info('註冊 new'.$loginName);

				return back();

			case 'login2':

				$loginName = $request->input_name;
				$loginPassword = $request->input("input_password");

				$resultLoginInfo = Users::where('name', $loginName)->first();
				$resultUserId = $resultLoginInfo->id;
				$resultUserPW = $resultLoginInfo->password;

				$conditionK = Hash::check($loginPassword, $resultUserPW);



				

				if ($conditionK) {
					


					do {
						$loginToken = Str::random(60);
						$checkTokenExist = Users::where('remember_token', '=', $loginToken)->first();
					} while ($checkTokenExist);



					$user = Users::where('name', '=', $loginName)->first();
					$user->remember_token =  $loginToken;
					$user->token_expire_time = date('Y/m/d H:i:s', time() + 10 * 60);
					$user->save();


					Session::put('resultUserId', $resultUserId);
					Session::put('resultUserName', $loginName);

					// echo "login 成功";
					Log::info('login 成功');
					return back();
				} else {
					Log::info("login 失敗  .$loginName ");

					echo "login 失敗";
				}

				break;


			case 'loginout2':
				Session::flush();
				return back();

				break;

			default:
				break;
		}
	}
}
