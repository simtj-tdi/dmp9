@extends('layouts.sign')

@prepend('scripts')
    function maxLengthCheck(object){
        if (object.value.length > object.maxLength){
            object.value = object.value.slice(0, object.maxLength);
        }
    }

    $(function() {
        $("button[name=id_check_btn]").click(function() {
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

            if ($("input[name=name]").val() == "") {
                alert('이름을 입력하세요.');
                return false;
            }

            if ($("input[name=company_name]").val() == "") {
                alert('회사명을 입력하세요.');
                return false;
            }

            if ($("input[name=email_id]").val() == "") {
                alert('이메일을 입력하세요.');
                return false;
            }

            if ($("input[name=email_text]").val() == "") {
                alert('이메일을 입력하세요.');
                return false;
            }

            if ($("input[name=phone_1]").val() == "") {
                alert('전화번호를 입력하세요.');
                return false;
            }

            if ($("input[name=phone_2]").val() == "") {
                alert('전화번호를 입력하세요.');
                return false;
            }

            if ($("input[name=phone_3]").val() == "") {
                alert('전화번호를 입력하세요.');
                return false;
            }

            $("form[name=user]").submit();
        });
    });
@endprepend

@section('content')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-1">
        <!-- Layout inner -->
        <div class="layout-inner">

            <!-- 회원가입 (회사) -->
            <div class="layout-container sign_up"> <!--폴더 부분-->
                <div class="inner">
                    <div class="title">
                        <h1>회원가입</h1>
                    </div>
                    <div class="input_box">
                        <form name="user" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="{{ request()->query('type') }}">
                            <input type="hidden" name="id_check" value="no">
                            <input type="hidden" name="password_check" value="no">

                            <div class="input-group">
                                <label>아이디</label>
                                <input type="text" class="form-control" name="user_id" placeholder="아이디">
                                <button type="button" name="id_check_btn">중복확인</button>
                            </div>
                            <div class="message_group">
                                <div class="check_state_yes" name="idcheck_state_yes" style="display: none;">사용 가능한 아이디 입니다.</div>
                                <div class="check_state_no" name="idcheck_state_no" style="display: none;">이미 가입된 아이디 입니다.</div>
                            </div>
                            <div class="input-group">
                                <label>비밀번호</label>
                                <input type="password" class="form-control" name="password" placeholder="영문, 숫자 포함 8~12자">
                            </div>
                            <div class="input-group">
                                <label>비밀번호 확인</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="영문, 숫자 포함 8~12자">
                            </div>
                            <div class="message_group">
                                <div class="check_state_yes" name="passcheck_state_yes" style="display: none;">비밀번호가 일치합니다.</div>
                                <div class="check_state_no" name="passcheck_state_no" style="display: none;">비밀번호가 일치하지 않습니다.</div>
                            </div>
                            <div class="input-group">
                                <label>이름</label>
                                <input type="text" class="form-control" name="name" placeholder="이름">
                            </div>
                            <div class="input-group">
                                <label>회사명</label>
                                <input type="text" class="form-control" name="company_name" placeholder="회사명">
                            </div>
                            <div class="input-group">
                                <label>이메일</label>
                                <div class="form-inline mail">
                                    <div>
                                        <input type="text" class="email_id form-control" name="email_id" id="email_id">
                                        <input type="text" class="email_text form-control" name="email_text" id="email_text" readonly  value="naver.com">
                                        <select class="form-control" id="select_email" onchange="selectEmail()">
                                            <option value="1">직접입력</option>
                                            <option value="naver.com" selected>naver.com</option>
                                            <option value="hanmail.net">hanmail.net</option>
                                            <option value="hotmail.com">hotmail.com</option>
                                            <option value="nate.com">nate.com</option>
                                            <option value="yahoo.co.kr">yahoo.co.kr</option>
                                            <option value="empas.com">empas.com</option>
                                            <option value="dreamwiz.com">dreamwiz.com</option>
                                            <option value="freechal.com">freechal.com</option>
                                            <option value="lycos.co.kr">lycos.co.kr</option>
                                            <option value="korea.com">korea.com</option>
                                            <option value="gmail.com">gmail.com</option>
                                            <option value="hanmir.com">hanmir.com</option>
                                            <option value="paran.com">paran.com</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>연락처</label>
                                <div class="phone_box input_control form-inline">
                                    <select class="form-control phone" name="phone_1">
                                        <option>010</option>
                                        <option>011</option>
                                        <option>016</option>
                                        <option>017</option>
                                        <option>018</option>
                                        <option>019</option>
                                    </select>
                                    <input type="number" name="phone_2" maxlength="4" class="phone form-control" placeholder="" oninput="maxLengthCheck(this)">
                                    <input type="number" name="phone_3" maxlength="4" class="phone form-control" placeholder="" oninput="maxLengthCheck(this)">
                                </div>
                            </div>

                            <div class="but_box mt-4">
                                <button type="button" name="btn_submit" >가입완료</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Layout inner -->

        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

@endsection
