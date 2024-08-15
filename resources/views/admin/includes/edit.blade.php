@extends('admin.layouts.index')

@section('title', 'Доступ пользователям')

@section('content')
{{--    {{$employee}}--}}
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Доступ пользователям</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="goBack()">Назад</button>
    </div>
    <div class="modal-body">
        <form method="put" enctype="multipart/form-data" action="{{ route('admin.employees.update',$employee->id) }}">
            @csrf
            <input type="hidden" name="name">                                  <div class="input-group mb-2" >
                <input type="text" class="form-control" name="name" placeholder="Введите ФИО" aria-describedby="basic-addon1"  value="{{$employee->name}}" required >
            </div>
            <input type="hidden" name="phone">                                    <div class="input-group mb-2">
                <input type="text" class="form-control" name="phone" placeholder="Введите номер телефона" aria-describedby="basic-addon1"  value="{{$employee->phone}}" required >
            </div>
            <div class="input-group mb-2">
                <input type="password" class="form-control" name="password" placeholder="Новый пароль"  value="{{$employee->password}}" required >
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text fw-normal" for="citySelect">Роль</label>
                <select name="type" id="citySelect" class="form-select">
                    <option value="">---</option>
                    <option value="admin">Админ</option>
                    <option value="super_admin">Супер Админ</option>
                </select>
            </div>

            <label style="font-size: large; font-style: normal">Доступ к страницам</label>

            <div class="d-grid" style="grid-template-columns: 1fr 1fr">
                @foreach($pages as $page)
                <div class="form-check">
                    <input type="checkbox" name="permission[]" value="{{$page->id}}" id="create-permission_0" class="form-check-input" autocomplete="off">
                    <label for="create-permission_{{$page->id}}" class="form-check-label">{{$page->name}}</label>
                </div>
                @endforeach
            </div>



            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Изменить</button>
            </div>
        </form>
    </div>
</div>

@endsection
