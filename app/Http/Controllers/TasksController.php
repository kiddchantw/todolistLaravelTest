<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;
use Session;


class TasksController extends Controller
{
    //
    public function addTask (Request $request)
	{
		$taskContent = (string)$request->input("input_task");
		$addTaskuserId = Session::get('resultUserId', 0);

		echo "$taskContent <br>";
		echo "$addTaskuserId  <br>";

		if ($addTaskuserId == 0 ){
			echo "請先登入";
		}else{
			// $user = new Tasks;
			// $user->
			$data = array(
    		array(
    			'user_id'=> $addTaskuserId,
    		 	'content'=> $taskContent,
    		 	'creat_at'=> date("Y-m-d H:i:s",(time()+8*3600))
    		 )
    		);
			Tasks::insert($data); // Eloquent approach
			return back();
    //...);
		}

	}



	public static function readTask($id)
	{
		$taskShow = Tasks::where('user_id','=',$id)->get();
		return $taskShow;

	}
}
