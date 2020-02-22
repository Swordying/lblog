<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['contents'];
    // 模型关联：一个动态只属于一个用户
    public function user()
    {
        return $this -> belongsTo('App\User');
    }
}
