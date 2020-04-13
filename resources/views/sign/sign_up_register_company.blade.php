@extends('layouts.sign')

@prepend('scripts')
    <script>
        $(function() {

            $("button[name=btn_submit]").click(function() {

                if ($("input[name=tax_company_number]").val() == "") {
                    alert('사업자등록번호를 입력해주세요.');
                    return false;
                }

                if ($("input[name=tax_company_name]").val() == "") {
                    alert('업체명을 입력해주세요.');
                    return false;
                }

                if ($("input[name=tax_name]").val() == "") {
                    alert('대표자명을 입력해주세요.');
                    return false;
                }

                if ($("input[name=tax_zipcode]").val() == "") {
                    alert('우편번호를 입력해주세요');
                    return false;
                }

                if ($("input[name=tax_addres_1]").val() == "") {
                    alert('상세주소를 입력해주세요.');
                    return false;
                }

                if ($("input[name=tax_img]").val() == "") {
                    alert('사업장등록증을 등록하세요.');
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
            <!-- 세금계산서 -->
            <div class="layout-container sign_up">
                <div class="inner">
                    <div class="logo">
                        <h1>
                            <a href="/"><img src="/img/sign_up/logo_dmp9.png" alt="DMP9 logo" /></a>
                        </h1>
                    </div>
                    <div class="form_box">
                      <span class="form_ico">
                        <button type="button" onclick="window.history.go(-1);">
                          <img src="../assets/img/sign_up/icon_back.png" alt="" />
                        </button>
                      </span>
                        <div class="input_box">
                            <form name="user" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" value="{{ $request['type'] }}">
                                <input type="hidden" name="user_id" value="{{ $request['user_id'] }}">
                                <input type="hidden" name="password" value="{{ $request['password'] }}">
                                <input type="hidden" name="password_confirmation" value="{{ $request['password_confirmation'] }}">
{{--                                <input type="hidden" name="company_name" value="{{ $request['company_name'] }}">--}}
                                <input type="hidden" name="name" value="{{ $request['name'] }}">
                                <input type="hidden" name="email" value="{{ $request['email'] }}">
                                <input type="hidden" name="phone" value="{{ $request['phone'] }}">

                                <p class="desc">
                                    사업계산서 정보를<br />
                                    입력해주세요.
                                </p>
                                <div class="input-group">
                                    <label>사업자등록번호</label>
                                    <input type="text" class="form-control" name="tax_company_number" placeholder="사업자등록번호를 입력해주세요" autocomplete="off" />
                                </div>
                                <div class="input-group">
                                    <label>업체명(법인명)</label>
                                    <input type="text" class="form-control" name="tax_company_name" placeholder="업체명을 입력해주세요" autocomplete="off" />
                                </div>
                                <div class="input-group">
                                    <label>대표자명</label>
                                    <input type="text" class="form-control" name="tax_name" placeholder="대표자명을 입력해주세요" autocomplete="off" />
                                </div>
                                <div class="input-group">
                                    <label>주소</label>
                                    <div class="address_box form-inline">
                                        <input type="text" id="postcode" class="postcode form-control form-control2" name="tax_zipcode" placeholder="우편번호를 입력해주세요">
                                        <button type="button" onclick=" execDaumPostcode()" style="top:33px;">검색</button>
                                        <input type="text" id="address" class="address form-control" name="tax_addres_1" placeholder="기본주소를 검색하세요">
                                        <input type="text" id="detailAddress" class="detailAddress form-control" name="tax_addres_2" placeholder="상세주소를 입력해주세요" autocomplete="off">
                                        <input type="text" id="extraAddress" class="extraAddress form-control" placeholder="참고항목">
                                    </div>
                                </div>
                                <div class="input-group">
                                    <label>사업자등록증</label>
                                    <input
                                        type="text"
                                        class="form-control form-control2 text_name"
                                        placeholder="사업자등록증을 첨부해주세요"
                                        disabled
                                    />
                                    <input
                                        id="file_name"
                                        type="file" name="tax_img"
                                        class="upload_name form-control"
                                    />
                                    <label for="file_name" class="business_btn">첨부하기</label>
                                </div>
                                <div class="but_box mt-4">
                                    <button type="button" name="btn_submit"  >가입하기</button>

                                </div>
                            </form>
                        </div>
                    </div>
                    <p class="txt_bottom">Copyright © DMP9. All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- Layout inner -->

        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
@endsection
