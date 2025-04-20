@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<header class="admin-header">
    <form action="{{ route('admin.search') }}" method="GET">
        <label for="site-search" class="admin-header__search">
            <div class="admin-header__search-label">
                <input type="text" name="keyword" id="site-search" placeholder="名前やメールアドレスを入力してください" class="admin-header__search-input">
            </div>
            <div class="admin-header__search-label">
                    <select name="gender"  placeholder="性別">
                        <option value="">性別</option>
                        <option value="1">男性</option>
                        <option value="2">女性</option>
                        <option value="3">その他</option>
                    </select>
            </div>
            <div class="admin-header__search-label">
                <select name="detail"  placeholder="選択してください">
                    <option value="">お問い合わせの種類</option>
                    <option value="商品のお届けについて">商品のお届けについて</option>
                    <option value="商品の交換について">商品の交換について</option>
                    <option value="商品トラブル">商品トラブル</option>
                    <option value="ショップへのお問い合わせ">ショップへのお問い合わせ</option>
                    <option value="その他">その他</option>
                </select>
            </div>
            <div class="admin-header__search-label">
                <input
                    type="date"
                    id="start"
                    name="date"
                    value="年/月/日"
                    min="2023-01-01"
                    max="2025-4-31" class="admin-header__search-date"/>
            </div>
            <div class="admin-header__search-label">
                <button class="admin-header__search-button">検索</button>
            </div>
            <div class="admin-header__search-label">
                <a href="{{ route('admin.search') }}" class="admin-header__reset-button">リセット</a>
            </div>
        </label>
    </form>
    <div class="flex">
        <div class="pagination">
            {{ $contacts->appends(request()->query())->links('vendor.pagination.simple') }}
        </div>
    </div>
</header>

<div class="contact-form__heading">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>

    <table class="admin-table">
        <tr class="admin-table__heading">
            <th class="admin-table__heading">お名前</th>
            <th class="admin-table__heading">性別</th>
            <th class="admin-table__heading">メールアドレス</th  >
            <th class="admin-table__heading">お問い合わせの種類</th>
            <th class="admin-table__heading">お問い合わせの内容</th>
            <th></th>
        </tr>
        @foreach ($contacts as $contact)
        <tr>
            <td>{{ $contact->name }}</td>
            <td>
                 @if($contact->gender === '1')
        男性
    @elseif($contact->gender === '2')
        女性
    @elseif($contact->gender === '3')
        その他
    @else
        不明
    @endif
            </td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->detail }}</td>
            <td>{{ $contact->content }}</td>
            <td><button class="btn btn-primary" onclick="openModal({{ $contact->id }})">詳細</button></td>
        </tr>
        @endforeach
    </table>
</div>

<!-- モーダルウィンドウのHTML -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span id="close-modal" class="close">&times;</span>
        <h2>詳細情報</h2>
        <div id="modal-body"></div>
    </div>
</div>

<script>
    // モーダルを開く
    function openModal(contactId) {
        // モーダルを表示
        document.getElementById("modal").style.display = "block";

        // 詳細情報をサーバーから非同期で取得
        fetch('/admin/contact/' + contactId)
            .then(response => response.json())
            .then(data => {
                console.log(data);  // データが正しく取得できているか確認
                // モーダルの中に詳細情報を挿入
                document.getElementById("modal-body").innerHTML = `
                    <p><strong>お名前:</strong> ${data.name}</p>
                    <p><strong>性別:</strong> ${data.gender_label}</p>
                    <p><strong>メールアドレス:</strong> ${data.email}</p>
                    <p><strong>電話番号:</strong> ${data.tel1}-${data.tel2}-${data.tel3}</p>
                    <p><strong>住所:</strong> ${data.address}</p>
                    <p><strong>建物:</strong> ${data.building}</p>
                    <p><strong>お問い合わせの種類:</strong> ${data.detail}</p>
                    <p><strong>お問い合わせの内容:</strong> ${data.content}</p>
                `;
            });
            .catch(error => console.error('Error fetching contact details:', error));
    }

    // モーダルを閉じる
    document.getElementById("close-modal").onclick = function() {
        document.getElementById("modal").style.display = "none";
    }

    // モーダル外をクリックしたら閉じる
    window.onclick = function(event) {
        if (event.target === document.getElementById("modal")) {
            document.getElementById("modal").style.display = "none";
        }
    }
</script>
@endsection