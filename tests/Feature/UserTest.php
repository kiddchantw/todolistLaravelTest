<?php

namespace Tests\Feature;

use App\Http\Controllers\TasksController;
use App\Tasks;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testTodolistPage200()
    {
        $response = $this->get('/todolist');
        //測試網頁可連線
        $response->assertStatus(200);
    }


    public function testTaskExist()
    {    
        // 取得所有資料
        $Tasks = Tasks::all();
        // 斷言結果
        $this->assertCount(9, $Tasks);
    }


    public function testUpdateTaskUrl()
    {    
        $response = $this->json('POST', 'updateTask', [
            'taskId' => 4
        ]);

        // 斷言結構是否相符合
        $response->assertExactJson([
            'success'=>'Ajax Request: updateTask'
        ]);
    }


    public function testControllerMethod()
    {
        $rmc = new TasksController();
        $result = $rmc->readTaskById(1);
        
        $testArray = array("id"=>1,"user_id"=>11,"content"=>"123123","done"=>0,"created_at"=>"2020-07-22T17:49:53.000000Z","updated_at"=>null);
 
        //判斷array有沒有key
        $this->assertArrayHasKey('content',$result);
    }
}
