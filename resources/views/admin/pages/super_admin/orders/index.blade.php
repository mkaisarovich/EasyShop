{{--@extends('adminlte::page')--}}

@section('title', 'Список заказов')

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
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Номер телефона</th>
                            <th>Аватар</th>
                            <th>Почта</th>
                            <th>Адресс</th>
                            <th>Город</th>
                            <th>Рейтинг</th>
                            <th>Описание</th>
                            <th>Изображение</th>
                            <th>Модерация</th>
                            <th>Работает</th>
                            <th>Зарегистирован</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->surname}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->second_name}}</td>
                                <td>{{$item->phone}}</td>
                                <td><img src="{{asset($item->avatar)}}" style="height: 80px;width: 80px;"></td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <table>
                                        <tr>
                                            <th>Подьезд:</th>
                                            <td>{{ $item['entrance'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Этаж:</th>
                                            <td>{{ $item['floor'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Квартира/Офис</th>
                                            <td>{{ $item['apartment'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Домофон</th>
                                            <td>{{ $item['domofon'] }}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td>{{$item->city_id}}</td>
                                <td>{{$item->rating}}</td>
                                <td><textarea>{{$item->description}}</textarea></td>
                                <td><img src="{{asset($item->image_shop)}}" style="height: 80px;width: 80px;"></td>
                                <td>{{$item->is_moderate ? 'Да' : 'Нет'}}</td>
                                <td>{{$item->is_working ? 'Да' : 'Нет'}}</td>

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

