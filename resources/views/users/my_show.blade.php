@extends('layouts.backend')

@prepend('scripts')
    <script>
        function maxLengthCheck(object){
            if (object.value.length > object.maxLength){
                object.value = object.value.slice(0, object.maxLength);
            }
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
            $("button[name=btn_submit]").click(function() {
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
    </script>
@endprepend

@section('content')

<!-- Layout wrapper -->
<div class="layout-wrapper layout-1">
    <!-- Layout inner -->
    <div class="layout-inner">

        <!-- 회원가입 (회사) -->
        <div class="layout-container sign_up tax_bill"> <!--폴더 부분-->
            <div class="inner">
                <div class="title">
                    <h1>회원수정</h1>
                </div>
                <div class="input_box">

                    <form name="user" method="POST" action="{{ route('my_update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="{{ $user->role }}">

                        <div class="input-group">
                            <label>아이디</label>
                            <input type="text" class="form-control" name="user_id" value="{{ $user->user_id }}" disabled placeholder="아이디">

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
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" readonly  placeholder="이름">
                        </div>
                        <div class="input-group">
                            <label>회사명</label>
                            <input type="text" class="form-control" name="company_name" value="{{ $user->company_name }}" placeholder="회사명">
                        </div>
                        <div class="input-group">
                            <label>이메일</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                        </div>
                        <div class="input-group">
                            <label>연락처</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                        </div>

                        @if ($taxs[0])
                        <!-- 사업자 정보 -->
                            <div class="title">
                                <h1>사업자 정보</h1>
                            </div>
                            <div class="input-group">
                                <label>대표자 명</label>
                                <input type="text" class="form-control" name="tax_name" value="{{$taxs[0]['tax_name']}}" placeholder="대표자명">
                            </div>
                            <div class="input-group">
                                <label>업체명 (법인명)</label>
                                <input type="text" class="form-control" name="tax_company_name" value="{{$taxs[0]['tax_company_name']}}" placeholder="업체명 (법인명)">
                            </div>

                            <div class="input-group">
                                <label>사업자 번호</label>
                                <div class="business_number_box">
                                    <input class="upload_name form-control" value="파일선택" disabled="disabled">
                                    <label for="file_name" class="form-control business_btn">업로드</label>
                                    <input type="file" id="file_name" name="tax_img" class="upload_hidden">
                                    <small class="form-text text-muted ml-2"  style="display: none;">사진용량 제한</small>

                                </div>
                            </div>
                            <div class="input-group">
                                <label>주소</label>
                                <div class="address_box form-inline">
                                    <input type="text" id="postcode" class="postcode form-control" name="tax_zipcode" value="{{$taxs[0]['tax_zipcode']}}" placeholder="우편번호">
                                    <input type="button" onclick=" execDaumPostcode()" class="postcode_btn form-control" value="우편번호 찾기">

                                    <input type="text" id="address" class="address form-control" name="tax_addres_1" value="{{$taxs[0]['tax_addres_1']}}" placeholder="주소">
                                    <input type="text" id="detailAddress" class="detailAddress form-control" name="tax_addres_2" value="{{$taxs[0]['tax_addres_2']}}" placeholder="상세주소">
                                    <input type="text" id="extraAddress" class="extraAddress form-control" name="tax_reference" value="{{$taxs[0]['tax_reference']}}" placeholder="참고항목">
                                </div>
                            </div>

                        @endif

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
