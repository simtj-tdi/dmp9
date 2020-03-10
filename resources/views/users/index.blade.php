@extends('layouts.backend')

@prepend('scripts')
    $(function() {
        $("#current_password").keydown(function(key) {
            if (key.keyCode == 13) {

            }
        });
    });
@endprepend

@section('content')
    <!-- content : start-->
    <div class="mypage container-fluid flex-grow-1 container-p-y">
        <div class="wrap">
            <div class="text_box">
                <h1>내정보 수정</h1>
                <p>입력창에 비밀번호를 입력해 주세요. 개인 정보를 수정하실 수 있습니다.</p>
            </div>
            <form method="post" action="{{ route('confirm_check') }}">
                @csrf

                <div class="input_box">
                    <input id="current_password" type="password" class="@error('current_password') is-invalid @enderror" placeholder="비밀번호" name="current_password" required>
                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>
                    @enderror
                </div>
            </form>
        </div>
    </div>
    <!-- content : end-->
@endsection
