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

    <div class="container-fluid flex-grow-1 container-p-y edit_my_info">

        <div class="wrap">
            <div class="top">
                내정보 수정
                <!-- <span class="txt">DMP9에게 궁금한 점을 쉽고 빠르게 찾아보세요.</span> -->
            </div>
            <div class="cont">

                <div class="inner">
                    <form>
                        <div class="title">기본정보</div>
                        <div class="edit_wrap">
                            <div class="input-group first_radius">
                                <div class="label_box">
                                    <label>이름</label>
                                </div>
                                <div class="input_box">
                                    <input type="text" placeholder="" value="홍길동" />
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="label_box">
                                    <label>아이디</label>
                                </div>
                                <div class="input_box">
                                    <input type="text" placeholder="" value="abcd" readonly/>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="label_box">
                                    <label>비밀번호</label>
                                </div>
                                <div class="input_box">
                                    <input type="password" placeholder="영문,숫자 포함 8~12자를 입력해주세요" autocomplete="off" />
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="label_box">
                                    <label>비밀번호 확인</label>
                                </div>
                                <div class="input_box">
                                    <input type="password" placeholder="영문,숫자 포함 8~12자를 입력해주세요" autocomplete="off" />
                                    <div class="message_group">
                                        <!-- <div class="check_state_yes">비밀번호가 일치합니다.</div> -->
                                        <div class="check_state_no">비밀번호가 일치하지 않습니다.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="label_box">
                                    <label>회사명</label>
                                </div>
                                <div class="input_box">
                                    <input type="text" placeholder="" value="TDI"  />
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="label_box">
                                    <label>이메일</label>
                                </div>
                                <div class="input_box">
                                    <input type="text" placeholder="" value="abcd@nsmg21.com" />
                                </div>
                            </div>
                            <div class="input-group last_radius">
                                <div class="label_box">
                                    <label>연락처</label>
                                </div>
                                <div class="input_box">
                                    <input type="number" placeholder="" value="01012345678" />
                                </div>
                            </div>


                            <!--사업자정보-->
                            <div class="title company_title">사업계산서 수정</div>
                            <div class="input-group first_radius">
                                <div class="label_box">
                                    <label>사업자등록번호</label>
                                </div>
                                <div class="input_box">
                                    <input type="text" placeholder="" value="123-a15-2131" />
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="label_box">
                                    <label>업체명(법인명)</label>
                                </div>
                                <div class="input_box">
                                    <input type="text" placeholder="" value="TDI" />
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="label_box">
                                    <label>대표자명</label>
                                </div>
                                <div class="input_box">
                                    <input type="text" placeholder="" value="홍길동" />
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="label_box">
                                    <label>주소</label>
                                </div>
                                <div class="input_box">
                                    <div class="address_box form-inline">
                                        <input type="text" id="postcode" class="postcode form-control form-control2" placeholder="우편번호를 입력해주세요">
                                        <button type="button" onclick=" execDaumPostcode()"> 검색</button>
                                        <input type="text" id="address" class="address form-control" placeholder="기본주소를 검색하세요">
                                        <input type="text" id="detailAddress" class="detailAddress form-control" placeholder="상세주소를 입력해주세요">
                                        <input type="text" id="extraAddress" class="extraAddress form-control" placeholder="참고항목">
                                    </div>
                                </div>
                            </div>
                            <div class="input-group last_radius">
                                <div class="label_box">
                                    <label>사업자등록증</label>
                                </div>
                                <div class="input_box">
                                    <input type="text" class="form-control form-control2 text_name" placeholder="사업자등록증을 첨부해주세요" disabled="">
                                    <input id="file_name" type="file" class="upload_name form-control">
                                    <label for="file_name" class="business_btn">첨부하기</label>
                                </div>
                            </div>
                        </div>
                        <!--사업자정보-->

                        <div class="but_box mt-4">
                            <button type="button">회원정보수정</button>
                            <button type="button">취소</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
