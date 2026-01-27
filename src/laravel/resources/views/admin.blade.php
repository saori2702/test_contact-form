<!-- 管理者画面 -->

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')

    <div class="admin-page">
        <div class="admin__heading">
            <h2>Admin</h2>
        </div>

        <!-- 検索 -->
        <div class="admin__search">
            <form class="admin__search-items" action="/search" method="GET">
                <div class="admin__search-item">
                    <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}" />
                </div>
                <div class="admin__search-item">
                    <select class="search-select" name="gender">
                        <option value="">性別</option>
                        <option value="1">男性</option>
                        <option value="2">女性</option>
                        <option value="3">その他</option>
                    </select>
                </div>
                <div class="admin__search-item">
                    <select class="search-select" name="category_id">
                        <option value="">お問い合わせの種類</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->content }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin__search-item">
                    <div class="search-item__date">
                        <input class="search-date" type="date" name="date" >
                    </div>
                </div>

                <div class="admin__search-button">
                    <button class="search__button-submit" type="submit">検索</button>
                    <button class="search__button-reset" type="reset">リセット</button>
                </div>
            </form>
        </div>

        <!-- エクスポート・ページネーション -->
        <div class="tools">
            <div class="tools__left">
                <form class="tools__export" action="{{ route('admin.export') }}" method="GET">
                    @foreach(request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <button class="export__button-submit" type="submit">エクスポート</button>
                </form>
            </div>
            <div class="tools__right">
                <div class="tools__pagination">
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>

        <!-- テーブル -->
        <table class="admin__table">
            <tr class="admin__table-header">
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="admin__table-row">
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if($contact->gender == 1) 男性
                    @elseif($contact->gender == 2) 女性
                    @else その他
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content}}</td>
                <td>
                    <a class="admin__table-detail" href="/admin/?id={{ $contact->id }}">詳細</a>
                </td>
            </tr>
            @endforeach
        </table>

        <!-- 詳細モーダル -->
        @if(request()->query('id'))
        @if($detail)
        <div class="modal-overlay">
            <div class="modal-content">
                <a  class="detail__close" href="/admin">×</a>

                <table class="modal-table">
                    <tr>
                        <th>お名前</th>
                        <td>{{ $detail->last_name }} {{ $detail->first_name }}</td>
                    </tr>
                    <tr>
                        <th>性別</th>
                        <td>
                            @if($contact->gender == 1)
                                男性
                            @elseif($contact->gender == 2)
                                女性
                            @else
                                その他
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>{{ $detail->email }}</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>{{ $detail->tel }}</td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>{{ $detail->address }}</td>
                    </tr>
                    <tr>
                        <th>建物名</th>
                        <td>{{ $detail->building }}</td>
                    </tr>
                    <tr>
                        <th>お問い合わせの種類</th>
                        <td>{{ $detail->category->content }}</td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td>{{ $detail->detail}}
                        </td>
                    </tr>
                </table>

                <form class="contact__delete" action="/delete/{{ $detail->id }}" method="POST">
                    @csrf
                    <button class="delete-button" type="submit">削除</button>
                </form>
            </div>
        </div>
        @endif
        @endif
    </div>
@endsection

