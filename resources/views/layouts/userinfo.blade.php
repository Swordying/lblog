<div class="panel pannel-default">
    <div class="panel-heading text-center">
        <p>{{ $user -> name }}</p>
        @if(Auth::check())
            @if(Auth::id() !== $user -> id)
                @if(Auth::user() -> isFocus($user -> id))
                    <a href='{{ url("offfocus/{$user -> id}") }}' class="btn btn-danger btn-sm" role="button">取消关注</a>
                @else
                    <a href='{{ url("onfocus/{$user -> id}") }}' class="btn btn-primary btn-sm" role="button">关注</a>
                @endif
            @endif

        @else
            <a href='{{ url("onfocus/{$user -> id}") }}' class="btn btn-primary" role="button">关注</a>
        @endif
        
    </div>
    <div class="panel-body text-center">
        <br />
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('status_show',['user_id' => $user -> id]) }}">
                    <div>动态</div>
                    <div>{{ $user -> statuses() -> count() }}</div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('focus_show', ['user_id' => $user -> id]) }}">
                    <div>关注</div>
                    <div>{{ $user -> focus() -> count() }}</div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('fans_show', ['user_id' => $user -> id]) }}">
                    <div>粉丝</div>
                    <div>{{ $user -> fans() -> count() }}</div>
                </a>
            </div>

        </div>
        <hr>
    </div>
</div>
