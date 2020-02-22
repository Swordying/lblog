@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('status.store')
            <!-- 用户动态 开始 -->
            @foreach($statuses as $value)
            <div class="card">
                <div class="card-header">发布时间：{{ $value -> created_at }} {{ $value -> created_at -> diffForHumans() }} &nbsp;&nbsp;&nbsp;&nbsp; 作者：<a href='{{ url("status/show/{$value -> user_id}") }}' title="点击查看更过动态">{{ App\User::find($value -> user_id) -> name }}</a></div>

                <div class="card-body">
                    {{ $value -> contents }}
                </div>

            </div>
            @endforeach
            <!-- 分页器 -->
            <div>
                <br />
                {{ $statuses -> links() }}
            </div>
            <!-- 用户动态 结束 -->

        </div>
    </div>
</div>
@endsection
