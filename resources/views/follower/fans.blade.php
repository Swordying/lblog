@extends('layouts.app')

@section('title', "{$user -> name} 的粉丝")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- 用户基本信息 -->
        <div class="col-md-8">
            @include('layouts.userinfo')
        </div>
        <div class="col-md-8">
            <!-- 用户粉丝列表 开始 -->
            @if($fans_data -> count() > 0)
            <ul class="list-group">
                @foreach($fans_data as $value)
                <li class="list-group-item">
                    {{ $value -> name}}
                    <a class="pull-right" href="{{ route('status_show', ['user_id' => $value -> id ]) }}">查看</a>
                </li>
                @endforeach
            </ul>
            <!-- 用户粉丝列表 结束 -->
            <!-- 分页器 -->
            <div>
                <br />
                {{ $fans_data -> links() }}
            </div>
            @else
            <p>暂无数据！</p>
            @endif
        </div>

    </div>

</div>
@endsection