<div class="panel panel-primary">
    <div class="panel-body">
        <form action="{{ route('status_store') }}" method="POST">
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                {{ $errors -> first('contents') }}
            </div>
            @endif
            {{ csrf_field() }}
            <textarea class="form-control" rows="3" placeholder="聊聊新鲜事儿..." name="contents" required>{{ old('contents') }}</textarea>
            <div class="text-right">
                <button type="submit" class="btn btn-primary mt-3">发布</button>
            </div>
            <br>
        </form>
    </div>
</div>
