{{--@extends('adminlte::page')--}}

@section('title', 'Список каталогов')

@extends('admin.layouts.index')

@section('top_right_content')
    @include('admin.includes.modal_create', [
    'route' => 'admin.super_admin.categories.create',
    'body' =>
//    formInput('category_id',value:$category->id,is_hidden: 1) .
     formInput('name', 'Введите название', label: 'Название',is_required: 1) .
     formFile('image', 'Загрузите изображение',is_required: 1) .

      formDropdown(name: 'gender_id', label: 'Пол', options: $genders) .

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
                            <th>Фото</th>
                            <th>Пол</th>
                            <th>Подкатегорий</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td><img src="{{asset($item->image)}}" style="height: 80px;width: 80px;"></td>
                                <td>{{\App\Models\Gender::query()->select('name')->where('id',$item->gender_id)->value('name')}}</td>
                                {{--                                <td>{{$item->is_hit}}</td>--}}
                                <td><a href="{{route('admin.super_admin.categories.show',$item->id)}}"
                                       class="nav-link" style="text-align: center; display: flex;justify-content: left">
                                        <i class="nav-icon fas fa-info-circle  fa-lg"></i>
                                    </a></td>
                                <td> @include('admin.includes.modal_update', [
                                        'route' => 'admin.super_admin.categories.edit',
                                        'item_id' => $item->id,
                                        'body' =>
//                                                 formInput('category_id', 'category_id',value: $id,type: 'hidden') .
                                           formInput('name', 'Введите название', label: 'Название',value: $item->name) .
                                             formFile('image', 'Загрузите изображение', $item->image) .
                                              formDropdown(name: 'gender_id', label: 'Пол', options: $genders, selected_id: $item->gender_id) .
                                            formSubmitButton('Редактировать'),
                                    ]
                                    )
                                    <form action="{{route('admin.super_admin.categories.destroy',$item->id)}}"
                                          method="POST" class="d-inline-block">
                                        @csrf
                                        {{--    {!! $body !!}--}}
                                        @method('DELETE')
                                        <button type="submit" class="'btn btn-danger btn-sm delete-btn'"
                                                onclick="return confirm('После удаления этого раздела все товары находящиеся в нем будут удалены. Вы уверены что хотите удалить?')"
                                                href="#">
                                            <i class="fas fa-trash">'Удалить</i>
                                        </button>
                                    </form>
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

