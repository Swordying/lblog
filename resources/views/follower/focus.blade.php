@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- 用户基本信息 -->
        <div class="col-md-8">
            @include('layouts.userinfo')
        </div>
        <div class="col-md-8">
            <!-- 用户关注列表 开始 -->
            <ul class="list-group">
                @foreach($focus_data as $value)
                <li class="list-group-item">
                    {{ $value -> name}}
                    <a href="{{ route('status_show', ['user_id' => $value -> id ]) }}">查看</a>
                </li>
                @endforeach
            </ul>
            <!-- 用户关注列表 结束 -->
            <!-- 分页器 -->
            <div>
                <br />
                {{ $focus_data -> links() }}
            </div>
        </div>

    </div>

</div>
@endsection