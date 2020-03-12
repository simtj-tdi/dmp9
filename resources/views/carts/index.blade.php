@extends('layouts.backend')

@prepend('scripts')
    $(function() {
        $("input[name=sel]").click(function() {
            var total_count=0;
            var total_price=0;
            $("input[name=sel]:checked").each(function() {
                total_count += $(this).data("count");
                total_price += $(this).data("price");
            });
            $("span[name=total_price]").text(total_price);
        });


        $(".createBtn").click(function() {
            $("form[name='registerForm']").validate({
                rules: {
                    advertiser: "required",
                    "data_types[]": {
                        required: true,
                        minlength: 1
                    },
                    data_target:"required",
                    data_name:"required",
                    data_category:"required",
                },
                messages: {
                },

                errorPlacement: function(error, element){
                },
                highlight: function (element, required) {
                        $(element).css('border', '2px solid #FDADAF');
                },
            });
        });


        $('button[name="orderBtn"], button[name="searchBtn"]').click(function(){
            $('input[name="sort"]').val($(this).attr("data-type"));
            $('[name="frm"]').submit();
        })

        $(".new_buy").click(function() {
            var ids = new Array();
            var total_price=0;
            $("input[name=sel]:checked").each(function() {
                ids.push($(this).val());
                total_price += $(this).data("price");
            });

            if (total_price < 0) {
                console.log("구매 금액이 0원 이상 이여야 합니다.");
            }

            if (ids.length > 0) {
                var data = new Object() ;
                data.ids = ids;
                data.total_price = total_price;
                var jsonData = JSON.stringify(data);
                //console.log(jsonData);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('Payments.payrequest') }}",
                    method: "POST",
                    dataType: "json",
                    data: {'data': jsonData},
                    success: function (data) {
                        if (data['error']) {
                            var JSONArray = JSON.parse(data['error']);
                            alert(JSONArray['message']);
                        } else {
                            var JSONArray = JSON.parse(data['success']);
                            window.open(JSONArray['online_url'],"페이레터","width=800, height=700, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('결제 실패');
                    }
                });
            } else {
                console.log("구매 데이터를 선택 하세요.");
            }
        });

    });
@endprepend

