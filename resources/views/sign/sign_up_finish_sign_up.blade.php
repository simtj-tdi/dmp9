@extends('layouts.sign')

@prepend('scripts')
    <script>

        $(function() {

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
                            <a href="/"><img src="../assets/img/sign_up/logo_dmp9.png" alt="DMP9 logo" /></a>
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
                                    <button type="button" onclick="location.href = '/';" >
                                        <img src="/assets/img/sign_up/icon_left.png"/> 메인 바로가기
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="notice_box">
                        <div class="notice_inner">
                            <img src="/assets/img/sign_up/exclamation.png" alt="느낌표 아이콘"/>
                            <p>관리자 승인은 24시간 이내에 처리되며,</p>
                            <p>승인완료시 가입한 이메일로 알림메일이 전송됩니다.</p>
                            <p>승인 후 데이터를 요청 할 수 있습니다.</p>
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
