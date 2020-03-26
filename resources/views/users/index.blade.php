@extends('layouts.backend')

@prepend('scripts')
    <script>
    $(function() {
        $("#current_password").keydown(function(key) {
            if (key.keyCode == 13) {

            }
        });
    });
    </script>
@endprepend

@section('content')
    <!-- content : start-->
    <div class="container-fluid flex-grow-1 container-p-y edit_my_information">
        <div class="wrap">
            <form method="post" action="{{ route('confirm_check') }}">
                @csrf
                <div class="inner">
                    <div class="text_box">
                        <div class="img_box">
                            <img src="/assets/img/icon_lock.png" alt="아이콘 자물쇠"/>
                        </div>
                        <p>입력창에 비밀번호를 입력해 주세요.</p>
                        <p>개인 정보를 수정하실 수 있습니다.</p>
                    </div>
                    <div class="input_box">
                        <input id="current_password" type="password" class="@error('current_password') is-invalid @enderror" placeholder="비밀번호를 입력하세요" name="current_password" required>
                        @error('current_password')
                        <span class="invalid-feedback" role="alert">
                        <strong></strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- content : end-->
@endsection
