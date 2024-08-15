@php($hash = fake()->numerify)
<a href="#"  type="button" class="{{$button_class ?? 'btn btn-info btn-sm'}}" data-bs-toggle="modal" data-bs-target="#ItemEdit{{$item_id.$hash}}">
    <i style="margin: 3px" class="{{$button_icon_class ?? 'fas fa-pencil-alt'}}">{{$label ?? '  Редактировать'}}</i>
</a>
<div class="modal fade" id="ItemEdit{{$item_id.$hash}}" tabindex="-3" aria-labelledby="ItemEdit{{$item_id.$hash}}" aria-hidden="true">
    <div class="modal-dialog {{$modal_dialog_extra_class ?? ''}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $header_label ?? 'Редактировать'}}</h5>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i class="nav-icon fas fa-times"></i></button>
            </div>
            <div class="modal-body ">
                <form method="post"  enctype="multipart/form-data"  action="{{route($route,$item_id)}}">
                    @csrf
                    @method('PUT')
                    {!! $body !!}
                </form>
            </div>
        </div>
    </div>
</div>
