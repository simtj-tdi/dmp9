<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" href="http://fs9.co.kr/img/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="http://fs9.co.kr/img/favicon.png">
    <meta name="naver-site-verification" content="9e35cebb2b99ff47a2482b4fe59114c9d697f57e"/>
    <!--theme-->
    <meta name="theme-color" content="#1b1b1b">
    <!--ios theme-->
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!--안드로이드 홈화면 추가시 상단 주소창 제거-->
    <meta name="mobile-web-app-capable" content="yes">
    <!--ios 홈 화면 추가시 상단 주소창 제거-->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- hybrid app 을 위한 매니페스트-->
    <!--<link rel="manifest" href="/json/manifest.json">-->
    <!--babel-->
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <link rel="shortcut icon" href="/img/favicon.ico" />
    <!--바로가기 아이콘 설정-->
    <link rel="shortcut icon" href="/img/favicon.ico"/>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <!-- font css-->
    <link rel="stylesheet" href="/css/nanumsquare.css">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- 페이스샵 9 레이아웃 css -->
    <link rel="stylesheet" href="/css/layout.css?v=20180619">
    <!-- 페이스샵 9  텍스트 css -->
    <link rel="stylesheet" href="/css/text.css?v=20180619">
    <!-- 페이스샵 9 메인 css -->
    <link rel="stylesheet" href="/css/mainStyle.css?v=20180619">
    <!--문의하기 css-->
    <link rel="stylesheet" href="/css/popupLayer.css?v=20180619">
    <!--bootrtrap js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!--easing js -->
    <script src="/js/jquery-ui.min.js"></script>
    <!-- request js -->
    <script src="/js/request.js?v=20180619" type="text/javascript"></script>
    <!-- common js -->
    <script src="/js/common.js?v=20180619" type="text/javascript"></script>
    <script src="/js/layout.js?v=20180619" type="text/javascript"></script>
    <!-- Vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <!--axios js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <!--layer popup js-->
    <script src="/js/layerpopup.js?v=20180619" type="text/babel"></script>
    <!--account js -->
    <script src="/js/accountInfo.js?v=20180619" type="text/javascript"></script>
    <!--mobile common js-->
    <!--네이티브로-->
    <!--<script src="/js/mobileCommon.js"></script>-->
    <script>
        //인터넷 버전 체크 ie 에서는 호환안됨
        // Internet Explorer 6-11
        var isIE = /*@cc_on!@*/false || !!document.documentMode;

        if(isIE) {
            if (confirm("인터넷 익스플로러에서는 정상 작동이 안될 수 있으므로 크롬 브라우저 사용을 권장합니다. 크롬 브라우저를 다운로드 하시겠습니까?")) {
                location.href = 'https://www.google.co.kr/chrome/index.html'
            }
        }
    </script>
    <!--datepicker js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
    <script src="https://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
    <script src="https://cdn.rawgit.com/alrusdi/jquery-plugin-query-object/master/jquery.query-object.js"></script>

</head>

<body>

<section class="wrap">
    <div class="fs-layout">
        <div class="fs-layout-center">
            <div class="fs-layout-center-contents">
                <div>
                    <div class="fs-main-layout">
                        <div class="fs-main-layout_logo">
                            <div class="fs-menu-icon">
                                <span class="fs-menu"></span>
                                <span class="fs-menu"></span>
                                <span class="fs-menu"></span>
                            </div>
                            <div class="fs-logo dark_color">
                                <div class="fs-logo-img">
                                    <div>
                                        <img src="/img/logo.png" onclick="location.href='/market'">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fs-main-layout-top-nav">
                            <div class="fs-top-nav-left">

                            </div>
                            <dlv class="fs-top-nav-right">
                                <div class="fs-top-nav-item-wrapper">
                                    <div class="fs-top-nav_userInfo"><span>NSMG 님</span></div>
                                </div>
                                <div class="fs-top-nav-logout">
                                    <div class="fs-mypage-icon">
                                        <img src="/img/personal.png" alt="마이페이지">
                                    </div>
                                </div>
                            </dlv>
                            <div class="fs-account-info-box">
                                <span class="fs-account-info-title">NSMG 님 안녕하세요!</span>
                                <span class="fs-account-info-name"  >담당자</span>
                                <input type="text" value=" 김은주" class="fs-account-info" readonly>

                                <span class="fs-account-info-name">이메일</span>
                                <input type="text" value="eunju@nsmg21.com" class="fs-account-info" readonly>

                                <span class="fs-account-info-name">연락처</span>
                                <input type="text" value="01096058111" class="fs-account-info" readonly>

                                <div class="fs-change-info">
                                    <a href="/mypage/confirm">내정보 수정</a>

                                    <a  href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </div>
                        </div>

                        <div class="fs-main-layout-left-nav dark_color fs-nav-web fs-nav-mobile">
                            <div class="fs-left-nav_box">
                                <div class="fs-mb-nav-box">
                                    <a href="/market" class="fs-left-nav-link ">
                                        <div class="fs-left-nav-item">
                                            <div class="fs-account-icon"><img src="/img/fs-market.png"></div>
                                            <div class="fs-account-menu">마켓</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="fs-mb-nav-box">
                                    <a href="/mydate" class="fs-left-nav-link ">
                                        <div class="fs-left-nav-item">
                                            <div class="fs-account-icon"><img src="/img/fs-buy.png"></div>
                                            <div class="fs-account-menu">마이 데이터</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="fs-mb-nav-box fs-mb-my">
                                    <div class="fs-left-nav-link myPageCon  fsMenuActive " >
                                        <div class="fs-left-nav-item " >
                                            <div class="fs-account-icon"><img src="/img/myPage.png"></div>
                                            <div class="fs-account-menu">마이 페이지</div>
                                        </div>
                                        <ul class="fsMypageMenu">
                                            <li class="fsMypage"><a href="/mypage/faq" class="">자주 묻는 질문</a></li>
                                            <li class="fsMypage"><a href="/mypage/qna" class="">문의 및 답변</a></li>

                                            <li class="fsMypage"><a href="/mypage/confirm" class="">내정보 수정</a></li>
                                            <li class="fsMypage"><a href="/mypage" class=" faMenuOn ">충전 내역</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="fs-left-nav-setting">
                                <div class="fs-setting-head">
                                    <div>
                                        <div class="fs-setting">
                                            <a href="/img/term.pdf" class=" footerInfo" target="_blank">
                                                <div class="fs-qna fs-setting-inner">
                                                    이용약관                        </div>
                                            </a>
                                            <a href="/img/public.pdf" class="footerInfo" target="_blank">
                                                <div class="fs-qna fs-setting-inner ">
                                                    개인정보처리방침
                                                </div>
                                            </a>
                                            <a href="/account/mypage/faq" class="footerInfo fs-mb-foot">
                                                <div class="fs-qna fs-setting-inner ">
                                                    자주묻는질문
                                                </div>
                                            </a>
                                            <a href="/charge/history" class="footerInfo fs-mb-foot">
                                                <div class="fs-qna fs-setting-inner ">
                                                    충전내역
                                                </div>
                                            </a>
                                            <a href="#" class="footerInfo fs-mb-foot tax_showMask">
                                                <div class="fs-qna fs-setting-inner ">
                                                    세금계산서 요청
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="fs-layout-opacity-box"></div>-->


                        <div class="fs-main-layout-content gray_color">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

</body>

</html>
