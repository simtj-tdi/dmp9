@extends('layouts.backend')

@section('content')

<!-- Layout wrapper -->
<div class="layout-wrapper layout-1">
    <!-- Layout inner -->
    <div class="layout-inner">

        <!-- 회원가입 (회사) -->
        <div class="layout-container sign_up tax_bill"> <!--폴더 부분-->
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
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" disabled  placeholder="이름">
                        </div>
                        <div class="input-group">
                            <label>회사명</label>
                            <input type="text" class="form-control" name="company_name" value="{{ $user->company_name }}" placeholder="회사명">
                        </div>
                        <div class="input-group">
                            <label>이메일</label>
                            <div class="form-inline mail">
                                <div>
                                    <input type="text" class="email_id form-control" name="email_id" id="email_id" value="{{ $email[0] }}">
                                    <input type="text" class="email_text form-control" name="email_text" id="email_text" value="{{ $email[1] }}" readonly  >
                                    <select class="form-control" id="select_email" onchange="selectEmail()">
                                        <option value="1">직접입력</option>
                                        <option value="naver.com" {{ $email[1] == 'naver.com' ? 'selected' : '' }} >naver.com</option>
                                        <option value="hanmail.net" {{ $email[1] == 'hanmail.net' ? 'selected' : '' }} >hanmail.net</option>
                                        <option value="hotmail.com" {{ $email[1] == 'hotmail.com' ? 'selected' : '' }} >hotmail.com</option>
                                        <option value="nate.com" {{ $email[1] == 'nate.com' ? 'selected' : '' }} >nate.com</option>
                                        <option value="yahoo.co.kr" {{ $email[1] == 'yahoo.co.kr' ? 'selected' : '' }} >yahoo.co.kr</option>
                                        <option value="empas.com" {{ $email[1] == 'empas.com' ? 'selected' : '' }} >empas.com</option>
                                        <option value="dreamwiz.com" {{ $email[1] == 'dreamwiz.com' ? 'selected' : '' }} >dreamwiz.com</option>
                                        <option value="freechal.com" {{ $email[1] == 'freechal.com' ? 'selected' : '' }} >freechal.com</option>
                                        <option value="lycos.co.kr" {{ $email[1] == 'lycos.co.kr' ? 'selected' : '' }} >lycos.co.kr</option>
                                        <option value="korea.com" {{ $email[1] == 'korea.com' ? 'selected' : '' }} >korea.com</option>
                                        <option value="gmail.com" {{ $email[1] == 'gmail.com' ? 'selected' : '' }} >gmail.com</option>
                                        <option value="hanmir.com" {{ $email[1] == 'hanmir.com' ? 'selected' : '' }} >hanmir.com</option>
                                        <option value="paran.com" {{ $email[1] == 'paran.com' ? 'selected' : '' }} >paran.com</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>연락처</label>
                            <div class="phone_box input_control form-inline">
                                <select class="form-control phone" name="phone_1">
                                    <option value="010" {{ $phone[0] == '010' ? 'selected' : '' }} >010</option>
                                    <option value="011" {{ $phone[0] == '011' ? 'selected' : '' }} >011</option>
                                    <option value="016" {{ $phone[0] == '016' ? 'selected' : '' }} >016</option>
                                    <option value="017" {{ $phone[0] == '017' ? 'selected' : '' }} >017</option>
                                    <option value="018" {{ $phone[0] == '018' ? 'selected' : '' }} >018</option>
                                    <option value="019" {{ $phone[0] == '019' ? 'selected' : '' }} >019</option>
                                </select>
                                <input type="number" name="phone_2" maxlength="4" class="phone form-control" placeholder="" value="{{ $phone[1] }}" oninput="maxLengthCheck(this)">
                                <input type="number" name="phone_3" maxlength="4" class="phone form-control" placeholder="" value="{{ $phone[2] }}" oninput="maxLengthCheck(this)">
                            </div>
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
                                <label>업종</label>
                                <select class="form-control" name="tax_industry">
                                    <option value="업종 01" {{ $taxs[0]['tax_industry'] == '업종 01' ? 'selected' : '' }} >업종 01</option>
                                    <option value="업종 02" {{ $taxs[0]['tax_industry'] == '업종 02' ? 'selected' : '' }} >업종 02</option>
                                </select>
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
