@extends('layouts.sign')

@prepend('scripts')
    <script>
        var num = 60 * 3; // 몇분을 설정할지의 대한 변수 선언
        var myVar = 0;
        function time() {
            num = 60 * 3;
            clearInterval(myVar);
            myVar = setInterval(alertFunc, 1000);
        }

        function alertFunc() {
            var min = num / 60;
            min = Math.floor(min);

            var sec = num - (60 * min);

            $("[name=tokenTimer]").text(min + '분' + sec + '초');
            if(num == 0){
                clearInterval(myVar) // num 이 0초가 되었을대 clearInterval로 타이머 종료
            }
            num--;
        }

        $(document).on("keyup", "input:text[numberOnly]", function() {$(this).val( $(this).val().replace(/[^0-9]/gi,"") );});
        $(document).on("keyup", "input:text[engOnly]", function() {$(this).val( $(this).val().replace(/[0-9]|[^\!-z]/gi,"") );});


        $(document).on("keyup", "input:text[engNumber]", function() {$(this).val( $(this).val().replace(/[^a-zA-Z0-9]/gi,"") );});

        function validateEmail(sEmail) {
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            return filter.test(sEmail) ? true : false;
        };

        function validatePassword(sPassword) {
            var filter = /^[A-Za-z0-9]{8,12}$/;
            return filter.test(sPassword) ? true : false;
        };

        $(function() {

            $("button[name=sms_send]").click(function() {
                if ($("input[name=phone]").val() == "") {
                    alert('전화번호를 입력하세요.');
                    return false;
                }

                var data = new Object() ;
                data.phone = $("input[name=phone]").val();
                var jsonData = JSON.stringify(data);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('SmsSend') }}",
                    method: "POST",
                    dataType: "json",
                    data: {'data': jsonData},
                    success: function (data) {
                        var JSONArray = JSON.parse(JSON.stringify(data));
                        if (JSONArray['result'] == "success") {
                            alert('SMS를 전송했습니다.\n\n 인증번호를 입력해주세요.');
                            $("[name=tokenTimer]").css("display", "block");
                            time();
                        } else if (JSONArray['result'] == "error") {
                            alert(JSONArray['error_message']);
                        };

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert("Error while getting results");
                    }
                });
            });


            $("button[name=sms_check]").click(function() {

                if ($("input[name=phone]").val() == "") {
                    alert('전화번호를 입력하세요.');
                    return false;
                }

                if ($("input[name=token]").val() == "") {
                    alert('인증번호를 입력하세요.');
                    return false;
                }

                var data = new Object() ;
                data.phone = $("input[name=phone]").val();
                data.token = $("input[name=token]").val();
                var jsonData = JSON.stringify(data);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('SmsCheck') }}",
                    method: "POST",
                    dataType: "json",
                    data: {'data': jsonData},
                    success: function (data) {
                        var JSONArray = JSON.parse(JSON.stringify(data));

                        if (JSONArray['result'] == "success") {
                            alert('인증 되었습니다.');
                            $("button[name=sms_send]").attr( 'disabled', true );
                            $("[name=sms_check]").val('yes');
                            $("[name=tokenTimer]").css("display", "none");
                            $("[name=tokenTimer_yes]").css("display", "block");
                        } else if (JSONArray['result'] == "error") {
                            alert(JSONArray['error_message']);
                            $("button[name=sms_send]").attr( 'disabled', false );
                            $("[name=sms_check]").val('no');
                        };
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert("Error while getting results");
                    }
                });

            });


            $("button[name=id_check_btn]").click(function() {

                if (!$("input[name=user_id]").val()) {
                    alert('아이디를 입력하세요.');
                    return false;
                }

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('Users.idcheckrequest') }}",
                    method: "POST",
                    dataType: "text",
                    data: {'data': $("input[name=user_id]").val()},
                    success: function (data) {
                        var JSONArray = JSON.parse(data);

                        if (JSONArray['result'] != '') {
                            // false
                            $("[name=id_check]").val('no');
                            $("[name=idcheck_state_yes]").css('display','none');
                            $("[name=idcheck_state_no]").css('display','block');
                        } else {
                            // true
                            $("[name=id_check]").val('yes');
                            $("[name=idcheck_state_yes]").css('display','block');
                            $("[name=idcheck_state_no]").css('display','none');
                        }
                    }
                });
            });

            $("[name=password_confirmation]").keyup(function(){
                if ($("[name=password]").val() != $("[name=password_confirmation]").val()) {
                    // false
                    $("[name=password_check]").val('no');
                    $("[name=passcheck_state_yes]").css('display','none');
                    $("[name=passcheck_state_no]").css('display','block');
                }else{
                    // true
                    $("[name=password_check]").val('yes');
                    $("[name=passcheck_state_yes]").css('display','block');
                    $("[name=passcheck_state_no]").css('display','none');
                }
            });

            $("button[name=btn_submit]").click(function() {
                if ($("input[name=id_check]").val() == "no") {
                    alert('아이디 중복확인 해주세요.');
                    return false;
                }

                if ($("input[name=sms_check]").val() == "no") {
                    alert('SMS 인증을 해주세요.');
                    return false;
                }

                if ($("input[name=password_check]").val() == "no") {
                    alert('비밀번호가 일치하지 않습니다');
                    return false;
                }

                if ($("input[name=password]").val() != $("input[name=password_confirmation]").val()) {
                    alert('비밀번호가 일치하지 않습니다');
                    return false;
                }

                if ($("input[name=user_id]").val() == "") {
                    alert('아이디를 입력하세요.');
                    return false;
                }

                if ($("input[name=password]").val() == "") {
                    alert('비밀번호를 입력하세요.');
                    return false;
                }

                if ($("input[name=password_confirmation]").val() == "") {
                    alert('비밀번호 확인을 입력하세요.');
                    return false;
                }

                if (!validatePassword($("input[name=password]").val())) {
                    alert('영문, 숫자 포함 8~12자를 입력하세요.');
                    return false;
                }

                if ($("input[name=name]").val() == "") {
                    alert('이름을 입력하세요.');
                    return false;
                }

                if ($("input[name=company_name]").val() == "") {
                    alert('회사명을 입력하세요.');
                    return false;
                }

                if ($("input[name=email]").val() == "") {
                    alert('이메일을 입력하세요.');
                    return false;
                }

                if (!validateEmail($("input[name=email]").val())) {
                    alert('잘못된 이메일 형식 입니다');
                    return false;
                }

                if ($("input[name=phone]").val() == "") {
                    alert('전화번호를 입력하세요.');
                    return false;
                }

                $("form[name=user]").submit();
            });
        });
    </script>
