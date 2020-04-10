@extends('layouts.backend')

@prepend('scripts')
    <script>
        function AddComma(num)
        {
            var regexp = /\B(?=(\d{3})+(?!\d))/g;
            return num.toString().replace(regexp, ',');
        }

        $(function() {

            $("body").delegate("[name=sns_save]", "click", function(){

                if ($(this).parent().parent().find("input[name=sns_id]").val() == "") {
                    alert('아이디를 입력 하세요.');
                    return
                }

                if ($(this).parent().parent().find("input[name=sns_password]").val() == "") {
                    alert('패스워드를 입력 하세요.');
                    return
                }

                var data = new Object();
                var cart_id = $(this).data("cart_id");
                data.option_id = $(this).data("option_id");
                data.platform_id = $(this).data("platform_id");
                data.cart_id = $(this).data("cart_id");
                data.sns_id = $(this).parent().parent().find("input[name=sns_id]").val();
                data.sns_password = $(this).parent().parent().find("input[name=sns_password]").val();
                var jsonData = JSON.stringify(data);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('Option.save') }}",
                    method: "POST",
                    dataType: "json",
                    data: {'data': jsonData},
                    success: function (data) {
                        var JSONArray = JSON.parse(JSON.stringify(data));

                        if (JSONArray['result'] == "success") {
                            alert('등록 되었습니다.');
                            location.href = window.location.pathname+"?currentTr="+cart_id;
                        } else if (JSONArray['result'] == "error") {
                            alert(JSONArray['error_message']);
                        };
                    },
                    error: function () {
                        alert("Error while getting results");
                    }
                });


            });



            $("body").delegate("[name=sns_modify]", "click", function(){
                $(this).parent().parent().find("[name=sns_id]").attr('disabled', false);
                $(this).parent().parent().find("[name=sns_id]").css('background-color', '#fff');
                $(this).parent().parent().find("[name=sns_password]").attr('disabled', false);
                $(this).parent().parent().find("[name=sns_password]").css('background-color', '#fff');
                $(this).parent().parent().find("button[name=sns_modify]").css('display', 'none');
                $(this).parent().parent().find("button[name=sns_save]").css('display', 'block');
            });

            $("body").delegate("[name=sns_request]", "click", function(){
                if ($(this).parent().parent().find("input[name=sns_id]").val() == "") {
                    alert('아이디를 입력 하세요.');
                    return
                }

                if ($(this).parent().parent().find("input[name=sns_password]").val() == "") {
                    alert('패스워드를 입력 하세요.');
                    return
                }

                if (!$(this).data("option_id")) {
                    alert('아이디, 패스워드를 저장 후 데이터 요청이 가능합니다.');
                }

                var data = new Object();
                var cart_id = $(this).data("cart");
                data.option_id = $(this).data("option_id");
                var jsonData = JSON.stringify(data);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('Option.updateload') }}",
                    method: "POST",
                    dataType: "json",
                    data: {'data': jsonData},
                    success: function (data) {
                        var JSONArray = JSON.parse(JSON.stringify(data));

                        if (JSONArray['result'] == "success") {
                            alert('업로드 요청 되었습니다.');
                            //location.reload();
                            location.href = window.location.pathname+"?currentTr="+cart_id;
                        } else if (JSONArray['result'] == "error") {
                            alert(JSONArray['error_message']);
                        };
                    },
                    error: function () {
                        alert("Error while getting results");
                    }
                });
            });


            $("select[name=select_data_types]").change(function() {
                var data = new Object();
                var select_data = $(this);
                var select_tr = $(this).data("tr");
                var cart_id = $(this).data("cart");
                data.goods_id = $(this).data("goods");
                data.cart_id = $(this).data("cart");
                data.platform_id = $(this).val();

                var jsonData = JSON.stringify(data);

                if ($(this).val()) {

                    if ($("td[name="+select_tr+"] > div").length+1 > $(this).data("request")) {
                        alert($(this).data("request")+'회 까지 요청 할 수 있습니다.');
                        return false;
                    }

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{{ route('Option.add') }}",
                        method: "POST",
                        dataType: "json",
                        data: {'data': jsonData},
                        success: function (data) {
                            var JSONArray = JSON.parse(JSON.stringify(data));

                            if (JSONArray['result'] == "success") {
                                select_data.parent().parent().next('tr').show();
                                $("td[name="+select_tr+"]").prepend("" +
                                    "<div class=\"item mb-2\">" +
                                    "    <div class=\"form-inline\">" +
                                    "        <div class=\"input_control form-inline\">" +
                                    "            <label class=\"form-control label_control\">"+JSONArray['platform_info']['name']+"</label>" +
                                    "            <input type=\"text\" class=\"form-control\" readonly value=\""+JSONArray['platform_info']['url']+"\" placeholder=\"URL\">" +
                                    "            <input type=\"text\" class=\"form-control id_value_control\" name=\"sns_id\" value=\"\" placeholder=\"아이디\">" +
                                    "            <input type=\"password\" class=\"form-control pw_value_control\" name=\"sns_password\"  value=\"\" placeholder=\"비밀번호\">" +
                                    "            <button type=\"button\" class=\"form-control btn_control_01 btn_green \"  name=\'sns_save\'  data-option_id=\"\" data-cart_id=\""+cart_id+"\" data-platform_id=\""+JSONArray['platform_info']['id']+"\">저장</button>" +
                                    "            <button type=\"button\" class=\"form-control btn_control_02 upload_request\" name=\"sns_request\">데이터 요청</button>" +
                                    "        </div>" +
                                    "    </div>" +
                                    "</div>"
                                );
                            } else if (JSONArray['result'] == "error") {
                                alert(JSONArray['error_message']);
                            };
                        },
                        error: function () {
                            alert("Error while getting results");
                        }
                    });
                }
            });

            $("[id^='Check_']").click(function() {
                var total_int=0;
                var total_count=0;
                var total_price=0;
                $("[id^='Check_']:checked").each(function() {
                    total_int += 1;
                    total_count += $(this).data("count");
                    total_price += $(this).data("price");
                });
                $("div[name=total_int]").text(total_int);
                $("div[name=total_count]").text(AddComma(total_count));
                $("div[name=total_price]").text(AddComma(total_price));
            });

            $('#registerForm button[name=btn]').click(function() {

                if ($("#registerForm input[name=advertiser]").val() == "") {
                    alert('광고주를 입력하세요.');
                    return false;
                }

                if ($("#registerForm input:radio[name=data_target]").is(":checked") == false) {
                    alert('타겟 유형을 선택하세요.');
                    return false;
                }

                if ($("#registerForm input[name=data_name]").val() == "") {
                    alert('데이터 명을 입력하세요.');
                    return false;
                }

                if ($("#registerForm input[name=data_request]").val() == "") {
                    alert('데이터 업로드 횟수를 입력하세요.');
                    return false;
                }

                $('#registerForm').submit();
            });

            $('button[name="orderBtn"], button[name="searchBtn"]').click(function(){
                $('input[name="sort"]').val($(this).attr("data-type"));
                $('[name="frm"]').submit();
            })

            $(".new_buy").click(function() {
                var ids = new Array();
                var total_count=0;
                var total_price=0;
                $("[id^='Check_']:checked").each(function() {
                    ids.push($(this).val());
                    total_count += $(this).data("count");
                    total_price += $(this).data("price");
                });

                if (total_price <= 0) {
                    alert("구매 금액이 0원 이상 이여야 합니다.");
                    return false;
                }

                $("#request_data").css("top", Math.max(0,  $(window).scrollTop()) + "px").show();
                $('body').css("overflow", "hidden");
            });

            $("#new_payment").click(function() {

                if (typeof($('[name="radio"]:checked').val()) == "undefined") {
                    alert('결제 유형을 선택 해주세요.');
                    return false;
                }

                $("#request_data").hide();

                var ids = new Array();
                var total_count=0;
                var total_price=0;
                $("[id^='Check_']:checked").each(function() {
                    ids.push($(this).val());
                    total_count += $(this).data("count");
                    total_price += $(this).data("price");
                });

                if (total_price <= 0) {
                    alert("구매 금액이 0원 이상 이여야 합니다.");
                    return false;
                }

                if (ids.length > 0) {
                    var data = new Object() ;
                    data.pgcode = $('[name="radio"]:checked').val();
                    data.ids = ids;
                    data.total_count = total_count;
                    data.total_price = total_price;
                    var jsonData = JSON.stringify(data);

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{{ route('Payments.payrequest') }}",
                        method: "POST",
                        dataType: "json",
                        data: {'data': jsonData},
                        success: function (data) {
                            if (data['error']) {
                                alert(data['message']);
                            } else {
                                var JSONArray = JSON.parse(data['success']);
                                window.open(JSONArray['online_url'],"페이레터","width=800, height=700, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('결제 실패');
                        }
                    });
                } else {
                    console.log("구매 데이터를 선택 하세요.");
                }
            });

        });
    </script>

