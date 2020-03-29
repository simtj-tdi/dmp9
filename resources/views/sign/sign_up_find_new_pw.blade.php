@extends('layouts.sign')

@prepend('scripts')
    <script>
        function addRequestData() {
            $("#request_data").show();
        }
        function addRequestDataDisNone() {
            $("#request_data").hide();
        }

        $(function() {

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

            $("#btn_submit").click(function() {

                if ($("input[name=password]").val() == "") {
                    alert('비밀번호를 입력하세요.');
                    return false;
                }

                if ($("input[name=password_confirmation]").val() == "") {
                    alert('비밀번호 확인을 입력하세요.');
                    return false;
                }

                if ($("input[name=password_check]").val() == "no") {
                    alert('비밀번호가 일치하지 않습니다.1');
                    return false;
                }

                if ($("input[name=password]").val() != $("input[name=password_confirmation]").val() ) {
                    alert('비밀번호가 일치하지 않습니다.2');
                    return false;
                }

                var data = new Object();
                data.user_id = $("input[name='user_id']").val();
                data.password = $("input[name='password']").val() ;

                var jsonData = JSON.stringify(data);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('Users.SingUpNewPw') }}",
                    method: "POST",
                    dataType: "json",
                    data: {'data': jsonData},
                    success: function (data) {
                        var JSONArray = JSON.parse(JSON.stringify(data));

                        if (JSONArray['result'] == "success") {

                            $("#request_data").show();
                        } else if (JSONArray['result'] == "error") {
                            alert("Error while getting results");
                        };
                    },
                    error: function () {
                        alert("Error while getting results");
                    }
                });

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
            <div class="layout-container sign_up find_id find_new_pw">
                <div class="inner">
                    <div class="logo">
                        <h1>
                            <a href="/"><img src="../assets/img/sign_up/logo_dmp9.png" alt="DMP9 logo" /></a>
                        </h1>
                    </div>
                    <div class="form_box">
                        <div class="input_box">
                            <form method="POST" action="">
                                <input type="hidden" name="user_id" value="{{ request()->get('user_id') }}">
                                <input type="hidden" name="password_check" value="no">
                                <p class="desc">
                                    새 비밀번호 설정
                                    <br/>
                                    <span>
                                      새로운 비밀번호를 입력해주세요.
                                    </span>
                                </p>

                                <div class="input-group">
                                    <label>비밀번호</label>
                                    <input type="password" class="form-control" name="password" placeholder="영문,숫자 포함 8~12자를 입력해주세요" />
                                </div>
                                <div class="input-group  new_pw">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="비밀번호 재입력" />
                                </div>
                                <div class="message_group">
                                    <div class="check_state_yes" name="passcheck_state_yes" style="display: none;">비밀번호가 일치합니다.</div>
                                    <div class="check_state_no" name="passcheck_state_no" style="display: none;">비밀번호가 일치하지 않습니다.</div>
                                    <!-- <div class="check_state_yes">비밀번호가 일치합니다.</div> -->
                                    <!-- <div class="check_state_no">비밀번호가 일치하지 않습니다.</div> -->
                                </div>
                                <div class="but_box">
                                    <button type="button" id="btn_submit" >확인</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <p class="txt_bottom">Copyright © DMP9. All rights reserved.</p>
                </div>

                <!--팝업-->
                <div id="request_data" class="request_data overlay-wrap alert">
                    <div class="writing_wrap">
                        <div class="writing_box">
                            <div class="inner">
                                <button type="button" class="close_btn" onclick="addRequestDataDisNone()">
                                    <img src="/assets/img/sign_up/btn_close.png"/>
                                </button>
                                <div class="cont">
                                    <p>비밀번호 변경이 완료되었습니다.</p>
                                    <p>변경된 비밀번호로 로그인해주세요.</p>
                                </div>
                                <div class="btn_box">
                                    <button type="button" onclick="location.href = '{{ route('login') }}';" >확인</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--content-->

        </div>
        <!-- Layout inner -->

        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
@endsection
