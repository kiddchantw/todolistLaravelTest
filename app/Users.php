<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


use Illuminate\Foundation\Auth\User as Authenticatable;

// class Users extends Model
class Users extends Authenticatable
{
    //
    protected $table = 'users';

    protected $hidden = ['password'];


    //Eloquent: Mutators
    public function setPasswordAttribute($password)
    {
        if ($password !== null & $password !== "") {
            $this->attributes['password'] = Hash::make($password);
        }
    }
}
