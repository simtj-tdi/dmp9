@extends('layouts.sign')

@prepend('scripts')
    <script>
        $(function() {
            $("input[name=radio]").click(function() {
                if (!$('input:radio[name=radio]').is(':checked')) {
                    alert('가입 유형을 선택 해주세요');
                    return false;
                }

                if ($('input:radio[id=radio1]').is(':checked')) {

                    $("input[name=type]").val($('input:radio[id=radio1]').val());
                }

                if ($('input:radio[id=radio2]').is(':checked')) {
                    $("input[name=type]").val($('input:radio[id=radio2]').val());
                }


                $("form[name=sign_up]").submit();

            });
        });
    </script>
@endprepend

@section('content')
    <!-- Layout wrapper -->
    <form method="POST" name="sign_up" action="/sign_up_terms">
        @csrf
        <input type="hidden" name="type" value="">
        <div class="layout-wrapper layout-1">
        <!-- Layout inner -->
        <div class="layout-inner">
            <!--content-->
            <div class="layout-container choice">
                <div class="inner">
                    <div class="logo">
                        <h1>
                            <a href="/"><img src="/img/sign_up/logo_dmp9.png" alt="DMP9 logo"/></a>
                        </h1>
                    </div>
                    <div class="form_box">
              <span class="form_ico">
                <img src="/img/sign_up/ico_etc.png" alt="" />
              </span>
                        <div class="input_box">
                            <p class="desc">
                                가입을<br />
                                시작합니다!
                            </p>
                            <p class="desc_sub">
                                가입유형을 선택해주세요.
                            </p>
                            <ul>
                                <li>
                                    <span class="radio1">
                                      <input type="radio" name="radio" id="radio1" value="personal" />
                                      <label for="radio1"></label>
                                    </span>
                                                    <span class="txt">
                                      <p>개인회원</p>
                                      <p>개인회원 가입을 원하시면 선택해주세요.</p>
                                    </span>
                                </li>
                                <li>
                                    <span class="radio2">
                                      <input type="radio" name="radio" id="radio2" value="company" />
                                      <label for="radio2"></label>
                                    </span>
                                                    <span class="txt">
                                      <p>기업회원</p>
                                      <p>기업회원 가입을 원하시면 선택해주세요.</p>
                                    </span>
                                </li>
                            </ul>
                            <hr/>
                            <div class="but">
                                <p>이미 계정이 있으세요?</p>
                                <button type="button" name="btn"><a href="/login">로그인하기</a></button>
                            </div>
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
    </form>
    <!-- / Layout wrapper -->
@endsection
