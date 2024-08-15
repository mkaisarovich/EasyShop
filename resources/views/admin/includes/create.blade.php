@extends('admin.layouts.index')

@section('title', 'Доступ пользователям')

@section('content')
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Доступ пользователям</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="goBack()">Назад</button>
    </div>

    <div class="modal-body">
        <form method="post" enctype="multipart/form-data" action="{{ route('admin.employees.store') }}">
            @csrf
            <input type="hidden" name="name">                                    <div class="input-group mb-2">
                <input type="text" class="form-control" name="name" placeholder="Введите ФИО" aria-describedby="basic-addon1">
            </div>
            <input type="hidden" name="phone" >                                    <div class="input-group mb-2">
                <input type="text" class="form-control" name="phone" placeholder="Введите номер телефона" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-2">
                <input type="password" class="form-control" name="password" placeholder="Новый пароль">
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text fw-normal" for="citySelect">Устройства</label>
                <select name="type" id="citySelect" class="form-select">
                    <option value="">---</option>
                    <option value="admin">Админ</option>
                    <option value="super_admin">Супер Админ</option>

                </select>
            </div>

            <label style="font-size: large; font-style: normal">Доступ к страницам</label>

            <div class="d-grid" style="grid-template-columns: 1fr 1fr">
                @foreach(\App\Models\PagesList::all() as $page)
                <div class="form-check">
                    <input type="checkbox" name="permission[]" value="{{$page->id}}" id="create-permission_{{$page->id}}" class="form-check-input" autocomplete="off">
                    <label for="create-permission_{{$page->id}}" class="form-check-label">{{$page->name}}</label>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Добавить</button>
            </div>
        </form>
    </div>
</div>

@endsection
