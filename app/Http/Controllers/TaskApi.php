<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Validation\ValidationException;

use Illuminate\Http\Request;
use App\Tasks;
use Session;
use Log;


use Illuminate\Validation\ValidationException;

class TaskApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $taskShow = Tasks::all();
        // echo  $taskShow;
        echo  Tasks::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        ////m1 ok
        // $validator = Validator::make($request->all(), [
        //     'user_id' => 'required|integer',
        //     'content' => 'required|string'
        // ]);

        // if ($validator->fails()) {
        //     $messages = $validator->errors()->all();
        //     $msg = $messages[0];

        //     return response()->json(['success_code' => 401, 'response_code' => 0, 'response_message' => $msg]);
        // }

        //m2 預設repsonseok 但想做custom的
        try {
            $rules = [
                "user_id" => "required|integer|exists:users,id",
                "content" => "required|string",
            ];
            $message = [
                // 欄位名稱.驗證方法名稱
                "user_id.required" => "請輸入id",
                "content.required" => "請輸入文章內容"
            ];
            $validResult = $request->validate($rules, $message);

        } catch (ValidationException $exception) {

            $errorMessage = $exception->validator->errors()->all();
            return response()->json([
                'message' => $errorMessage
            ], 400);
        }


        $data = array(
            array(
                'user_id' => $request->user_id,
                'content' => $request->content,
                'creat_at' => date("Y-m-d H:i:s", (time() + 8 * 3600))
            )
        );
        Log::info($data);

        $taskAdd = Tasks::insert($data);

        if ($taskAdd == true) {
            return response()->json("add success", 201);
        } else {
            return response()->json("add 失敗", 201);

            //todo : 沒成功。故意用user id = 2(沒此人)
            //postmans是顯示各著Illuminate\Database\QueryException: SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`dbtest001`.`tasks`, CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)) (SQL: insert into `tasks` (`content`, `creat_at`, `user_id`) values (test5566, 2020-06-16 20:25:56, 2)) in file /usr/local/var/wwwa/testLa/todolistV3/vendor/laravel/framework/src/Illuminate/Database/Connection.php on line 671

            // 如果已經用validator 還會有狀況嗎？
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // try {
        //     $rules = [
        //         // "user_id" 
        //         //$id => "required|integer|exists:users,id"
        //         'id'=>'required|unique:'
        //     ];
        //     $message = [
        //         // "user_id.required" 
        //         $id => "請輸入user id",
        //     ];
        //     $validResult = $request->validate($rules, $message);

        // } catch (ValidationException $exception) {

        //     $errorMessage = $exception->validator->errors()->all();
        //      return response()->json([
        //         'message' => $errorMessage
        //     ], 404);
        // }


        $taskShow = Tasks::where('user_id', '=', $id)->get();
        return $taskShow;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateTaskId = $request->taskId;
        Log::info($updateTaskId);
        $finshStatus = $request->taskDone; //Tasks::find($updateTaskId)->done;
        $updateInt = 0;
        if ($finshStatus == 0) {
            $updateInt = 1;
        } else {
            $updateInt = 0;
        }
        Tasks::where('id', '=', $updateTaskId)->update(['done' => $updateInt]);

        return response()->json('update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //m1 ok but status 204  no content
        //Tasks::where('id', '=', $id)->delete();
        // return response()->json(['message' => 'delete success'],204);

        //m2 use count() 
        $deleteTask =  Tasks::where('id', '=', $id);
        //return 
        if ($deleteTask->exists()){
            $deleteTask->delete();
            return response()->json(['message' => 'delete task success'], 200);
        }else{
            return response()->json(['message' => 'delete task id error'], 404);
        }

        
    //     if($deleteTask->exists()){
    // // has no records                        
    //         return "t  exist";
    //     }else{
    //         return "t doesn't exist";
    //     }
// if ($deleteTask->exist()) {
   // user doesn't exist
    // return "18888";

// }else{
    // return "1666";

// }
        // return var_dump($deleteTask);
//         if($deleteTask){

// //        if(!is_null($deleteTask)){
//             //$deleteTest->delete();                      // json([ 'message' => $errorMessage     ], 400)
//         }else{

//         }    
    }
}
