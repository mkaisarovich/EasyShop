<!doctype html>
<html lang="en">
<head>
    <title>Авторизация</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('admin1/css/style.css') }}">

</head>
<body>



<section class="ftco-section" style="position: relative;">



    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Skystoreez</h2>
            </div>



        </div>
        <div class="row justify-content-center">
            @include('admin.layouts.with_redirect')
            <div class="col-md-6 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    {{--                    <div class="icon d-flex align-items-center justify-content-center">--}}
                    {{--                        <img src="{{ asset('logo.jpeg') }}" width="120">--}}
                    {{--                    </div>--}}


                    <form action="{{ route('admin.login') }}" class="login-form" method="POST">
                        @csrf

                        <div class="form-group">

                            <input type="email" id="phone-input" class="form-control rounded-left" name="email" placeholder="Почта" required>
                        </div>
                        <div class="form-group d-flex">
                            <input type="password" class="form-control rounded-left" name="password" placeholder="Пароль" required>
                        </div>
                        {{--                        <div class="form-group d-flex">--}}
                        {{--                            <a href="{{route('admin.forgetPassword')}}">Забыли пароль</a>--}}
                        {{--                        </div>--}}
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary rounded submit p-3 px-5" style="border-radius: 25px !important;">Логин</button>


                        </div>

{{--                        <div class="form-group d-flex" style="margin-top: 30%; color:  white !important; background-color: #138496">--}}
{{--                            --}}{{--                            <a href="{{route('admin.register')}}"  type="submit" class="btn btn-info rounded submit p-3 px-5" style="border-radius: 25px !important;  ">Регистрация</a>--}}

{{--                            <a href="#"  type="submit" class="btn btn-info rounded submit p-3 px-5" style="border-radius: 25px !important;  ">Регистрация</a>--}}
{{--                        </div>--}}
                    </form>




                    <div class="form-group d-flex" style="margin-top: 80px; margin-left: 100px">

                    </div>

                </div>

            </div>

        </div>


        <br><br>

        {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-6 text-center mb-5">--}}
        {{--<a style="border-radius: 25px !important;" href={{route('tracking.index')}}  class="btn btn-primary rounded submit p-3 px-5" >Трекинг</a>--}}
        {{--</div>--}}
        {{--</div>--}}





    </div>
</section>

<script src="{{ asset('admin1/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin1/js/popper.js') }}"></script>
<script src="{{ asset('admin1/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin1/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/inputmask/dist/jquery.inputmask.min.js"></script>

<script>
    $(document).ready(function() {
        $('#phone-input').inputmask('+7 (999) 999-9999');
    });
</script>


{{--<script>--}}
{{--const selectElement = document.getElementById("lang");--}}

{{--selectElement.addEventListener("change", function () {--}}
{{--const selectedOption = selectElement.value;--}}

{{--let currentUrl = window.location.href;--}}

{{--const hasQueryString = currentUrl.includes("?");--}}

{{--if (hasQueryString) {--}}
{{--const urlParts = currentUrl.split("?");--}}
{{--const baseUrl = urlParts[0];--}}
{{--const params = new URLSearchParams(urlParts[1]);--}}
{{--params.delete("lang");--}}
{{--currentUrl = baseUrl + "?" + params.toString();--}}
{{--}--}}

{{--currentUrl += "lang=" . selectedOption;--}}

{{--window.history.pushState({}, "", currentUrl);--}}
{{--});--}}
{{--</script>--}}



</body>
</html>

