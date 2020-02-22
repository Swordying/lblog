<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // ZJY 模型关联：一个用户可以有多个动态 2020年2月21日17:28:57
    public function statuses()
    {
        return $this -> hasMany('App\Models\Status');
    }
    // ZJY 模型关联：一个用可以有多个偶像 2020年2月22日19:18:36 # 把此关联模型当做一对多的时候
    public function follower()
    {
        return $this -> hasMany('App\Models\Follower');
    }
    // ZJY 模型关联：一个用户可以许多偶像，自身关联，followers 表为中间表
    public function focus()
    {
        return $this -> belongsToMany('App\User','followers', 'user_id', 'follower_id');
    }
    // ZJY 模型关联：一个偶像可以被多个用户关注，自身关联，followers 表为中间表
    public function fans()
    {
        return $this -> belongsToMany('App\User','followers','follower_id','user_id');
    }
    // 判断是否关注 给定 user_id
    public function isFocus($user_id)
    {
        if(empty($user_id)){
            return false;
        }
        return $this -> focus() -> where('follower_id',$user_id) -> count()?true:false;
    }
}
