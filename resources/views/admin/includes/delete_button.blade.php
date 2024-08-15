<form action="{{$route_url ?? route($route, $item_id)}}" method="POST"  class="d-inline-block">
    @csrf
{{--    {!! $body !!}--}}
    @method('DELETE')
    <button type="submit" class="{{$button_class ?? 'btn btn-danger btn-sm delete-btn'}}" onclick="return confirm('Вы уверены ?')" href="#">
        <i class="fas fa-trash">{{ $label ?? '  Удалить' }}</i>
    </button>
</form>
