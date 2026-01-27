<!-- フォーム入力画面 -->

@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
@endsection

@section('content')

        <div class="contact-form">
            <div class="contact__heading">
                <h2>Contact</h2>
            </div>

            <form class="contact__form" action="/confirm" method="post">
                @csrf
                <!-- お名前 -->
                <div class="form__group">
                    <div class="form__group-title">
                        <label class="form__label">お名前<span>※</span></label>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}" />
                            <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}" >
                        </div>
                        <div class="form__error">
                            @error('last_name')
                            {{$message}}
                            @enderror
                            @error('first_name')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 性別 -->
                <div class="form__group">
                    <div class="form__group-title">
                        <label class="form__label">性別<span>※</span></label>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="radio" name="gender" value="1" checked><span>男性</span>
                            <input type="radio" name="gender" value="2" ><span>女性</span>
                            <input type="radio" name="gender" value="3" ><span>その他</span>
                        </div>
                        <div class="form__error">
                            @error('gender')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- メールアドレス -->
                <div class="form__group">
                    <div class="form__group-title">
                        <label class="form__label">メールアドレス<span>※</span></label>
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
                </div>

                <!-- 電話番号 -->
                <div class="form__group">
                    <div class="form__group-title">
                        <label class="form__label">電話番号<span>※</span></label>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="tel" name="tel_1" placeholder="080" value="{{ old('tel_1') }}" />
                            -
                            <input type="tel" name="tel_2" placeholder="1234" value="{{ old('tel_2') }}" />
                            -
                            <input type="tel" name="tel_3" placeholder="5678" value="{{ old('tel_3') }}" />
                        </div>
                        <div class="form__error">
                            @error('tel_1')
                            {{$message}}
                            @enderror
                            @error('tel_2')
                            {{$message}}
                            @enderror
                            @error('tel_3')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 住所 -->
                <div class="form__group">
                    <div class="form__group-title">
                        <label class="form__label">住所<span>※</span></label>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="address" placeholder="例: 東京都渋谷区1-1-1" value="{{ old('address') }}" />
                        </div>
                        <div class="form__error">
                            @error('address')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 建物名 -->
                <div class="form__group">
                    <div class="form__group-title">
                        <label class="form__label">建物名</label>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="building" placeholder="例: マンション123" value="{{ old('building') }}" />
                        </div>
                        <div class="form__error"></div>
                    </div>
                </div>

                <!-- お問い合わせ種類 -->
                <div class="form__group">
                    <div class="form__group-title">
                        <label class="form__label">お問い合わせの種類<span>※</span></label>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--select">
                            <select name="categories_id" id="categories_id">
                                <option value="" >選択してください</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                {{ $category->content }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form__error">
                            @error('categories_id')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- お問い合わせ内容 -->
                <div class="form__group">
                    <div class="form__group-title">
                        <label class="form__label">お問い合わせ内容<span>※</span></label>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--textarea">
                            <textarea name="contact" placeholder="例: お問い合わせ内容をご記載ください">{{ old('contact') }}</textarea>
                        </div>
                        <div class="form__error">
                            @error('contact')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
@endsection

