@extends('layouts.sign')

@prepend('scripts')
    <script>
        function validateEmail(sEmail) {
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            return filter.test(sEmail) ? true : false;
        };

        function validatePassword(sPassword) {
            var filter = /^[A-Za-z0-9]{8,12}$/;
            return filter.test(sPassword) ? true : false;
        };



        $(function() {

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

                        <div class="input_box">
                        <form action="">
                            <p class="desc">
                                가입정보를<br />
                                입력해주세요.
                            </p>
                            <div class="input-group">
                                <label>아이디</label>
                                <input type="text" name="user_id" class="form-control form-control2" placeholder="사용하실 아이디를 입력해주세요" />
                                <button type="button" name="id_check_btn">중복확인</button>
                            </div>
                            <div class="message_group">
                                <div class="check_state_yes" name="idcheck_state_yes" style="display: none;">사용 가능한 아이디 입니다.</div>
                                <div class="check_state_no" name="idcheck_state_no" style="display: none;">이미 가입된 아이디 입니다.</div>
                            </div>
                            <div class="input-group">
                                <label>비밀번호</label>
                                <input type="password" class="form-control" name="password" placeholder="영문,숫자 포함 8~12자를 입력해주세요" />
                            </div>
                            <div class="input-group">
                                <label>비밀번호 확인</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="비밀번호 재입력" />
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
                            <div class="input-group">
                                <label>연락처</label>
                                <input type="number" class="form-control" name="phone" placeholder="연락처를 입력해주세요" />
                            </div>
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