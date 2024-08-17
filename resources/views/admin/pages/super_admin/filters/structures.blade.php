{{--@extends('adminlte::page')--}}

@section('title', 'Структуры')

@extends('admin.layouts.index')


@section('top_right_content')
    @include('admin.includes.modal_create', [
    'route' => 'admin.super_admin.filter.structures.create',
    'body' =>
     formInput('name', 'Введите название', label: 'Название',is_required: 1) .
     formSubmitButton('Добавить'),
])
@endsection

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
                            <th>Название</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @include('admin.includes.modal_update', [
                                        'route' => 'admin.super_admin.filter.structures.edit',
                                        'item_id' => $item->id,
                                        'body' =>
//                                                 formInput('category_id', 'category_id',value: $id,type: 'hidden') .
                                            formInput('name', 'Введите название', label: 'Название',value: $item->name) .
                                            formSubmitButton('Редактировать'),
                                    ]
                                    )
                                    @include('admin.includes.delete_button', ['route' => 'admin.super_admin.filter.structures.delete', 'item_id' => $item->id])

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

