@extends('layouts.backend')

@prepend('scripts')
    <script>
    $(function() {
        $("#current_password").keydown(function(key) {
            if (key.keyCode == 13) {
                var data = new Object();
                data.password = $("#current_password").val();
                var jsonData = JSON.stringify(data);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('confirm_check') }}",
                    method: "POST",
                    dataType: "json",
                    data: {'data': jsonData},
                    success: function (data) {
                        var JSONArray = JSON.parse(JSON.stringify(data));
                        if (JSONArray['result'] == "success") {
                            $("form[name='frm']").attr("onsubmit", "return true");
                            $("form[name='frm']").attr("action", "{{ route('my_show') }}");
                            $("form[name='frm']").submit();
                        } else if (JSONArray['result'] == "error") {
                            alert(JSONArray['error_message']);
                        };
                    },
                    error: function () {
                        alert("Error while getting results");
                    }
                });
            }
        });
    });
    </script>
@endprepend

@section('content')
    <!-- content : start-->
    <div class="container-fluid flex-grow-1 container-p-y edit_my_information">
        <div class="wrap">
            <form name="frm" method="post" onsubmit="return false"  action="">
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
                        <input id="current_password" type="password" class="@error('current_password') is-invalid @enderror" placeholder="비밀번호를 입력하세요" name="current_password" autocomplete="off" required>
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
