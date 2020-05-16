<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
     protected $fillable = ['content', 'user_id','status'];

    public function user()
    {
        //子のモデルでbelongsToメソッドによりリレーション関数を定義します。
        return $this->belongsTo(User::class);
    }
}
