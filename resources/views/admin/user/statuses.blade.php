@if($data -> count() > 0)
<div class="panel">
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>内容</th>
            <th>发布时间</th>
        </tr>
        @foreach($data as $value)
            <tr>
                <td>{{$value -> id}}</td>
                <td style="word-break:break-all;word-wrap:break-word;max-width:300px;">{{$value -> contents}}</td>
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