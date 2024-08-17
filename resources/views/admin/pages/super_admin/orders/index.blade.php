{{--@extends('adminlte::page')--}}

@section('title', 'Список заказов')

@extends('admin.layouts.index')




@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="GET" action="{{ route('admin.super_admin.orders.') }}">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Поиск..." value="{{ request()->query('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Поиск</button>
                    </div>
                </div>
            </form>
            <div class="card">

                <div class="card-body table-responsive p-30">

                    <table class="table table-hover text-wrap">
                        <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th>Продукт</th>
                            <th>Клиент</th>
                            <th>Продавец</th>
                            <th>Цена</th>
                            <th>Статус</th>
                            <th>Адресс</th>
                            <th>Доставка заказа</th>
                            <th>Адресс заказа по доставке</th>
                            <th>Метод оплаты</th>
                            <th>Зарегистирован</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @foreach($data as $item)--}}
{{--                            <tr>--}}
{{--                                <td>{{$item->id}}</td>--}}
{{--                                <td>{{$item->product}}</td>--}}
{{--                                <td>{{\App\Models\User::query()->select('name')->where('id',$item->customer_id)->value('name')}}</td>--}}
{{--                                <td>{{\App\Models\Partner::query()->select('name')->where('id',$item->partner_id)->value('name')}}</td>--}}
{{--                                <td>{{$item->price}}</td>--}}
{{--                                <td>{{\App\Models\OrderStatus::query()->select('name')->where('id',$item->status_id)->value('name')}}</td>--}}
{{--                                <td>{{$item->start_rent_date}}</td>--}}
{{--                                <td>{{$item->end_rent_date}}</td>--}}
{{--                                <td>--}}
{{--                                    <table>--}}
{{--                                        <tr>--}}
{{--                                            <th>Улица:</th>--}}
{{--                                            <td>{{\App\Models\Address::query()->select('street')->where('id',$item->address_id)->value('street')}}</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th>Дом:</th>--}}
{{--                                            <td>{{\App\Models\Address::query()->select('entry_house')->where('id',$item->address_id)->value('entry_house')}}</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th>Этаж:</th>--}}
{{--                                            <td>{{\App\Models\Address::query()->select('floor')->where('id',$item->address_id)->value('floor')}}</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th>Квартира:</th>--}}
{{--                                            <td>{{\App\Models\Address::query()->select('apart')->where('id',$item->address_id)->value('apart')}}</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th>Домофон:</th>--}}
{{--                                            <td>{{\App\Models\Address::query()->select('domofon')->where('id',$item->address_id)->value('domofon')}}</td>--}}
{{--                                        </tr>--}}
{{--                                    </table>--}}
{{--                                </td>--}}
{{--                                <td>{{$item->order_delivery}}</td>--}}
{{--                                <td>{{$item->order_delivery_address}}</td>--}}
{{--                                <td>{{'Оплата картой'}}</td>--}}
{{--                                <td>{{$item->created_at}}</td>--}}

{{--                                <td>--}}

{{--                                    --}}{{--                                        @include('admin.includes.modal_update', [--}}
{{--                                    --}}{{--                                            'route' => 'admin.super_admin.partners.',--}}
{{--                                    --}}{{--                                            'item_id' => $item->id,--}}
{{--                                    --}}{{--                                            'body' =>--}}
{{--                                    --}}{{--//                                                 formInput('category_id', 'category_id',value: $id,type: 'hidden') .--}}
{{--                                    --}}{{--                                                formInput('name', 'Введите название', label: 'Название',value: $item->name) .--}}
{{--                                    --}}{{--                                                formInput('bonus_amount', 'Введите бонус', label: 'Бонус',value: $item->bonus_amount) .--}}
{{--                                    --}}{{--                                                formInput('phone', 'Введите номер телефона', label: 'Номер телефона',value: $item->phone) .--}}
{{--                                    --}}{{--                                                formSubmitButton('Редактировать'),--}}
{{--                                    --}}{{--                                        ]--}}
{{--                                    --}}{{--                                        )--}}
{{--                                    @include('admin.includes.delete_button', ['route' => 'admin.super_admin.orders.destroy', 'item_id' => $item->id])--}}

{{--                                </td>--}}

{{--                            </tr>--}}
{{--                        @endforeach--}}
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

