@extends('layouts.frontend')
@prepend('scripts')
    <script>

        function validateEmail(sEmail) {
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (filter.test(sEmail)) {
                return true;
            }
            else {
                return false;
            }
        };

        $(function() {

            $("#btn_submit").click(function() {

                if ($("input[name=name]").val() == "") {
                    alert('회사명 / 이름을 입력해주세요.');
                    return false;
                }

                if ($("input[name=phone]").val() == "") {
                    alert('핸드폰 번호을 입력해주세요.');
                    return false;
                }

                if ($("input[name=email]").val() == "") {
                    alert('이메일 주소을 입력해주세요.');
                    return false;
                }

                var sEmail = $("input[name=email]").val();

                if (!validateEmail(sEmail)) {
                    alert('잘못된 이메일 형식 입니다');
                    return false;
                }

                if ($("[name=content]").val() == "") {
                    alert('문의사항을 입력해주세요.');
                    return false;
                }

                var data = new Object();
                data.name = $("input[name=name]").val();
                data.phone = $("input[name=phone]").val() ;
                data.email = $("input[name=email]").val();
                data.content = $("[name=content]").val();

                var jsonData = JSON.stringify(data);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('Contactsus.create') }}",
                    method: "POST",
                    dataType: "json",
                    data: {'data': jsonData},
                    success: function (data) {
                        var JSONArray = JSON.parse(JSON.stringify(data));

                        if (JSONArray['result'] == "success") {
                            $("input[name=name]").val("");
                            $("input[name=phone]").val("") ;
                            $("input[name=email]").val("");
                            $("[name=content]").val("");

                            alert('등록 되었습니다.');
                        } else if (JSONArray['result'] == "error") {
                            alert(JSONArray['error_message']);
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
    <!-- Swiper -->
    <div class="swiper-container banner">
        <div class="swiper-wrapper">
            <div class="swiper-slide banner_box_01">
                <div class="banner_text">
                    <div>
                        <h1>세상에 없던 타겟팅 혁신</h1>
                        <p>기존의 방식은 잊으세요</p>
                        <p><span>DPM9</span>이 혁신을 제공해 드리겠습니다.</p>
                    </div>
                    <div>
                        @guest
                            <button type="button" onClick="location.href='/login'">+ 서비스 바로가기</button>
                        @else
                            <button type="button" onClick="location.href='/carts'">+ 서비스 바로가기</button>
                        @endguest
                    </div>
                </div>
                <div class="banner_img">
                    <img src="/assets/img/main/main_1.png" alt="아이디어 회의하는 이미지">
                </div>
            </div>

            <div class="swiper-slide banner_box_02">
                <div class="banner_text">
                    <div class="title">
                        <h1>광고도 이제 혁신이 필요합니다</h1>
                        <p>약 180여개의 APP 매체에 <br class="mo_br"/>자체 SDK 삽입 <span>2,700만 유저 확보</span></p>
                        <p>해당 APP 유저들의 거주지/성향/<br class="mo_br"/>성별/라이프스타일/방문/빈도수 등 분석</p>
                    </div>
                    <div class="banner_text_sub_wrap">
                        <div class="banner_text_sub_inner">
                            <ul class="form-inline">
                                <li>
                                    <p><span>1</span> 9,000만개 Wi-Fi AP 기반 </p>
                                    <p>DB화 특허 보유</p>
                                </li>
                                <li>
                                    <p><span>2</span>  9,000만개 Bluetooth AP </p>
                                    <p>데이터 보유</p>
                                </li>
                                <li>
                                    <p><span>3</span> 20만개 지하철 </p>
                                    <p>Wi-Fi AP 데이터 보유</p>
                                </li>
                            </ul>
                            <ul class="form-inline">
                                <li>
                                    <p><span>4</span> 500만개 Beacon </p>
                                    <p>기반 유저 분석</p>
                                </li>
                                <li>
                                    <p><span>5</span> 500만 위치 동의 </p>
                                    <p>유저 보유</p>
                                </li>
                                <li>
                                    <p><span>6</span> 공공데이터 및 </p>
                                    <p>결제데이터 보유</p>
                                </li>
                            </ul>
                            <ul class="form-inline">
                                <li>
                                    <p><span>7</span> 상가/상권 200만개 </p>
                                    <p>데이터 보유</p>
                                </li>
                                <li>
                                    <p><span>8</span> 495,000개 2인 이상 </p>
                                    <p>법인기업 국민 연금 데이터 보유</p>
                                </li>
                                <li>
                                    <p><span>9</span> 국내 최대 네비게이션 APP ADID </p>
                                    <p>데이터 제휴 (약 1,500만 유저)</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="banner_img">
                    <img src="/assets/img/main/main_2.png" alt="사다리 올라가는 이미지">
                </div>
            </div>

            <div class="swiper-slide banner_box_03">
                <div class="banner_text">
                    <div class="title">
                        <h1>DMP9은 모두 가능합니다</h1>
                        <p>당신이 생각하지 못한 부분의 세밀한 타겟팅까지 모두 가능합니다!</p>
                    </div>
                    <div class="banner_card">
                        <ul class="form-inline">
                            <li>
                                <div class="card_wrap">
                                    <div class="top form-inline">
                                        <div class="img_box">
                                            <img src="/assets/img/main/img_person_01.png" alt="사람 이미지">
                                        </div>
                                        <div class="text_box">
                                            <p>브랜드 충성고객</p>
                                            <p>APP 타겟팅</p>
                                        </div>
                                    </div>
                                    <div class="middle">
                                        <p>뷰티 어플을 사용하는 사람들에게</p>
                                        <p>광고를 할 수 있을까?</p>
                                    </div>
                                    <div class="close">x</div>
                                </div>
                            </li>
                            <li>
                                <div class="card_wrap">
                                    <div class="top form-inline">
                                        <div class="img_box">
                                            <img src="/assets/img/main/img_person_02.png" alt="사람 이미지">
                                        </div>
                                        <div class="text_box">
                                            <p>특정 업장 방문고객 </p>
                                            <p>위치 타겟팅</p>
                                        </div>
                                    </div>
                                    <div class="middle">
                                        <p>서울 강남구에 있는 성형외과</p>
                                        <p>방문고객에게만 광고를 하고 싶은데..</p>
                                    </div>
                                    <div class="close">x</div>
                                </div>
                            </li>
                            <li>
                                <div class="card_wrap">
                                    <div class="top form-inline">
                                        <div class="img_box">
                                            <img src="/assets/img/main/img_person_03.png" alt="사람 이미지">
                                        </div>
                                        <div class="text_box">
                                            <p>관심사</p>
                                            <p>Bluetooth + 위치 타겟팅</p>
                                        </div>
                                    </div>
                                    <div class="middle">
                                        <p>외제차를 타고 백화점을 자주가는</p>
                                        <p>사람들한테만 광고가 가능할까?</p>
                                    </div>
                                    <div class="close">x</div>
                                </div>
                            </li>
                            <li>
                                <div class="card_wrap">
                                    <div class="top form-inline">
                                        <div class="img_box">
                                            <img src="/assets/img/main/img_person_04.png" alt="사람 이미지">
                                        </div>
                                        <div class="text_box">
                                            <p>지역+취미+성별</p>
                                            <p>AppProfiling + 위치 타겟팅</p>
                                        </div>
                                    </div>
                                    <div class="middle">
                                        <p>서울에 살고, 골프를 좋아하는</p>
                                        <p>남성에게 광고가 되면 딱인데..</p>
                                    </div>
                                    <div class="close">x</div>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <div>
                        @guest
                            <button type="button" onClick="location.href='/login'">+ 서비스 바로가기</button>
                        @else
                            <button type="button" onClick="location.href='/carts'">+ 서비스 바로가기</button>
                        @endguest
                    </div>
                </div>
                <div class="banner_img">
                    <img src="/assets/img/main/main_3.png" alt="하늘을 나는 이미지">
                </div>
            </div>
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <section class="target">
        <div class="target_wrap">
            <div class="text">
                <h2>타겟 가능한 플랫폼</h2>
                <p>DMP9은 아래 모든 <br class="mo_br"/>모바일 광고 플랫폼을 지원합니다.</p>
                <p>다양한 플랫폼에 정교한 타겟팅을 도입하여 <br class="mo_br"/>효과적인 광고를 시작해보세요!</p>
            </div>
            <ul class="icon">
                <li><img src="/assets/img/main/logo_google.png" alt="구글ads 로고"></li>
                <li><img src="/assets/img/main/logo_facebook.png" alt="페이스북 로고"></li>
                <li><img src="/assets/img/main/logo_insta.png" alt="인스타그램 로고"></li>
                <li><img src="/assets/img/main/logo_youtube.png" alt="유튜브 로고"></li>
                <li><img src="/assets/img/main/logo_naver.png" alt="네이버 로고"></li>
                <li><img src="/assets/img/main/logo_kakao.png" alt="카카오광고 로고"></li>
            </ul>
        </div>
    </section>
    <section class="contacts_us">
        <div class="contacts_us_wrap">
            <div class="text">
                <h2>문의하기</h2>
                <p>DMP9에게 문의하실 점이 있다면<br class="mo_br"/> 아래의 양식을 작성해주세요!</p>
            </div>
            <div class="contacts_info clearfix">
                <div class="cont_bg">
                    <div class="title">
                        <p>Contacts Us</p>
                        <p>빅데이터를 통한<br class="mo_br"/> Deep Targeting Platform DMP9</p>
                    </div>
                    <ul class="content">
                        <li>
                            <p><img src="/assets/img/main/icon_headphone.png" alt="헤드폰 아이콘">고객센터</p>
                            <p>070-7798-1644</p>
                        </li>
                        <li>
                            <p><img src="/assets/img/main/icon_mail.png" alt="이메일 아이콘">이메일</p>
                            <p>dmp9@tdi9.com</p>
                        </li>
                        <li>
                            <p><img src="/assets/img/main/icon_address.png" alt="주소 아이콘">서울특별시 서초구</p>
                            <p>반포대로20길 29, TDI타워</p>
                        </li>
                    </ul>
                </div>

                <div class="form_bg">
                    <form>
                        <div class="form_inner">
                            <div class="input-group">
                                <label><img src="/assets/img/main/icon_name.png" alt="이름 아이콘"></label>
                                <input type="text" name="name" placeholder="회사명 / 이름">
                            </div>
                            <div class="input-group">
                                <label><img src="/assets/img/main/icon_phone.png" alt="핸드폰 아이콘"></label>
                                <input type="number" name="phone" placeholder="01012345678">
                            </div>
                            <div class="input-group">
                                <label><img src="/assets/img/main/icon_mail_02.png" alt="이메일 아이콘"></label>
                                <input type="text" name="email" placeholder="이메일 주소">
                            </div>
                            <div class="input-group">
                                <textarea type="text" name="content" placeholder="문의사항"></textarea>
                            </div>
                            <div class="btn_box">
                                <button type="button" id="btn_submit">전송하기</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer_together_wrap">
            <div class="footer_together_inner">
                <div class="text">
                    <h1>함께하기</h1>
                    <p>지금 바로 DMP9를 통해 <br class="mo_br"/>효율적인 데이터 관리를 경험해보세요.</p>
                </div>
                <div class="btn_box">
                    @guest
                        <button type="button" onClick="location.href='/login'"><img src="/assets/img/main/icon_arrow.png" alt="+아이콘"></button>
                    @else
                        <button type="button" onClick="location.href='/carts'"><img src="/assets/img/main/icon_arrow.png" alt="+아이콘"></button>
                    @endguest
                </div>
            </div>
        </div>

        <div class="footer_info_wrap">
            <div class="footer_info_inner clearfix">
                <div class="logo">
                    <a href="/">
                        <img src="/assets/img/main/logo_dmp_02.png" alt="DMP9 로고 (흰색)">
                    </a>
                </div>
                <ul class="text">
                    <li class="form-inline">
                        <p>회사명</p>
                        <p>(주)TDI</p>
                    </li>
                    <li class="form-inline">
                        <p>대표이사</p>
                        <p>이승주</p>
                    </li>
                    <li class="form-inline">
                        <p>사업자번호</p>
                        <p>617-81-95610</p>
                    </li>
                    <li class="form-inline">
                        <p>고객센터</p>
                        <p>070-7853-1644</p>
                    </li>
                    <li class="form-inline">
                        <p>개인정보보호책임자</p>
                        <p>손모아(pf9@tdi9.com)</p>
                    </li>
                    <br/>
                    <li class="form-inline">
                        <p>본사</p>
                        <p>부산 해운대구 우동 1462 센텀그린타워 1302호, 1303호</p>
                    </li>
                    <li class="form-inline">
                        <p>서울지사</p>
                        <p>서울특별시 서초구 반포대로 20길 29, TDI타워</p>
                    </li>
                </ul>
            </div>
            <hr/>
            <div class="copyright">
                Copyright © DMP9. All rights reserved.
            </div>
        </div>
    </footer>
@endsection
