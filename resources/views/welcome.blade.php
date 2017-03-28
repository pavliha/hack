@extends("layouts.app")

@section("content")
    <div class="text-center">
        <img src="/images/splash.png" alt="" class="img-fluid splash">
        <h2>Добро пожаловать!</h2>
        <div>Для начала работы необходимо
            <a class="auth-link" href="/login">Войти</a> или
            <a class="auth-link" href="/register">Зарегистрироваться</a>
        </div>
    </div>
@endsection
