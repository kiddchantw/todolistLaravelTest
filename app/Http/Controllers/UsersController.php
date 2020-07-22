<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Session;


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
				$user->password = $loginPassword;
				$user->save();


				$resultLoginInfo = Users::where('name',$loginName)->first();

				$resultUserId = $resultLoginInfo->id ;
				Session::put('resultUserId', $resultUserId);
				Session::put('resultUserName', $loginName);


				return back();


				
			case 'login2':

			// $loginName = (string)$request->input("input_name");
			$loginName = $request->input_name;
			$loginPassword = $request->input("input_password");

			$resultLoginInfo = Users::where('name',$loginName)->first();

			$resultUserId = $resultLoginInfo->id ;
			$resultUserPW = $resultLoginInfo->password ;

			if($resultUserPW == $loginPassword){
				echo "login 成功";
				Session::put('resultUserId', $resultUserId);
				Session::put('resultUserName', $loginName);
				return back();
			}else{
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
