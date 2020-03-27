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
            <div class="layout-container sign_up  finish_sign_up">
                <div class="inner">
                    <div class="logo">
                        <h1>
                            <a href="/main/main.html"><img src="../assets/img/sign_up/logo_dmp9.png" alt="DMP9 logo" /></a>
                        </h1>
                    </div>
                    <div class="form_box">
                        <div class="input_box">
                            <form action="">
                                <p class="desc">
                                    가입이<br/>
                                    완료되었습니다.
                                    <br/>
                                    <span>
                                      관리자 승인 후 로그인이 가능합니다.
                                    </span>
                                </p>

                                <div class="but_box mt-4">
                                    <button type="button" onClick="/">
                                        <img src="/assets/img/sign_up/icon_left.png"/> 메인 바로가기
                                    </button>
                                </div>
                            </form>
                        </div>
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
