@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__heading">
    <h2>Contact</h2>
</div>
<form class="form" action="{{ route('contact.confirm') }}" method="POST">
    @csrf
    <div class="form__category">
        <table>
            <tr>
                <th class="form__label--item">
                    <div class="form__group-category">
                        <h3 class="form__label--item">お名前
                            <span class="form__label--required">※</span>
                        </h3>
                    </div>
                </th>
                <th class="form__input--text">
                    <div class="form__input--text-name">
                        <input type="text" name="first_name" placeholder="山田" value="{{ old('first_name') }}" class="contact-form__name" required />
                        <input type="text" name="given_name" placeholder="太郎" value="{{ old('given_name') }}" class="contact-form__name" required />
                    </div>
                    <div class="form__error">
                        @error('first_name')
                            {{ $message }}
                        @enderror
                        @error('given_name')
                            {{ $message }}
                        @enderror
                    </div>
                </th>
            </tr>
  
            <tr>
                <th class="form__label--item">
                    <div class="form__group-category">
                        <h3 class="form__label--item">性別
                            <span class="form__label--required">※</span>
                        </h3>
                    </div>
                </th>
                <th class="form__input--text">
                    <div class="form__input--textarea">
                        <input type="radio" name="gender" value="1" class="form__input--radio" checked {{ old('gender') == '1' ? 'checked' : '' }} required><span class="form__input--radio-text">男性</span>
                        <input type="radio" name="gender" value="2" class="form__input--radio" {{ old('gender') == '2' ? 'checked' : '' }} required><span class="form__input--radio-text">女性</span>
                        <input type="radio" name="gender" value="3" class="form__input--radio" {{ old('gender') == '3' ? 'checked' : '' }} required><span class="form__input--radio-text">その他</span>
                    </div>
                    <div class="form__error">
                        @error('gender')
                            {{ $message }}
                        @enderror
                    </div>
                </th>
            </tr>

            <tr>
                <th class="form__input--text">
                    <div class="form__group-category">
                        <h3 class="form__label--item">メールアドレス
                            <span class="form__label--required">※</span>
                        </h3>
                    </div>
                </th>
                <th class="form__input--text">                        
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" required />
                    </div>
                    <div class="form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </th>
            </tr>

            <tr>
                <th class="form__label--item">
                    <div class="form__group-category">
                        <h3 class="form__label--item">電話番号
                            <span class="form__label--required">※</span>
                        </h3>
                    </div>
                </th>
                <th class="form__input--text">
                    <div class="form__input--text">
                        <input type="text" name="tel1" size="2-4" maxlength="4" required placeholder="080" class="form__input--tel" value="{{ old('tel1') }}" required> - 
                        <input type="text" name="tel2" size="4" maxlength="4" required placeholder="1234" class="form__input--tel" value="{{ old('tel2') }}" required> - 
                        <input type="text" name="tel3" size="4" maxlength="4" required placeholder="5678" class="form__input--tel" value="{{ old('tel3') }}" required>
                    </div>
                    <div class="form__error">
                        @error('tel1')
                            {{ $message }}
                        @enderror
                        @error('tel2')
                            {{ $message }}
                        @enderror
                        @error('tel3')
                            {{ $message }}
                        @enderror
                    </div>
                </th>
            </tr>

            <tr>            
                <th class="form__label--item">
                    <div class="form__group-category">
                        <h3 class="form__label--item">住所
                            <span class="form__label--required">※</span>
                        </h3>
                    </div>
                </th>
                <th class="form__input--text">
                    <div class="form__input--text">
                        <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" required />
                    </div>
                    <div class="form__error">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </div>
                </th>
            </tr>

            <tr>            
                <th class="form__label--item">
                    <div class="form__group-category">
                        <h3 class="form__label--item">建物名
                        </h3>
                    </div>
                </th>
                <th class="form__input--text">
                        <div class="form__input--text">
                           <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}" />
                        </div>
                </th>
            </tr>

            <tr>            
                <th class="form__label--item">
                    <div class="form__group-category">
                        <h3 class="form__label--item">お問い合わせの種類
                            <span class="form__label--required">※</span>
                        </h3>
                    </div>
                </th>
                <th class="form__input--text">
                    <div class="form__input--textarea">
                        <select name="detail" required>
                            <option value="">選択してください</option>
                            <option value="商品のお届けについて">商品のお届けについて</option>
                            <option value="商品の交換について">商品の交換について</option>
                            <option value="商品トラブル">商品トラブル</option>
                            <option value="ショップへのお問い合わせ">ショップへのお問い合わせ</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>
                    <div class="form__error">
                        @error('detail')
                            {{ $message }}
                        @enderror
                    </div>
                </th>
            </tr>

            <tr>            
                <th class="form__label--item">
                    <div class="form__group-category">
                        <h3 class="form__label--item">お問い合わせの内容
                            <span class="form__label--required">※</span>
                        </h3>
                    </div>
                </th>
                <th class="form__input--text">
                    <div class="form__input--textarea">
                        <textarea name="content" placeholder="お問い合わせの内容をご記入ください" class="contact-form__textarea" maxlength="120" required>{{ old('content') }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('content')
                            {{ $message }}
                        @enderror
                    </div>
                </th>
            </tr>
        </table>

        <div class="form__button">
        <button class="form__button-submit" type="submit" >確認画面</button>
    </div>
  </form>
</div>

@endsection