@endprepend

@section('content')

    <!-- content : start-->
    <div class="container-fluid flex-grow-1 container-p-y data_up_load">
        <div class="top">
            마이데이터
            <span class="txt">부정적 데이터 활용시(여러회사 공동 사용) 계정이 중지되거나 법적 제재를 받으실 수 있습니다.</span>
            <button type="button" onclick="addData()">데이터 신청</button>
        </div>
        <div class="sum_wrap">
            <ul class="form-inline">
                <li class="form-inline">
                    <div>선택한 데이터 개수</div>
                    <div name="total_int">0</div>
                </li>
                <li class="form-inline">
                    <div>선택한 데이터 총 개수</div>
                    <div name="total_count">0</div>
                </li>
                <li class="form-inline">
                    <div>선택한 데이터 총 금액</div>
                    <div name="total_price">0원</div>
                </li>
                <li>
                    <button type="button" class="form-control btn_purchase new_buy">선택된 데이터 구매</button>
                    <!--<button type="button" class="form-control btn_request" onclick="addRequestData()">구매한 데이터 업로드 요청</button>-->
                </li>
                <!-- <li></li> -->

            </ul>
        </div>

        <table class="tables">
            <table class="table">
                <colgroup>
                    <col width="8px">
                    <col width="23px">
                    <col width="32px">
                    <col width="23px">
                    <col width="20px">
                    <col width="22px">
                    <col width="22px">
                    <col width="15px">
                    <col width="25px">
                    <col width="23px">
                    <col width="7px">
                </colgroup>
                <thead>
                <tr>
                    <th>
                        <span class="checkbox">
                            <input type="checkbox" id="all_checkbox" />
                            <label for="all_checkbox"></label>
                        </span>
                    </th>
                    <th>광고주</th>
                    <th>데이터명</th>
                    <th>데이터수</th>
                    <th>구매가격</th>
                    <th>구매일</th>
                    <th>유효기간</th>
                    <th>요청횟수</th>
                    <th>대상 플랫폼</th>
                    <th>상태</th>
                    <th></th>
                </tr>
                </thead>
            </table>

        <div class="table_wrap">

            <table class="table">
                <colgroup>
                    <col width="8px">
                    <col width="23px">
                    <col width="32px">
                    <col width="23px">
                    <col width="20px">
                    <col width="22px">
                    <col width="22px">
                    <col width="15px">
                    <col width="25px">
                    <col width="23px">
                    <col width="7px">
                </colgroup>

                <tbody>
                <!--묶음-->
                @foreach($carts as $cart)
                <tr>
                    <td>
                        <span class="checkbox">
                            @if (isset($cart->goods->buy_price) && $cart->state == 2)
                                <input type="checkbox" name="check" id="Check_{{ $cart->id }}" value="{{ $cart->id }}" data-count="{{ $cart->goods->data_count }}" data-price="{{ $cart->goods->buy_price }}">
                            @else
                                <input type="checkbox" name="" value="{{ $cart->id }}" disabled>
                            @endif

                            <label for="Check_{{ $cart->id }}"></label>
                        </span>
                    </td>
                    <td>{{ $cart->goods->advertiser }}</td>
                    <td>{{ $cart->goods->data_name }}</td>
                    <td>{{ number_format($cart->goods->data_count) }}</td>
                    <td>
                        @if (isset($cart->goods->buy_price))
                            {{$cart->mark_price}}
                        @else
                        0
                        @endif원
                    </td>
                    <td>{{ $cart->buy_date }}</td>
                    <td>{{ $cart->goods->expiration_date }}</td>
                    <td>
                        @if ($cart->options->count() > 0)
                            {{ $cart->options->count() }}/{{ $cart->goods->data_request }}회
                        @else
                            {{ $cart->goods->data_request }}회
                        @endif
                    </td>
                    <td>
                        <select class="select_control" name="select_data_types" data-request="{{ $cart->goods->data_request }}" data-goods="{{ $cart->goods_id }}" data-cart="{{ $cart->id }}" data-tr="td_{{ $cart->id }}" {{ $cart->state != 5 ? 'disabled' : '' }}>
                            <option value="">선택</option>
                            @foreach($platforms as $platform)
                                <option value="{{ $platform['platform_id'] }}">{{ $platform['name'] }}</option>
                            @endforeach
                        </select>
                    </td>

                    @if ($cart->state === 1)
                        <td  class="explanation_td icon_black">
                            확인중
                            <img src="../assets/img/icon_explanation_01.png" alt="아이콘 설명"/>
                            <div class="explanation_box">
                                <p>신청하신 데이터의 추출 가능 여부를 확인중입니다.</p>
                            </div>
                        </td>
                    @elseif ($cart->state === 2)
                        <td  class="explanation_td icon_yellow">
                            결제대기
                            <img src="../assets/img/icon_explanation_02.png" alt="아이콘 설명"/>
                            <div class="explanation_box">
                                <p>구매가 완료된 데이터입니다. 선택 후 업로드 요청을 눌러주세요.</p>
                            </div>
                        </td>
                    @elseif ($cart->state === 3)
                        <td  class="explanation_td icon_green">
                            결제완료
                            <img src="../assets/img/icon_explanation_03.png" alt="아이콘 설명"/>
                            <div class="explanation_box">
                                <p>구매가 완료된 데이터입니다. 선택 후 업로드 요청을 눌러주세요.</p>
                            </div>
                        </td>
                    @elseif ($cart->state === 4)
                        <td  class="explanation_td icon_yellow">
                            추출중
                            <img src="../assets/img/icon_explanation_02.png" alt="아이콘 설명"/>
                            <div class="explanation_box">
                                <p>요청하신 데이터가 추출중이며 시간소요는 영업일 기준 1-3일 소요 됩니다.</p>
                            </div>
                        </td>
                    @elseif ($cart->state === 5)
                        <td  class="explanation_td icon_black">
                            추출완료
                            <img src="../assets/img/icon_explanation_01.png" alt="아이콘 설명"/>
                            <div class="explanation_box">
                                <p>데이터 추출이 완료되었습니다. 구매 후 광고플랫폼에 업로드 요청이 가능합니다.</p>
                            </div>
                        </td>
                    @endif
                    <td class="toggle_tr"><img src="../assets/img/icon_down_arrow.png" alt="아이콘 아래 화살표"/></td>
                </tr>
                <tr class="toggle_dropdown_tr" @if ($cart->id == Request::get('currentTr')) {!! "style=\"display:table-row;\"" !!} @else {!! "style=\"display:none;\"" !!} @endif  >
                    <td colspan="11" name="td_{{ $cart->id }}"  >
                    @if (!$cart->options->isEmpty())
                        @foreach($cart->options as $option)
                        <div class="item mb-2">
                            <div class="form-inline">
                                <div class="input_control form-inline">
                                    <label class="form-control label_control">{{$option->platform['name']}}</label>
                                    <input type="text" class="form-control" value="{{$option->platform['url']}}" disabled placeholder="URL">
                                    <input type="text" class="form-control id_value_control" name="sns_id" style="background: #e8e8e9" disabled value="{{$option->sns_id}}" placeholder="아이디">
                                    <input type="password" class="form-control pw_value_control" name="sns_password" style="background: #e8e8e9" disabled  value="{{$option->sns_password}}" placeholder="비밀번호">
                                    <button type="button" class="form-control btn_control_01" name='sns_modify' >수정</button>
                                    <button type="button" class="form-control btn_control_01 btn_green" name='sns_save' style="display:none;" data-option_id="{{$option->id}}" data-cart_id="{{$option->cart_id}}" data-platform_id="{{$option->platform_id}}">저장</button>
                                    @if ($option->state == "1")
                                        <button type="button" class="form-control btn_control_02 upload_request" name='sns_request' data-cart="{{ $cart->id }}" data-option_id="{{$option->id}}">데이터 요청</button>
                                    @elseif ($option->state == "2")
                                        <button type="button" class="form-control btn_control_02 upload_wait">업로드중</button>
                                        <div class="explanation_td expiration_div ml-2">
                                            <img src="../assets/img/icon_explanation_04.png" alt="아이콘 설명"/>
                                            <div class="explanation_box">
                                                <p>구매하신 데이터를 플랫폼에 업로드 중 입니다.</p>
                                            </div>
                                        </div>
                                    @elseif ($option->state == "3")
                                        <button type="button" class="form-control btn_control_02 upload_complete">업로드 완료</button>
                                        <div class="explanation_td expiration_div ml-2">
                                            <img src="../assets/img/icon_explanation_04.png" alt="아이콘 설명"/>
                                            <div class="explanation_box">
                                                <p>업로드가 완료되었습니다. 플랫폼 내에서 확인하세요.</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    </td>
                </tr>
                @endforeach
                <!--묶음-->

                @if ($carts->isEmpty())
                    <tr>
                        <td colspan="11">
                            <div class="no_data">
                                <img src="https://image.flaticon.com/icons/svg/87/87980.svg"/>
                                <p>내역이 없습니다.</p>
                            </div>
                        </td>
                    </tr>
                @endif

                </tbody>
            </table>
        </div>

