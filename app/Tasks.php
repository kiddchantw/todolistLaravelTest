<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    //
	protected $table = 'tasks';

	protected $fillable = ['user_id','content','creat_at'];
	// fillable裡放的是能insert進table的欄位，欄位名稱要和table的一致
}
