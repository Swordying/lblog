<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Status;

class StatusController extends Controller
{
    // 显示所有动态
    public function index()
    {
        $statuses = Status::orderBy('created_at','desc') -> paginate(15);
        return view('status.index', compact('statuses'));
    }
    // 通过用户 id 显示用户的动态
    public function show($user_id)
    {
        $user = User::find($user_id);
        $statuses = Status::where('user_id',$user_id) -> orderBy('created_at', 'desc') -> paginate(15);
        return view('status.show',compact('statuses','user'));
    }
    // 当前登录用户的动态
    public function my()
    {
        $user = Auth::user();
        $statuses = $user -> statuses() -> orderBy('created_at', 'desc') -> paginate(15);
        return view('status.show',compact('statuses','user'));
    }
    // 发布动态
    public function store(Request $request)
    {
        $this -> validate($request, [
            'contents' => 'required|max:140',
        ]);
        Auth::user() -> statuses() -> create(['contents' => $request['contents']]);
        session() -> flash('success', '发布成功');
        return redirect() -> back();
    }
    // 删除动态
    public function destroy($statuses_id)
    {
        $user_id = Auth::id();
        $result = Status::where([
            ['id',$statuses_id],
            ['user_id',$user_id],
        ]) -> delete();
        if($result){
            session() -> flash('success', '删除成功');
        }else{
            session() -> flash('info','动态已不存在');
        }
        return redirect() -> back();
    }
}
