<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    //
	protected $table = 'tasks';

	protected $fillable = ['id','user_id','content','creat_at','done'];
	// fillable裡放的是能insert進table的欄位，欄位名稱要和table的一致

	public function getRouteKeyName()
	{
		return 'id';
		// return 'slug';
	}
}
