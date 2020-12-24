<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;
use Session;
use Log;
// use App\Http\Requests;
// use App\Http\Requests\Request;

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

			$data = array(
				array(
					'user_id'=> $addTaskuserId,
					'content'=> $taskContent,
					'created_at'=> date("Y-m-d H:i:s",(time()+8*3600))
				)
			);
			Tasks::insert($data); // Eloquent approach
			return back();
		}
	}



	public static function readTask($id)
	{
		$taskShow = Tasks::where('user_id','=',$id)->get();//->toArray();
		return $taskShow;
	}

	public static function readTaskById($id)
	{
		$taskShow = Tasks::where('id','=',$id)->first();//->content
		return $taskShow;
	}



	public function updateTask(	Request $request)
	{
		$updateTaskId = $request->taskId ;
		Log::info($updateTaskId);
		$finshStatus = Tasks::find($updateTaskId)->done;
		$updateInt = 0;
		if ($finshStatus == 0) {
			$updateInt = 1;
		}else{
			$updateInt = 0;
		}
		Tasks::where('id','=',$updateTaskId)->update(['done'=>$updateInt]);

		return response()->json(['success'=>'Ajax Request: updateTask']);
	}



	public function deleteTask(	Request $request)
	{
		$deleteTaskId = $request->taskId ;

		Log::info($deleteTaskId);
		$deteleTest = Tasks::where('id','=',$deleteTaskId)->delete();
		// dd($deteleTest);
		// return response(['success'=>$deteleTest],200);
		response()->json(['success'=>'Got Simple Ajax Request 2: deleteTask']);
	}
}