{{--        <div id="request_data_finish" class="request_data overlay-wrap alert">--}}
{{--            <div class="writing_wrap">--}}
{{--                <div class="writing_box">--}}
{{--                    <div class="inner">--}}
{{--                        <div class="top clearfix">--}}
{{--                            <h1>신청하신 데이터 결과는 마이데이터 페이지에서 확인 가능합니다.</h1>--}}
{{--                        </div>--}}
{{--                        <div class="cont">--}}
{{--                            <p>- 영업일 기준 1~3일 소요됩니다.</p>--}}
{{--                            <p>- 데이터 추출이 불가능한 경우, 로그인 이메일주소로 결과를 전송 해 드립니다.</p>--}}
{{--                        </div>--}}
{{--                        <div class="btn_box">--}}
{{--                            <button type="button" onclick="addRequestDataDisNone()">확인</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div id="request_data" class="request_data overlay-wrap alert">
            <div class="writing_wrap">
                <div class="writing_box">
                    <div class="inner">
                        <div class="cont">
                            <div class="layout-container payment_choice">
                                <div class="payment_choice_inner">
                                    <div class="form_box">
                                        <div class="close">
                                            <button type="button" onclick="addRequestDataDisNone()">
                                                <img src="/assets/img/btn_close.png" alt="닫기 버튼">
                                            </button>
                                        </div>
                                        <span class="form_ico">
                                                  <img src="../assets/img/sign_up/ico_etc.png" alt="" />
                                                </span>
                                        <div class="input_box">
                                            <p class="desc">
                                                결제유형을 선택해주세요.
                                            </p>
                                            <ul>
                                                <li>
                                                      <span class="radio1">
                                                        <input type="radio" name="radio" id="radio5" value="creditcard" />
                                                        <label for="radio5"></label>
                                                      </span>
                                                    <span class="txt">
                                                        <label for="radio5">
                                                            <p>신용카드</p>
                                                        </label>
                                                      </span>
                                                </li>
                                                <li>
                                                      <span class="radio2">
                                                        <input type="radio" name="radio" id="radio6" value="virtualaccount" />
                                                        <label for="radio6"></label>
                                                      </span>
                                                    <span class="txt">
                                                        <label for="radio6">
                                                            <p>무통장 입금</p>
                                                        </label>
                                                      </span>
                                                </li>
                                            </ul>
                                            <div class="but_box mt-4 mb-4">
                                                <button type="button" id="new_payment">다음</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="add_data" class="add_data overlay-wrap alert">
            <div class="writing_wrap">
                <div class="writing_box">

                    <div class="inner">
                        <div class="top clearfix">
                            <h1>데이터 요청하기</h1>
                            <button type="button" onclick="addDataDisNone()"><img src="../assets/img/btn_close.png" alt="닫기 버튼"/></button>
                        </div>
                        <form id="registerForm" method="POST" action="{{ route('goods.store') }}">
                            @csrf
                        <div class="cont">
                            <div class="input-group">
                                <label>광고주</label>
                                <input type="text" class="cont_form_control" name="advertiser"  placeholder="업종 & 광고주명을 입력해주세요." />
                            </div>
                            <div class="form-group form-inline">
                                <label>타겟 유형</label>

                                <div class="target_wrap form-inline">
                                    <div class="target_radio">
                                        <input type="radio" name="data_target" id="radio" value="app" />
                                        <label for="radio">App</label>
                                    </div>
                                    <div class="target_radio">
                                        <input type="radio" name="data_target" id="radio1" value="local" />
                                        <label for="radio1">위치</label>
                                    </div>
                                    <div class="target_radio">
                                        <input type="radio" name="data_target" id="radio2" value="applocal" />
                                        <label for="radio2">App + 위치</label>
                                    </div>
                                    <div class="target_radio">
                                        <input type="radio" name="data_target" id="radio3" value="none" />
                                        <label for="radio3">유형없음</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label>데이터 명</label>
                                <input type="text" class="cont_form_control data_input" name="data_name" placeholder="데이터 명을 입력해주세요.">
                            </div>
                            <div class="form-group form-inline">
                                <label>데이터 업로드 횟수</label>
                                <input type="text" class="cont_form_control data_input upload_input" name="data_request" value="3" readonly>
                                <p class="ml-2">4회 이상의 횟수는 별도 문의 바랍니다.</p>
                            </div>
{{--                            <div class="form-group form-inline">--}}
{{--                                <label>데이터 항목</label>--}}
{{--                                <select class="cont_form_control data_input" name="data_category">--}}
{{--                                    <option value="">항목</option>--}}
{{--                                    <option value="A">A</option>--}}
{{--                                    <option value="B">B</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label>설명</label>
                                <textarea class="cont_form_control" style="resize: none;" name="data_content" placeholder="원하는 타겟을 설명해주세요." ></textarea>
                            </div>
                        </div>
                        <div class="cont_sub">
                            <ul>
                                <li class="mb-2">타겟 구매시 주의사항</li>
                                <li>- 기본 구매 활용 기간은 1개월 입니다.</li>
                                <li>- 데이터 결제 완료 후 환불은 불가합니다.</li>
{{--                                <li>- 데이터 업데이트 요청은 활용기간내에만 가능합니다. (최대 3회 / 구매시점으로부터 1개월 내 가능)</li>--}}
                                <li>- 특정 앱 지정 데이터 판매 불가 (트정 경쟁사 데이터만 구매 요청시 거절 될 수 있습니다.</li>
                                <li>- 불법적 활용 가능한 데이터 판매 불가 (도박, 성인 등)</li>
                            </ul>
                        </div>
                        <div class="btn_box">
                            <button type="button" class="createBtn" name="btn"  >요청하기</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content : end-->

@include('carts.mobile')

@endsection
