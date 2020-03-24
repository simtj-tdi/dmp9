<!DOCTYPE html>

<html lang="ko" class="default-style">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DMP9</title>

    <!-- Main font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900"
          rel="stylesheet">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/appwork.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme-corporate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contents.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sign_up/sign.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/data_up_load/data_up_load.css') }}">


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
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-1">
    <!-- Layout inner -->
    <div class="layout-inner">

        <!-- Layout navbar -->
        <nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-navbar-theme container-p-x" id="layout-navbar">

            <!-- Sidenav toggle -->
            <div class="layout-sidenav-toggle navbar-nav align-items-lg-center mr-auto mr-lg-4">
                <a class="nav-item nav-link px-0 ml-2" href="javascript:void(0)">
                    <i class="text-large align-middle">menu</i>
                </a>
            </div>
        </nav>
        <!-- / Layout navbar -->

        <div class="layout-container">

            <!-- Layout sidenav -->
            <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-sidenav-theme">
                <div class="sidenav_logo_wrap">
                    <a href="/carts">
                        <img src="assets/img/common/logo_dmp_01.png" alt="로고 이미지" />
                    </a>
                </div>

                <div class="sidenav_total_balance_Wrap">
                    <div class="sidenav_total_balance_inner_cont form-inline">
                        <div class="img">
                            <!--<img src="/assets/img/common/test.jpg" alt=""/>-->
                        </div>
                        <div class="text">
                            <p>{{ \Illuminate\Support\Facades\Auth::user()->user_id }}</p>
                            <p>{{ \Illuminate\Support\Facades\Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="sidenav_total_balance_inner_top form-inline">
                        <div class="login_btn_box dropdown" data-toggle="dropdown">
                            <button type="button" class="dropdown-toggle">
                                로그인정보
                            </button>
                            <div class="dropdown-menu">
                                <div><p>M</p></div>
                                <div>{{ \Illuminate\Support\Facades\Auth::user()->name }}</div>
                                <div>{{ \Illuminate\Support\Facades\Auth::user()->email }}</div>

                                <div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        로그아웃
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">로그아웃</button>
                        </div>
                    </div>
                </div>


                <ul class="sidenav-inner">
                    <li class="sidenav-item {{ class_basename(Route::current()->controller) == "CartController" ? 'active' : '' }} ">
                        <a href="/carts" class="sidenav-link">
                            <div class="icon">
                                <img src="assets/img/common/icon_sidenav_01.png" alt="마이 데이터 아이콘" />
                            </div>
                            <div>마이 데이터</div>
                        </a>
                    </li>
                    <li class="sidenav-item {{ class_basename(Route::current()->controller) == "FaqController" ? 'active' : '' }} ">
                        <a href="/faqs" class="sidenav-link">
                            <div class="icon">
                                <img src="assets/img/common/icon_sidenav_02.png" alt="자주 묻는 질문 아이콘" />
                            </div>
                            <div>자주 묻는 질문</div>
                        </a>
                    </li>
                    <li class="sidenav-item {{ class_basename(Route::current()->controller) == "QuestionController" ? 'active' : '' }} ">
                        <a href="/questions" class="sidenav-link">
                            <div class="icon">
                                <img src="assets/img/common/icon_sidenav_03.png" alt="문의 및 답변 아이콘" />
                            </div>
                            <div>문의 및 답변</div>
                        </a>
                    </li>
                    <li class="sidenav-item {{ class_basename(Route::current()->controller) == "OrderController" ? 'active' : '' }} ">
                        <a href="/history" class="sidenav-link">
                            <div class="icon">
                                <img src="assets/img/common/icon_sidenav_04.png" alt="세금계산서 요청 아이콘" />
                            </div>
                            <div>세금계산서 요청</div>
                        </a>
                    </li>
                    <li class="sidenav-item {{ class_basename(Route::current()->controller) == "UserController" ? 'active' : '' }} ">
                        <a href="/users" class="sidenav-link">
                            <div class="icon">
                                <img src="assets/img/common/icon_sidenav_05.png" alt="내정보 수정 아이콘" />
                            </div>
                            <div>내정보 수정</div>
                        </a>
                    </li>
                </ul>
                <ul class="sidenav_bottom form-inline">
                    <li>이용약관</li>
                    <li>개인정보처리방침</li>
                </ul>
            </div>
            <!-- / Layout sidenav -->



            <!-- content : start-->

                @yield('content')

            <!-- content : end-->



        </div>
    </div>
</div>
<!-- Layout inner -->

<div class="layout-overlay layout-sidenav-toggle"></div>
</div>
<!-- / Layout wrapper -->
<!-- / Layout wrapper -->
<script src="{{ asset('assets/js/layout-helpers.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/sidenav.js') }}"></script>
<script src="{{ asset('assets/js/swiper.js') }}"></script>
<script src="{{ asset('assets/js/function.js') }}"></script>
<script src="{{ asset('assets/js/sign_up/sign_up.js') }}"></script>
@stack('scripts')
<script>
    /*질문하기,문의하기 ul 클릭 토글*/
    $(".toggle_tr").on('click', function(){
        $(this).parent().next('tr').toggle();
    });

    $(".explanation_td").hover(function(){
        $(this).children(".explanation_box").toggle();
    });

    /* 모두체크 */
    $('#all_checkbox').on("change", function(){
        var checked = $(this).prop('checked'); // checked 문자열 참조(true, false)
        $('input[name="check"]').prop('checked', checked);
    });

    $('input[name="check"]').change(function () {
        var boxLength = $('input[name="check"]').length;
        // 체크된 체크박스 갯수를 확인하기 위해 :checked 필터를 사용하여 체크박스만 선택한 후 length 프로퍼티를 확인
        var checkedLength = $('input[name="check"]:checked').length;
        var selectAll = (boxLength == checkedLength);

        $('#all_checkbox').prop('checked', selectAll);
    });

    /*데이터 요청 글쓰기 클릭 모달*/
    function addRequestData() {
        $("#request_data").show();
    }
    function addRequestDataDisNone() {
        $("#request_data").hide();
    }
    /*데이터 등록 글쓰기 클릭 모달*/
    function addData() {
        $("#add_data").show();
    }
    function addDataDisNone() {
        $("#add_data").hide();
    }
</script>
</body>

</html>
