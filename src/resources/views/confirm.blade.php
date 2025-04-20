@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')

<div class="confirm__heading">
  <h2>お問い合わせ内容確認</h2>
</div>

<div class="confirm-table">
 <form class="form" action="{{ route('contact.store') }}" method="POST">
    @csrf
      <table>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お名前</th>
          <td class="confirm-table__text">{{ $first_name }}　{{ $given_name }}</td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">性別</th>
          <td class="confirm-table__text">
            @if($gender == '1')
                男性
            @elseif($gender == '2')
                女性
            @elseif($gender == '3')
                その他
            @else
            不明
            @endif
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">メールアドレス</th>
          <td class="confirm-table__text">{{ $email }}</td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">電話番号</th>
          <td class="confirm-table__text">{{ $tel1 }}-{{ $tel2 }}-{{ $tel3 }}</td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">住所</th>
          <td class="confirm-table__text">{{ $address }}</td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">建物</th>
          <td class="confirm-table__text">{{ $building }}</td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせの種類</th>
          <td class="confirm-table__text">{{ $detail }}</td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせの内容</th>
          <td class="confirm-table__text">{{ $content }}</td>
        </tr>
      </table>
</div>

    <!-- 隠しフィールドをまとめて送信 -->
    <input type="hidden" name="first_name" value="{{ $first_name }}">
    <input type="hidden" name="given_name" value="{{ $given_name }}">
    <input type="hidden" name="gender" value="{{ $gender }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="tel1" value="{{ $tel1 }}">
    <input type="hidden" name="tel2" value="{{ $tel2 }}">
    <input type="hidden" name="tel3" value="{{ $tel3 }}">
    <input type="hidden" name="address" value="{{ $address }}">
    <input type="hidden" name="building" value="{{ $building }}">
    <input type="hidden" name="detail" value="{{ $detail }}">
    <input type="hidden" name="content" value="{{ $content }}">

    <div class="form__button">
      <div class="form__button-1">
        <button class="form__button-submit" type="submit">送信</button>
      </div>

      <div class="form__button-2">
        <a href="{{ route('index') }}" class="form__button-revise">修正</a>
      </div>
    </div>

  </form>
@endsection