@endprepend

@section('content')

<!-- Layout wrapper -->
<div class="layout-wrapper layout-1">
    <!-- Layout inner -->
    <div class="layout-inner">
        <!--content-->
        <!-- 회원가입 -->
        <div class="layout-container sign_up">
            <div class="inner">
                <div class="logo">
                    <h1>
                        <a href="/"><img src="/img/sign_up/logo_dmp9.png" alt="DMP9 logo" /></a>
                    </h1>
                </div>
                <div class="form_box">
              <span class="form_ico">
                <img src="/img/sign_up/ico_etc.png" alt="" />
              </span>

                    @if ($request['type'] == "personal")
                        <form name="user" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @elseif ($request['type'] =="company")
                        <form name="user" method="POST" action="/sign_up_register_company" enctype="multipart/form-data">
                    @endif

                        @csrf
                        <input type="hidden" name="type" value="{{ $request['type'] }}">
                        <input type="hidden" name="id_check" value="no">
                        <input type="hidden" name="password_check" value="no">
                        <input type="hidden" name="sms_check" value="no">


                        <div class="input_box">
                        <form action="">
                            <p class="desc">
                                가입정보를<br />
                                입력해주세요.
                            </p>
                            <div class="input-group">
                                <label>아이디</label>
                                <input type="text" name="user_id" class="form-control form-control2" engOnly placeholder="사용하실 아이디를 입력해주세요" />
                                <button type="button" name="id_check_btn">중복확인</button>
                            </div>
                            <div class="message_group">
                                <div class="check_state_yes" name="idcheck_state_yes" style="display: none;">사용 가능한 아이디 입니다.</div>
                                <div class="check_state_no" name="idcheck_state_no" style="display: none;">이미 가입된 아이디 입니다.</div>
                            </div>

                            <div class="input-group">
                                <label>연락처</label>
                                <input type="text" class="form-control form-control2" name="phone" numberOnly placeholder="연락처 (ex 01012345678)" />
                                <button type="button" name="sms_send" >인증번호</button>
                            </div>

                            <div class="input-group">
                                <label>인증번호</label>
                                <input type="text" class="form-control form-control2" name="token" numberOnly placeholder="인증번호를 입력해주세요" />
                                <button type="button" name="sms_check" >확인</button>
                            </div>
                            <div class="message_group">
                                <div class="check_state_no" name="tokenTimer" style="display: none;"></div>
                                <div class="check_state_yes" name="tokenTimer_yes" style="display: none;">인증이 완료 되었습니다.</div>
                            </div>

                            <div class="input-group">
                                <label>비밀번호</label>
                                <input type="password" class="form-control" name="password" engNumber placeholder="영문,숫자 포함 8~12자를 입력해주세요" />
                            </div>
                            <div class="input-group">
                                <label>비밀번호 확인</label>
                                <input type="password" class="form-control" name="password_confirmation" engNumber placeholder="비밀번호 재입력" />
                            </div>
                            <div class="message_group">
                                <div class="check_state_yes" name="passcheck_state_yes" style="display: none;">비밀번호가 일치합니다.</div>
                                <div class="check_state_no" name="passcheck_state_no" style="display: none;">비밀번호가 일치하지 않습니다.</div>
                            </div>
                            <div class="input-group">
                                <label>회사명</label>
                                <input type="text" class="form-control" name="company_name" placeholder="회사명을 입력해주세요" />
                            </div>
                            <div class="input-group">
                                <label>이름</label>
                                <input type="text" class="form-control" name="name" placeholder="이름을 입력해주세요" />
                            </div>
                            <div class="input-group">
                                <label>이메일</label>
                                <input type="text" class="form-control" name="email" placeholder="이메일을 입력해주세요" />
                            </div>
{{--                            <div class="input-group">--}}
{{--                                <label>연락처</label>--}}
{{--                                <input type="text" class="form-control" name="phone" numberOnly placeholder="연락처를 입력해주세요 (ex. 01012345678910)" />--}}
{{--                            </div>--}}
{{--<button type="button"  name="sms_send" >전송</button>--}}
                            <div class="but_box mt-4">
                                @if ($request['type'] == "personal")
                                    <button type="button" name="btn_submit" >가입하기</button>
                                @elseif ($request['type'] =="company")
                                    <button type="button" name="btn_submit" >다음</button>
                                @endif
                            </div>
                        </form>
                    </div>

                    </form>
                </div>
                <p class="txt_bottom">Copyright © DMP9. All rights reserved.</p>
            </div>
        </div>
        <!--content-->
    </div>
    <!-- Layout inner -->

    <div class="layout-overlay layout-sidenav-toggle"></div>
</div>
<!-- / Layout wrapper -->
@endsection
