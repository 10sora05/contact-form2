@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')


 <div class="thanks__heading">
    <h2>お問い合わせありがとうございました</h2>
</div>

<div class="thanks__home">
    <a href="/" class="thanks__home__button">HOME</a>
</div>
@endsection
