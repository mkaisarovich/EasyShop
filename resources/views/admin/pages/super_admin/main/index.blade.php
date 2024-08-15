{{--@extends('adminlte::page')--}}

@section('title', 'Главная')

@extends('admin.layouts.index')


@section('content')

    <div class="content-wrapper" style="min-height: 673.2px;">


        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Заказы</span>
                                <span class="info-box-number">{{6}}
                            </span>
                            </div>

                        </div>

                    </div>




                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3">

                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Партнеры</span>
                                <span class="info-box-number">{{\App\Models\User::query()->where('role','partner')->count()}}</span>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Пользователи</span>
                                <span class="info-box-number">{{\App\Models\User::where('role','user')->count()}}</span>
                            </div>

                        </div>

                    </div>

                </div>




            </div>
        </section>

    </div>

@endsection



