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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/appwork.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme-corporate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contents.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sign_up/sign.css') }}">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

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

@yield('content')


<script src="{{ asset('js/layout-helpers.js') }}"></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/sidenav.js') }}"></script>
<script src="{{ asset('js/swiper.js') }}"></script>
<script src="{{ asset('js/function.js') }}"></script>
<script src="{{ asset('js/sign_up.js') }}"></script>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    @stack('scripts')
</body>

</html>
