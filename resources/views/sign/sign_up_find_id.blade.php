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

            $("#btn_submit").click(function() {

                if ($("input[name=name]").val() == "") {
                    alert('이름을 입력해주세요.');
                    return false;
                }

                if ($("input[name=phone]").val() == "") {
                    alert('연락처를 입력해주세요.');
                    return false;
                }


                var data = new Object();
                data.name = $("input[name='name']").val();
                data.phone = $("input[name='phone']").val() ;

                var jsonData = JSON.stringify(data);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('Users.SingUpFindId') }}",
                    method: "POST",
                    dataType: "json",
                    data: {'data': jsonData},
                    success: function (data) {
                        var JSONArray = JSON.parse(JSON.stringify(data));

                        if (JSONArray['result'] == "success") {
                            $("#msg").text("고객님의 아이디는 "+JSONArray['result_info'][0]['user_id']+" 입니다.");
                            $("#request_data").show();
                        } else if (JSONArray['result'] == "error") {
                            $("#msg").text("일치하는 사용자가 없습니다.");
                            $("#request_data").show();
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
            <div class="layout-container sign_up find_id">
                <div class="inner">
                    <div class="logo">
                        <h1>
                            <a href="/main/main.html"><img src="../assets/img/sign_up/logo_dmp9.png" alt="DMP9 logo" /></a>
                        </h1>
                    </div>
                    <div class="form_box">
                        <div class="input_box">
                            <form>
                                <p class="desc">
                                    아이디 찾기
                                    <br/>
                                    <span>
                                      가입정보를 입력해주세요.
                                    </span>
                                </p>
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control"  placeholder="이름을 입력해주세요" />
                                </div>
                                <div class="input-group">
                                    <input type="number" name="phone" class="form-control"  placeholder="연락처를 입력해주세요" />
                                </div>
                                <div class="but_box mt-4">
                                    <button type="button" id="btn_submit" >아이디 찾기</button>
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
                                    <!-- <p>일치하는 사용자가 없습니다.</p> -->
                                    <p id="msg"></p>
                                </div>
                                <div class="btn_box">
                                    <button type="button" onclick="addRequestDataDisNone()">확인</button>
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
