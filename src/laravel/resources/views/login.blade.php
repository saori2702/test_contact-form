<!-- ログイン画面 -->

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('content')
<div class="login-form">
    <div class="login__heading">
        <h2>Login</h2>
    </div>
    <form class="login_form" action="/login" method="post">
        @csrf

        <!-- メールアドレス -->
        <div class="form__group">
            <div class="form__group-title">
                <label for="email">メールアドレス</label>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                @error('email')
                    {{$message}}
                @enderror
            </div>
            </div>

            <!-- パスワード -->
            <div class="form__group">
                <div class="form__group-title">
                    <label for="password">パスワード</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="例: coachtech123" />
                    </div>
                </div>
                <div class="form__error">
                @error('password')
                    {{$message}}
                @enderror
            </div>
            </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection
