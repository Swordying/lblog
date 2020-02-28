@if($data -> count() > 0)
<div class="panel">
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>用户名称</th>
            <th>关注时间</th>
        </tr>
        @foreach($data as $value)
            <tr>
                <td>{{$value -> id}}</td>
                <td style="word-break:break-all;word-wrap:break-word;max-width:300px;">{{$value -> name}}</td>
                <td>{{$value -> created_at}}</td>
            </tr>
        @endforeach
    </table>
    <div class="text-right">
        {{ $data -> links() }}
    </div>
</div>
@else
<p>暂无数据</p>
@endif