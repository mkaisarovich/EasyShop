@php
    if(!isset($hash)) {
        $hash = fake()->numerify;
    }
     $hash = fake()->numerify
@endphp
<div class="btn btn-primary">
    <a type="button"  data-bs-toggle="modal" data-bs-target="#AddNew{{$hash}}">
        {{$label ?? 'Создать'}}
    </a>
</div>

<div class="modal fade w-100" id="AddNew{{$hash}}" tabindex="-3" aria-labelledby="AddNew{{$hash}}" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создать</h5>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i class="nav-icon fas fa-times"></i></button>
            </div>
            <div class="modal-body " >
                <form method="post"  enctype="multipart/form-data"  action="{{$raw_route ?? route($route)}}" >
                    @csrf
{{--                    @method('POST')--}}
{{--                    {!! $service_id ?? '' !!}--}}
                        {!! $body !!}
                        {!! $footer ?? '' !!}
                </form>
            </div>
        </div>
    </div>
</div>
