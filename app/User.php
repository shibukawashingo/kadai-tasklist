<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //User が持つ Micropost は複数存在するので、 function microposts() のように複数形 microposts でメソッドを定義します。
    public function tasks()
    {   
        //親のモデルでTaskメソッドによりリレーション関数を定義します。
        return $this->hasMany(Task::class);
    }   
    
}
