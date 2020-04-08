@extends('layouts.sign')

@prepend('scripts')
    <script>
    $(function() {
        $("button[name=btn]").click(function(e) {
            var success = true;
            $("input:checkbox[name=check]").each(function() {
                if (this.checked == false) {
                    alert('필수 약관동의 후 가입이 가능합니다.');
                    success = false;
                    return false;
                }
            });

            if (success == false) {
                return false;
            }

            $("form[name=sign_up]").submit();

        });
    });
    </script>
@endprepend

@section('content')

    <form method="POST" name="sign_up" action="/sign_up_register">
        <input type="hidden" name="type" value="{{ $request['type'] }}">
    @csrf
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-1">
        <!-- Layout inner -->
        <div class="layout-inner">
            <!--content-->
            <!-- 약관동의 -->
            <div class="layout-container terms">
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
                        <div class="input_box">
                            <p class="desc">
                                약관에<br />
                                동의해주세요.
                            </p>
                            <p class="desc_sub">
                                필수 약관동의 후 가입이 가능합니다.
                            </p>
                            <ul>
                                <li>
                                    <span class="checkbox">
                                      <input type="checkbox" id="all_checkbox" />
                                      <label for="all_checkbox"></label>
                                    </span>
                                    <span class="txt">
                                        <label for="all_checkbox">
                                        모두 동의합니다.
                                        </label>
                                    </span>
                                </li>
                                <li>
                                    <span class="checkbox">
                                      <input type="checkbox" name="check" id="Check_1" />
                                      <label for="Check_1"></label>
                                    </span>
                                    <span class="txt">
                                      <label for="Check_1">
                                              DMP9 서비스 이용약관 (필수)
                                      </label>
                                    </span>
                                    <a href="/terms_01">보기</a>
                                </li>
                                <li>
                                    <span class="checkbox">
                                      <input type="checkbox" name="check" id="Check_2" />
                                      <label for="Check_2"></label>
                                    </span>
                                    <span class="txt">
                                        <label for="Check_2">
                                            개인정보 수집 및 이용 안내 (필수)
                                        </label>
                                    </span>
                                    <a href="/terms_02">보기</a>
                                </li>
                                <li>
                                    <span class="checkbox">
                                      <input type="checkbox" name="check" id="Check_3" />
                                      <label for="Check_3"></label>
                                    </span>
                                    <span class="txt">
                                        <label for="Check_3">
                                            개인정보 처리 위탁 안내 (필수)
                                        </label>
                                        </span>
                                    <a href="/terms_02">보기</a>
                                </li>
                            </ul>
                            <div class="but_box">
                                <button type="button" name="btn">다음</button>
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
    <!-- / Layout wrapper -->
    </form>
@endsection
