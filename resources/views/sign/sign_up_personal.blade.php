@extends('layouts.sign')

@prepend('scripts')

@endprepend

@section('content')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-1">
        <!-- Layout inner -->
        <div class="layout-inner">

            <!-- 회원가입 (회사) -->
            <div class="layout-container sign_up"> <!--폴더 부분-->
                <div class="inner">
                    <div class="title">
                        <h1>회원가입</h1>
                    </div>
                    <div class="input_box">
                        <form action="">
                            <div class="input-group">
                                <label>아이디</label>
                                <input type="text" class="form-control" placeholder="아이디">
                                <button type="button">중복확인</button>
                            </div>
                            <div class="message_group">
                                <div class="check_state_yes">사용 가능한 아이디 입니다.</div>
                                <!-- <div class="check_state_no">이미 가입된 아이디 입니다.</div> -->
                            </div>
                            <div class="input-group">
                                <label>비밀번호</label>
                                <input type="password" class="form-control" placeholder="영문, 숫자 포함 8~12자">
                            </div>
                            <div class="input-group">
                                <label>비밀번호 확인</label>
                                <input type="password" class="form-control" placeholder="영문, 숫자 포함 8~12자">
                            </div>
                            <div class="message_group">
                                <!-- <div class="check_state_yes">비밀번호가 일치합니다.</div> -->
                                <div class="check_state_no">비밀번호가 일치하지 않습니다.</div>
                            </div>
                            <div class="input-group">
                                <label>이름</label>
                                <input type="text" class="form-control" placeholder="이름">
                            </div>
                            <div class="input-group">
                                <label>회사명</label>
                                <input type="text" class="form-control" placeholder="회사명">
                            </div>
                            <div class="input-group">
                                <label>이메일</label>
                                <div class="form-inline mail">
                                    <div>
                                        <input type="text" class="email_id form-control" name="email_id" id="email_id">
                                        <input type="text" class="email_text form-control" name="email_text" id="email_text" disabled value="naver.com">
                                        <select class="form-control" id="select_email" onchange="selectEmail()">
                                            <option value="1">직접입력</option>
                                            <option value="naver.com" selected>naver.com</option>
                                            <option value="hanmail.net">hanmail.net</option>
                                            <option value="hotmail.com">hotmail.com</option>
                                            <option value="nate.com">nate.com</option>
                                            <option value="yahoo.co.kr">yahoo.co.kr</option>
                                            <option value="empas.com">empas.com</option>
                                            <option value="dreamwiz.com">dreamwiz.com</option>
                                            <option value="freechal.com">freechal.com</option>
                                            <option value="lycos.co.kr">lycos.co.kr</option>
                                            <option value="korea.com">korea.com</option>
                                            <option value="gmail.com">gmail.com</option>
                                            <option value="hanmir.com">hanmir.com</option>
                                            <option value="paran.com">paran.com</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>연락처</label>
                                <div class="phone_box input_control form-inline">
                                    <select class="form-control phone">
                                        <option>010</option>
                                        <option>011</option>
                                        <option>016</option>
                                        <option>017</option>
                                        <option>018</option>
                                        <option>019</option>
                                    </select>
                                    <input type="number" name="" class="phone form-control" placeholder="">
                                    <input type="number" name="" class="phone form-control" placeholder="">
                                </div>
                            </div>
                            <div class="but_box mt-4">
                                <button type="submit">가입완료</button>
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