@section('content')
<!-- content : start-->
{{--{{ dd($carts) }}--}}
<div class="container-fluid flex-grow-1 container-p-y mydata_main">

    <form method="get" name="frm" onsubmit="return true" action="{{ route('carts.index') }}" >
        <input type="hidden" name="sort" value="">

        <div class="cont_top_wrap clearfix">
            <div class="cont_search_bar">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" name="sch" placeholder="데이터명 검색" value="">
                        <span class="input-group-append">
                            <button class="btn" name="searchBtn" type="button">
                                <img src="/img/btn_search.png" alt="검색 버튼 이미지"/>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="cont_manu_wrap clearfix">
            <div class="top clearfix"style="display:inline-grid" >
                <button type="button" onclick="addWriting()" class="add_btn">데이터 등록</button> <!--가-->
            </div>
            <div class="top clearfix"style="display:inline-grid" >
                <button type="button" class="add_btn new_buy">구매</button>
            </div>

            <ul class="form-inline">
                <li><button type="button" name="orderBtn" data-type="id" >구매순</button></li>
                <li><button type="button" name="orderBtn" data-type="updated_at" >업데이트순</button></li>
                <li><button type="button" name="orderBtn" data-type="data_name" >데이터순</button></li>
                <li><button type="button" name="orderBtn" data-type="buy_price" >금액순</button></li>
                <li><button type="button" name="orderBtn" data-type="expiration_date" >유효기간순</button></li>
            </ul>
        </div>
    </form>
    <table class="table">
        <colgroup>
            <col width="40px">
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
            <th></th>
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
        @foreach($carts as $cart)
            <tr>
                <td>
                    @if ($cart->state === 3)
                        <input type="checkbox" name="sel" value="{{ $cart->id }}" data-count="{{ $cart->goods->data_count }}" data-price="{{ $cart->goods->buy_price }}">
                    @else
                        <input type="checkbox" name="sel" value="{{ $cart->id }}" disabled>
                    @endif
                </td>
                <td>
                    <div class="status_box">
                    @if ($cart->state === 1)
                        요청중
                    @elseif ($cart->state === 2)
                        추출중
                    @elseif ($cart->state === 3)
                        승인요청
                    @elseif ($cart->state === 4)
                        결제완료
                    @endif
                    </div>
                </td>
                <td>
                    <ul>
                        @foreach(explode(',', $cart->goods->data_types) as $type)
                            @if ($type === 'naver')
                                <li><img src="/img/icon_naver.png" alt="네이버 아이콘"/></li>
                            @elseif ($type === 'instagram')
                                <li><img src="/img/icon_instar.png" alt="인스타 아이콘"/></li>
                            @elseif ($type === 'facebook')
                                <li><img src="/img/icon_facebook.png" alt="페이스북 아이콘"/></li>
                            @elseif ($type === 'kakao')
                                <li><img src="/img/icon_kakao.png" alt="카카오 아이콘"/></li>
                            @endif
                        @endforeach
                    </ul>
                </td>
                <td>{{ $cart->goods->data_name }}</td>
                <td>{{ $cart->goods->data_count }}</td>
                <td>
                    @if (isset($cart->goods->buy_price))
                        {{$cart->mark_price}} 원</td>
                    @endif
                </td>
                <td>{{ $cart->buy_date }}</td>
                <td>{{ $cart->goods->expiration_date }}</td>
                <td>
                    <ul>
                        <li></li>
                        <li><button type="button" onclick="location.href='/contact_us.html'">문의하기 ></button></li>
                    </ul>
                </td>
            </tr>
        @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><span name="total_count">0</span></td>
                <td><span name="total_price">0</span></td>
                <td></td>
                <td></td>
                <td></td> <!--빈영역-->
            </tr>
        </tbody>
    </table>

    <!--추가-->
    <div id="add_writing" class="overlay-wrap alert">
        <div class="writing_wrap">
            <div class="writing_box">
                <form name="registerForm" method="POST" action="{{ route('goods.store') }}">
                    @csrf
                    <div class="inner">
                        <div class="top clearfix">
                            <h1>데이터 요청하기</h1>
                            <button type="button" onclick="addWritingDisNone()"><img src="/img/btn_close.png" alt="닫기 버튼"/></button>
                        </div>
                        <div class="cont">
                            <div class="form-group form-inline">
                                <label>광고주</label>
                                <input type="text" class="form-control  {{ $errors->has('advertiser') ? 'is-invalid' : '' }}" name="advertiser" placeholder="업종 & 광고주명 기입" value="{{ old('title') }}" >
                                @if ($errors->has('advertiser'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('advertiser') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group form-inline">
                                <label>주로 쓰는 플랫폼 유형</label>
                                <div class="checkbox_wrap">
                                    <input type="checkbox" name="data_types[]" value="kakao"> 카카오
                                    <input type="checkbox" name="data_types[]" value="naver"> 네이버
                                    <input type="checkbox" name="data_types[]" value="facebook"> 페이스북
                                    <input type="checkbox" name="data_types[]" value="instagram"> 인스타그램
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label>타겟 유형</label>
                                <div class="target_wrap">
                                    <input type="radio" name="data_target" value="app"> App
                                    <input type="radio" name="data_target" value="local"> 위치
                                    <input type="radio" name="data_target" value="applocal"> App + 위치
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label>데이터 명</label>
                                <input type="text" class="form-control data_input" name="data_name" placeholder="데이터 명 기입">
                            </div>
                            <div class="form-group form-inline">
                                <label>데이터 항목</label>
                                <select class="data_wrap" name="data_category">
                                    <option value=""></option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" placeholder="원하는 타겟 설명" name="data_content"></textarea>
                            </div>
                        </div>

                        <div class="cont_sub">
                            <ul>
                                <li class="mb-2">타겟 구매시 주의사항</li>
                                <li>* 기본 구매 활용 기간은 1개월 입니다.</li>
                                <li>* 데이터 업데이트 요청은 활용기간내에만 가능합니다. (최대 3회 / 구매시점으로부터 1개월 내 가능)</li>
                                <li>* 특정 앱 지정 데이터 판매 불가 (트정 경쟁사 데이터만 구매 요청시 거절 될 수 있습니다.</li>
                                <li>* 불법적 활용 가능한 데이터 판매 불가 (도박, 성인 등)</li>
                            </ul>
                        </div>
                        <div class="btn_box">
{{--                            <button type="submit" onclick="addWritingDisNone()">요청하기</button>--}}
                            <button type="submit"class="createBtn">요청하기</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--추가-->
</div>
<!-- content : end-->
@endsection
