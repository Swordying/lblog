<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Follower;
use Illuminate\Support\Facades\Db;

class FollowerController extends Controller
{
    // 粉丝列表
    public function fans($user_id)
    {
        $user = User::find($user_id);
        $fans_data = $user -> fans() -> orderBy('created_at','desc') -> paginate(10);
        return view('follower/fans', compact('user','fans_data'));
    }
    // 关注列表
    public function focus($user_id)
    {
        $user = User::find($user_id);
        $focus_data = $user -> focus() -> orderBy('created_at', 'desc') -> paginate(10);
        return view('follower/focus', compact('user','focus_data'));
    }
    // 关注
    public function onFocus($user_id)
    {
        // 只有没有关注的时候才能关注
        $user = Auth::user();
        if($user -> isFocus($user_id) === false){
            $user -> follower() -> create(['follower_id'=>$user_id]);
        }
        return redirect() -> back();
    }
    // 取消关注
    public function offFocus($user_id)
    {
        $fans_id = Auth::id();
        DB::table('followers') -> where([
            ['follower_id',$user_id],
            ['user_id',$fans_id],
        ]) -> delete();
        return redirect() -> back();
    }
}
