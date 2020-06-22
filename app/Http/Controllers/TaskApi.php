<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Tasks;
use Session;
use Log;
use Illuminate\Validation\ValidationException;

/**
 * @group TaskCRUD
 * 
 * task的所有操作
 */

class TaskApi extends Controller
{
    /**
     * showAllTasks API
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->customLog("showAllUserTask",__METHOD__," all task ");

        echo  Tasks::all();
    }

    /**
     * AddNewTask API
     * Store a newly created resource in storage. 
     * 
     * @bodyParam  user_id int required The id of the user . Example: 9
     * @bodyParam content string required task 內容 . Example: test123
     *
     * @response {
     *   "message": "AddNewTask success" 
     * }
     * @response  400 {
     *  "message": "AddNewTask error with reason "
     * }
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
                "user_id.required" => "請輸入id",
                "content.required" => "請輸入文章內容"
            ];
            $validResult = $request->validate($rules, $message);

        } catch (ValidationException $exception) {

            $errorMessage = $exception->validator->errors()->first();
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
            return response()->json(['message' => 'add success'], 201);

        } else {
            return response()->json(['message' => 'add 失敗'], 400);
        }
            //todo : 沒成功。故意用user id = 2(沒此人)
            //postmans是顯示各著Illuminate\Database\QueryException: SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`dbtest001`.`tasks`, CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)) (SQL: insert into `tasks` (`content`, `creat_at`, `user_id`) values (test5566, 2020-06-16 20:25:56, 2)) in file /usr/local/var/wwwa/testLa/todolistV3/vendor/laravel/framework/src/Illuminate/Database/Connection.php on line 671

            // 如果已經用validator 還會有狀況嗎？

            //


    }

    /**
     * showOneUsersTask
     * Display the specified resource.
     * 
     * @queryParam id required 已存在的user id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        $this->customLog("showOneUserTask",__METHOD__,"userID: $id");

        $taskShow = Tasks::where('user_id', '=', $id)->get();
        return $taskShow;
    }




    /**
     * updateTask API
     * Update the specified resource in storage
     *
     * @queryParam id required 已存在的task id.
     * @response {
     *   "message": "update task success" 
     * }
     * @response  404 {
     *  "message": "updateTask id error"
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    public function update(Request $request, Tasks $tasks)
    {

        $updateTaskId = $tasks->id;

        $updateTask = Tasks::where('id', '=', $updateTaskId);

        $finshStatus = $tasks->done; //Tasks::find($u
        $updateInt = 0;
        if ($finshStatus == 0) {
            $updateInt = 1;
        }
        $updateTask->update(['done' => $updateInt]);
        
        return response()->json(['message' => 'update task success'], 200);

        //目前只想到找不到model id的例外狀況
        //用app/Exceptions/Handler.php處理了
    }

    /**
     * deleteTask API
     * Remove the specified resource from storage.
     *
     * @urlParam  id required 已存在的task id.
     *
     * @response {
     *   "message": "delete task id success" 
     * }
     * @response  404 {
     *  "message": "delete task id error"
     * }
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info($id);

        $deleteTask =  Tasks::where('id', '=', $id);
        //return 
        if ($deleteTask->exists()){
            $deleteTask->delete();
            return response()->json(['message' => 'delete task success'], 200);
        }else{
            return response()->json(['message' => 'delete task id error'], 404);
        }

    }




    public function customLog(
        string $actions,
        string $methods,
        string $details
    ){
        $dateNowTaiwan = date('Y-m-d H:i:s', (time()+8*3600));
        $action = $actions;
        $log = ['method: '=>$methods, 'details:'=>$details,'time'=>$dateNowTaiwan]; 
        Log::notice($action, $log);
    }
}
