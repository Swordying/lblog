@foreach(['success', 'warning' , 'danger' ,'info'] as $message)
    @if(session() -> has($message))
        <p class="alert alert-{{ $message }}">
            {{ session()->get($message) }}
        </p>
    @endif
@endforeach