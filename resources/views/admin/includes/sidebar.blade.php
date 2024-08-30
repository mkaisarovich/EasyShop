
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
{{--        @if(auth()->user()->role == 'admin')--}}
            <span class="brand-text font-weight-light">Супер Админ</span>
{{--        @endif--}}

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image mt-2" style="display: flex;justify-content: space-around">
                <img src="{{ '/admin/dist/img/user2-160x160.jpg' }}" class="img-circle elevation-2" alt="User Image">
                <h5 style="color: white; padding-left: 25px;padding-top: 5px">{{auth()->user()->name}}</h5>
            </div>
{{--            <div class="info">--}}
{{--                <a href="{{route('admin.profile.index')}}" class="d-block text-white">{{auth()->user()->name}}</a>--}}
{{--                <p href="#" class="d-block text-white">{{__(auth()->user()->role)}}</p>--}}
{{--                <a href="{{route('admin.profile.index')}}" class="d-block text-white">Личный кабинет</a>--}}
{{--            </div>--}}
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
{{--                @if(auth()->user()->role == 'admin' )--}}
                    <li class="nav-item">
                        <a href="{{route('admin.super_admin.main.')}}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Главная
                            </p>
                        </a>
                    </li>

                        <li class="nav-item">
                            <a href="{{route('admin.super_admin.partners.')}}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Наши партнеры
                                </p>
                            </a>
                        </li>

                <li class="nav-item">
                    <a href="{{route('admin.super_admin.moderate.')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Модерация
                        </p>
                    </a>
                </li>


                        <li class="nav-item">
                            <a href="{{route('admin.super_admin.users.')}}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Пользователи
                                </p>
                            </a>
                        </li>

                <li class="nav-item">
                    <a href="{{route('admin.super_admin.orders.')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Заказы
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.super_admin.cities.')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Список городов
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-wrench"></i>
                        <p>
                            Настройки
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">



                        <li class="nav-item">
                            <a href="{{route('admin.super_admin.settings.about_us')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>О нас</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.super_admin.settings.privacy')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Политика конфедициальности</p>
                            </a>
                        </li>


                </li>







            </ul>
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-wrench"></i>
                    <p>
                        Фильтрация
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">



                    <li class="nav-item">
                        <a href="{{route('admin.super_admin.filter.colors')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Цветы</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.super_admin.filter.seasons')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Сезоны</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.super_admin.filter.styles')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Стили</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.super_admin.filter.structures')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Структуры</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.super_admin.filter.sizes')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Размеры</p>
                        </a>
                    </li>


            </li>


            </ul>

            <li class="nav-item" style="border-top: 1px solid #4b545c;">
                <a href="{{route('admin.logout')}}" class="nav-link mb-3">
                    <i class="nav-icon fas fa fa-sign-out-alt"></i>
                    <p>
                        Выйти
                    </p>
                </a>
            </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


