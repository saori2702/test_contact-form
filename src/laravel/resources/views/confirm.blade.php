<!-- 確認画面 -->

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')

    <div class="confirm-form">
        <div class="confirm__heading">
            <h2>Confirm</h2>
        </div>
        <form class="confirm_form" action="/thanks" method="post">
            @csrf
            <div class="confirm-table">
                <table class="confirm-table__inner">

                <!-- お名前 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お名前</th>
                        <td class="confirm-table__text">
                            <input type="text" name="last_name" value="{{$contact['last_name']}}" readonly />
                            <input type="text" name="first_name" value="{{$contact['first_name']}}" readonly />
                        </td>
                    </tr>

                    <!-- 性別 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">性別</th>
                        <td class="confirm-table__text">
                            <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                            <span>{{ $contact['gender_label'] }}</span>
                        </td>
                    </tr>

                    <!-- メールアドレス -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">メールアドレス</th>
                        <td class="confirm-table__text">
                            <input type="email" name="email" value="{{$contact['email']}}" readonly />
                        </td>
                    </tr>

                    <!-- 電話番号 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">電話番号</th>
                        <td class="confirm-table__text">
                            <input type="tel" name="tel_1" value="{{$contact['tel_1']}}" readonly />
                            <input type="tel" name="tel_2" value="{{$contact['tel_2']}}" readonly />
                            <input type="tel" name="tel_3" value="{{$contact['tel_3']}}" readonly />
                        </td>
                    </tr>

                    <!-- 住所 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">住所</th>
                        <td class="confirm-table__text">
                            <input type="text" name="address" value="{{$contact['address']}}" readonly />
                        </td>
                    </tr>

                    <!-- 建物名 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">建物名</th>
                        <td class="confirm-table__text">
                            <input type="text" name="building" value="{{$contact['building']}}" readonly />
                        </td>
                    </tr>

                    <!-- お問い合わせ種類 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせの種類</th>
                        <td class="confirm-table__text">
                            <input type="hidden" name="category_id" value="{{ $contact['categories_id'] }}" />
                            <span>{{ $contact['category_content'] }}</span>
                        </td>
                    </tr>

                    <!-- お問い合わせ内容 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせ内容</th>
                        <td class="confirm-table__text">
                            <input type="text" name="contact" value="{{$contact['contact']}}" readonly />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">送信</button>
                <button class="form__button-edit" type="submit" name="back" value="back">修正</button>
            </div>
        </form>
    </div>
@endsection