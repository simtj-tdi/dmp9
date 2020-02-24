@extends('layouts.backend')

@section('content')
<!-- content : start-->
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="cont_top_wrap clearfix">
        <div class="cont_select">
            <select name="" class="">
                <option value="" selected="selected">전체 광고주 데이터 <i class="ion ion-ios-arrow-down d-block"></i></option>
                <option value="">광고형태 데이터</option>
                <option value="">데이터수 데이터</option>
                <option value="">구매가격 데이터</option>
                <option value="">구매일 데이터</option>
            </select>
        </div>

        <div class="cont_search_bar">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="데이터명 검색">
                    <span class="input-group-append">
                        <button class="btn" type="button">
                            <img src="/img/btn_search.png" alt="검색 버튼 이미지"/>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="cont_manu_wrap clearfix">
        <ul class="form-inline">
            <li><button type="button">구매순</button></li>
            <li><button type="button">업데이트순</button></li>
            <li><button type="button">데이터순</button></li>
            <li><button type="button">금액순</button></li>
            <li><button type="button">유효기간순</button></li>
        </ul>
    </div>

    <table class="table">
        <colgroup>
            <col width="40px">
            <col width="60px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="75px">
        </colgroup>
        <thead class="thead-light">
        <tr>
            <th>상태</th>
            <th>광고형태</th>
            <th>데이터명</th>
            <th>데이터수</th>
            <th>구매가격</th>
            <th>구매일</th>
            <th>유효기간</th>
            <th></th> <!--빈영역-->
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <img src="/img/img_waiting.png" alt="결제 대기중"/>
            </td>
            <td>
                <ul>
                    <li><img src="/img/icon_naver.png" alt="네이버 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                    <li><img src="/img/icon_facebook.png" alt="페이스북 아이콘"/></li>
                    <li><img src="/img/icon_kakao.png" alt="카카오 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                </ul>
            </td>
            <td>퀵배달</td>
            <td>15,423</td>
            <td>46,269원</td>
            <td>2020-02-12</td>
            <td>2020-03-12</td>
            <td>
                <ul>
                    <li><button type="button">결제하기 ></button></li>
                    <li><button type="button" onclick="location.href='/contact_us.html'">문의하기 ></button></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <img src="/img/img_upload.png" alt="타겟 업로드"/>
            </td>
            <td>
                <ul>
                    <li><img src="/img/icon_naver.png" alt="네이버 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                    <li><img src="/img/icon_facebook.png" alt="페이스북 아이콘"/></li>
                    <li><img src="/img/icon_kakao.png" alt="카카오 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                </ul>
            </td>
            <td>퀵배달</td>
            <td>15,423</td>
            <td>46,269원</td>
            <td>2020-02-12</td>
            <td>2020-03-12</td>
            <td>
                <ul>
                    <li><button type="button">결제하기 ></button></li>
                    <li><button type="button" onclick="location.href='/contact_us.html'">문의하기 ></button></li>
                </ul>
            </td>
        </tr>
        <tr class="expiration"> <!--기간만료 일때 class-->
            <td>
                <img src="/img/img_upload.png" alt="타겟 업로드"/>
            </td>
            <td>
                <ul>
                    <li><img src="/img/icon_naver.png" alt="네이버 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                    <li><img src="/img/icon_facebook.png" alt="페이스북 아이콘"/></li>
                    <li><img src="/img/icon_kakao.png" alt="카카오 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                </ul>
            </td>
            <td>퀵배달</td>
            <td>15,423</td>
            <td>46,269원</td>
            <td>2020-02-12</td>
            <td>2020-03-12</td>
            <td>
                <ul>
                    <li><button type="button">결제하기 ></button></li>
                    <li><button type="button" onclick="location.href='/contact_us.html'">문의하기 ></button></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <img src="/img/img_waiting.png" alt="결제 대기중"/>
            </td>
            <td>
                <ul>
                    <li><img src="/img/icon_naver.png" alt="네이버 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                    <li><img src="/img/icon_facebook.png" alt="페이스북 아이콘"/></li>
                    <li><img src="/img/icon_kakao.png" alt="카카오 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                </ul>
            </td>
            <td>퀵배달</td>
            <td>15,423</td>
            <td>46,269원</td>
            <td>2020-02-12</td>
            <td>2020-03-12</td>
            <td>
                <ul>
                    <li><button type="button">결제하기 ></button></li>
                    <li><button type="button" onclick="location.href='/contact_us.html'">문의하기 ></button></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <img src="/img/img_waiting.png" alt="결제 대기중"/>
            </td>
            <td>
                <ul>
                    <li><img src="/img/icon_naver.png" alt="네이버 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                    <li><img src="/img/icon_facebook.png" alt="페이스북 아이콘"/></li>
                    <li><img src="/img/icon_kakao.png" alt="카카오 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                </ul>
            </td>
            <td>퀵배달</td>
            <td>15,423</td>
            <td>46,269원</td>
            <td>2020-02-12</td>
            <td>2020-03-12</td>
            <td>
                <ul>
                    <li><button type="button">결제하기 ></button></li>
                    <li><button type="button" onclick="location.href='/contact_us.html'">문의하기 ></button></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <img src="/img/img_waiting.png" alt="결제 대기중"/>
            </td>
            <td>
                <ul>
                    <li><img src="/img/icon_naver.png" alt="네이버 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                    <li><img src="/img/icon_facebook.png" alt="페이스북 아이콘"/></li>
                    <li><img src="/img/icon_kakao.png" alt="카카오 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                </ul>
            </td>
            <td>퀵배달</td>
            <td>15,423</td>
            <td>46,269원</td>
            <td>2020-02-12</td>
            <td>2020-03-12</td>
            <td>
                <ul>
                    <li><button type="button">결제하기 ></button></li>
                    <li><button type="button" onclick="location.href='/contact_us.html'">문의하기 ></button></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <img src="/img/img_waiting.png" alt="결제 대기중"/>
            </td>
            <td>
                <ul>
                    <li><img src="/img/icon_naver.png" alt="네이버 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                    <li><img src="/img/icon_facebook.png" alt="페이스북 아이콘"/></li>
                    <li><img src="/img/icon_kakao.png" alt="카카오 아이콘"/></li>
                    <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                </ul>
            </td>
            <td>퀵배달</td>
            <td>15,423</td>
            <td>46,269원</td>
            <td>2020-02-12</td>
            <td>2020-03-12</td>
            <td>
                <ul>
                    <li><button type="button">결제하기 ></button></li>
                    <li><button type="button" onclick="location.href='/contact_us.html'">문의하기 ></button></li>
                </ul>
            </td>
        </tr>


        </tbody>
    </table>
</div>
<!-- content : end-->
@endsection
