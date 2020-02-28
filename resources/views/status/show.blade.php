@extends('layouts.app')
@section('title',"{$user -> name} 的动态")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('status.store')
            <!-- 用户动态 开始 -->
            @if($statuses -> count() > 0)
                @foreach($statuses as $value)
                <div class="card">
                    <div class="card-header">
                        <div>发布时间：{{ $value -> created_at }} {{ $value -> created_at -> diffForHumans() }}</div>
                    </div>

                    <div class="card-body">
                        {{ $value -> contents }}
                        <div class="text-right">
                            @if($value -> user_id === Auth::id())
                            <a href="{{ route('status_delete',['statuses_id' => $value -> id]) }}">删除</a>
                            @endif
                        </div>
                    </div>

                </div>
                <br>
                @endforeach
                <!-- 分页器 -->
                <div>
                    <br />
                    {{ $statuses -> links() }}
                </div>
            @else
                <p>暂无动态！</p>
            @endif
            <!-- 用户动态 结束 -->

        </div>
        <div class="col-md-4">
            @include('layouts.userinfo')
        </div>
    </div>
</div>
@endsection
