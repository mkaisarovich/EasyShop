{{--@extends('adminlte::page')--}}

@section('title', 'Модерация')

@extends('admin.layouts.index')


@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive p-30">
                    <table class="table table-hover text-wrap">
                        <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th>Имя</th>
                            <th>Почта</th>
                            <th>Город</th>
                            <th>Модерация</th>
                            <th>Зарегистирован</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->city_id}}</td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('admin.super_admin.moderate.status', $item->shop_id) }}" style="display: flex; align-items: center;">
                                        @csrf
                                        <select class="form-control" name="status" style="margin-right: 8px;">
                                            <option value="1" {{$item->moderate == 1 ? 'selected' : ''}}>Принять</option>
{{--                                            <option value="0" {{$item->moderate == 0 ? 'selected' : ''}}></option>--}}
                                        </select>
                                        <button type="submit" class="btn btn-success btn-sm" title="Сохранить статус">
                                            <ion-icon name="save"></ion-icon>Сохранить
                                        </button>
                                    </form>
                                </td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                        @include('admin.includes.modal_update', [
                                            'route' => 'admin.super_admin.partners.',
                                            'item_id' => $item->id,
                                            'body' =>
//                                                 formInput('category_id', 'category_id',value: $id,type: 'hidden') .
                                                formInput('name', 'Введите название', label: 'Название',value: $item->name) .
                                                formInput('bonus_amount', 'Введите бонус', label: 'Бонус',value: $item->bonus_amount) .
                                                formInput('phone', 'Введите номер телефона', label: 'Номер телефона',value: $item->phone) .
                                                formSubmitButton('Редактировать'),
                                        ]
                                        )
                                        @include('admin.includes.delete_button', ['route' => 'admin.super_admin.partners.', 'item_id' => $item->id])

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            {{--            @include('admin.includes.pagination', ['items' => $chats])--}}
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

