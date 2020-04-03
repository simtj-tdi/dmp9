@prepend('scripts')
    <script>
        function AddComma(num)
        {
            var regexp = /\B(?=(\d{3})+(?!\d))/g;
            return num.toString().replace(regexp, ',');
        }

        /*모바일*/

        $(".mo_explanation_td").click(function(){
            $(this).next(".mo_explanation_box").toggle();
            setTimeout(function() {
                $(".mo_explanation_box").hide();
            },1500);
        });

        /*모바일 데이터 신청 팝업*/
        function moAddData() {
            $("#mo_add_data").css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px").show();
            $('body').css("overflow", "hidden");
        }
        function moAddDataDisNone() {
            $("#mo_add_data").hide();
            $('body').css("overflow", "auto");
        }

        /*모바일 상세보기 팝업*/
        function moDetailData() {
            $("#mo_detail_data").css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px").show();
            $('body').css("overflow", "hidden");
        }
        function moDetailDataDisNone() {
            $("#mo_detail_data").hide();
            $('body').css("overflow", "auto");
        }

        /*모바일 결제방법 선택 팝업*/
        function moRequest() {
            $("#mo_request_data").css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px").show();
            $('body').css("overflow", "hidden");
        }
        function moRequestDisNone() {
            $("#mo_request_data").hide();
            $('body').css("overflow", "auto");
        }

        $("button[name=more]").click(function() {
            var data = new Object();
            data.cart_id = $(this).data("mo_cart");
            var jsonData = JSON.stringify(data);

            $("#order_info_count").text();
            $("#order_info_price").text();
            $("#order_info_request").text();
            $("#order_info_buy_date").text();
            $("#order_info_expiration_date").text();

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('carts.findById') }}",
                method: "POST",
                dataType: "json",
                data: {'data': jsonData},
                success: function (data) {
                    $("#contDiv").empty();
                    var strDiv = "";
                    var JSONArray = JSON.parse(JSON.stringify(data));

                    if (typeof (JSONArray['cart_info'][0]['order_id'][0]) !== "undefined") {
                        $("#order_info_count").text(JSONArray['cart_info'][0]['order_id'][0]['total_count']);
                        $("#order_info_price").text(JSONArray['cart_info'][0]['order_id'][0]['total_price']);
                    }

                    $("#order_info_request").text(JSONArray['cart_info'][0]['goods_id']['data_request']);
                    $("#order_info_buy_date").text(JSONArray['cart_info'][0]['buy_date']);
                    $("#order_info_expiration_date").text(JSONArray['cart_info'][0]['goods_id']['expiration_date']);

                    for(var i=0; i<JSONArray['cart_info'][0]['options_id'].length; i++) {
                        strDiv += "" +
                        "<div class=\"item\">" +
                        "    <div class=\"form-inline\">" +
                        "        <div class=\"input_control form-inline\">" +
                        "            <div class=\"top_title\">" +
                        "                <p>"+JSONArray['platform_info'][JSONArray['cart_info'][0]['options_id'][i]['platform_id']-1]['name'] +"</p>" +
                        "                <button type=\"button\">수정</button>" +
                        "            </div>" +
                        "            <input type=\"text\" class=\"form-control\" value=\""+JSONArray['platform_info'][JSONArray['cart_info'][0]['options_id'][i]['platform_id']-1]['url']+ "\" disabled placeholder=\"URL\">" +
                        "            <input type=\"text\" class=\"form-control id_value_control\" value=\""+JSONArray['cart_info'][0]['options_id'][i]['sns_id']+ "\" placeholder=\"아이디\">" +
                        "            <input type=\"password\" class=\"form-control pw_value_control\" value=\""+JSONArray['cart_info'][0]['options_id'][i]['sns_password']+ "\" placeholder=\"비밀번호\">" +
                        "            <button type=\"button\" class=\"form-control btn_control_02 upload_request\">업로드 요청</button>" +
                        "        </div>" +
                        "    </div>" +
                        "</div>";
                    }
                    $("#contDiv").append(strDiv);


                },
                error: function () {
                    console.log("구매 데이터를 선택 하세요.");
                }
            });
            $("#mo_detail_data").css("top", Math.max(0,  $(window).scrollTop()) + "px").show();
            //$("#mo_detail_data").css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px").show();
            $('body').css("overflow", "hidden");
        });


        $("select[name=mobile_select_data_types]").change(function() {
            //console.log($(this).val());
            var platform_val = $(this).val()-1;

            var data = new Object();
            data.cart_id = $(this).data("mo_cart");
            var jsonData = JSON.stringify(data);

            $("#order_info_count").text();
            $("#order_info_price").text();
            $("#order_info_request").text();
            $("#order_info_buy_date").text();
            $("#order_info_expiration_date").text();

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('carts.findById') }}",
                method: "POST",
                dataType: "json",
                data: {'data': jsonData},
                success: function (data) {
                    $("#contDiv").empty();
                    var strDiv = "";
                    var JSONArray = JSON.parse(JSON.stringify(data));

                    if (typeof (JSONArray['cart_info'][0]['order_id'][0]) !== "undefined") {
                        $("#order_info_count").text(JSONArray['cart_info'][0]['order_id'][0]['total_count']);
                        $("#order_info_price").text(JSONArray['cart_info'][0]['order_id'][0]['total_price']);
                    }

                    $("#order_info_request").text(JSONArray['cart_info'][0]['goods_id']['data_request']);
                    $("#order_info_buy_date").text(JSONArray['cart_info'][0]['buy_date']);
                    $("#order_info_expiration_date").text(JSONArray['cart_info'][0]['goods_id']['expiration_date']);

                    strDiv += "" +
                        "<div class=\"item\">" +
                        "    <div class=\"form-inline\">" +
                        "        <div class=\"input_control form-inline\">" +
                        "            <div class=\"top_title\">" +
                        "                <p>"+JSONArray['platform_info'][platform_val]['name']+"</p>" +
                        "                <button type=\"button\">수정</button>" +
                        "            </div>" +
                        "            <input type=\"text\" class=\"form-control\" value=\""+ JSONArray['platform_info'][platform_val]['url'] + "\" disabled placeholder=\"URL\">" +
                        "            <input type=\"text\" class=\"form-control id_value_control\" value=\"\" placeholder=\"아이디\">" +
                        "            <input type=\"password\" class=\"form-control pw_value_control\" value=\"\" placeholder=\"비밀번호\">" +
                        "            <button type=\"button\" class=\"form-control btn_control_02 upload_request\">업로드 요청</button>" +
                        "        </div>" +
                        "    </div>" +
                        "</div>";


                    for(var i=0; i<JSONArray['cart_info'][0]['options_id'].length; i++) {
                        strDiv += "" +
                            "<div class=\"item\">" +
                            "    <div class=\"form-inline\">" +
                            "        <div class=\"input_control form-inline\">" +
                            "            <div class=\"top_title\">" +
                            "                <p>"+JSONArray['platform_info'][JSONArray['cart_info'][0]['options_id'][i]['platform_id']-1]['name'] +"</p>" +
                            "                <button type=\"button\">수정</button>" +
                            "            </div>" +
                            "            <input type=\"text\" class=\"form-control\" value=\""+JSONArray['platform_info'][JSONArray['cart_info'][0]['options_id'][i]['platform_id']-1]['url']+ "\" disabled placeholder=\"URL\">" +
                            "            <input type=\"text\" class=\"form-control id_value_control\" value=\""+JSONArray['cart_info'][0]['options_id'][i]['sns_id']+ "\" placeholder=\"아이디\">" +
                            "            <input type=\"password\" class=\"form-control pw_value_control\" value=\""+JSONArray['cart_info'][0]['options_id'][i]['sns_password']+ "\" placeholder=\"비밀번호\">" +
                            "            <button type=\"button\" class=\"form-control btn_control_02 upload_request\">업로드 요청</button>" +
                            "        </div>" +
                            "    </div>" +
                            "</div>";
                    }
                    $("#contDiv").append(strDiv);
                },
                error: function () {
                    console.log("구매 데이터를 선택 하세요.");
                }
            });
            console.log($(this).outerHeight());
            $("#mo_detail_data").css("top", Math.max(0,  $(window).scrollTop()) + "px").show();
            $('body').css("overflow", "hidden");
        });


        $('#mobile_registerForm button[name=btn]').click(function() {
            if ($("#mobile_registerForm input[name=advertiser]").val() == "") {
                alert('광고주를 입력하세요.');
                return false;
            }

            if ($("#mobile_registerForm input:radio[name=data_target]").is(":checked") == false) {
                alert('타겟 유형을 선택하세요.');
                return false;
            }

            if ($("#mobile_registerForm input[name=data_name]").val() == "") {
                alert('데이터 명을 입력하세요.');
                return false;
            }

            if ($("#mobile_registerForm input[name=data_request]").val() == "") {
                alert('데이터 업로드 횟수를 입력하세요.');
                return false;
            }

            $('#mobile_registerForm').submit();
        });

        $("[id^='mo_Check_']").click(function() {
            var total_int=0;
            var total_count=0;
            var total_price=0;
            $("[id^='mo_Check_']:checked").each(function() {
                total_int += 1;
                total_count += $(this).data("mo_count");
                total_price += $(this).data("mo_price");
            });
            $("span[name=mobile_total_int]").text(total_int);
            $("span[name=mobile_total_count]").text(AddComma(total_count));
            $("span[name=mobile_total_price]").text(AddComma(total_price));
        });

        $(".mobile_new_buy").click(function() {
            var ids = new Array();
            var total_count=0;
            var total_price=0;
            $("[id^='mo_Check_']:checked").each(function() {
                ids.push($(this).val());
                total_count += $(this).data("mo_count");
                total_price += $(this).data("mo_price");
            });

            if (total_price <= 0) {
                alert("구매 금액이 0원 이상 이여야 합니다.");
                return false;
            }

            $("#mo_request_data").css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px").show();
            $('body').css("overflow", "hidden");
        });

        $("#mobile_new_payment").click(function() {

            if (typeof($('[name="mobile_radio"]:checked').val()) == "undefined") {
                alert('결제 유형을 선택 해주세요.');
                return false;
            }

            $("#mo_request_data").hide();
            $('body').css("overflow", "auto");

            var ids = new Array();
            var total_count=0;
            var total_price=0;
            $("[id^='mo_Check_']:checked").each(function() {
                ids.push($(this).val());
                total_count += $(this).data("mo_count");
                total_price += $(this).data("mo_price");
            });

            if (total_price <= 0) {
                alert("구매 금액이 0원 이상 이여야 합니다.");
                return false;
            }

            if (ids.length > 0) {
                var data = new Object() ;
                data.pgcode = $('[name="mobile_radio"]:checked').val();
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
    </script>

@endprepend
<div class="container-fluid flex-grow-1 container-p-y data_up_load_mo">
    <div class="wrap">
        <div class="top clearfix">
            <p>마이데이터</p>
            <span class="txt">부정적 데이터 활용시(여러회사 공동 사용) <br/>계정이 중지되거나 법적 제재를 받으실 수 있습니다.</span>
            <button type="button" onclick="moAddData()">데이터 신청</button>
        </div>
        <div class="cont">

            <div class="sum_wrap">
                <ul>
                    <li class="form-inline">
                        <div>선택한 데이터 개수</div>
                        <div><span name="mobile_total_int">0</span></div>
                    </li>
                    <li class="form-inline">
                        <div>선택한 데이터 총 개수</div>
                        <div><span name="mobile_total_count">0</span></div>
                    </li>
                    <li class="form-inline">
                        <div>선택한 데이터 총 금액</div>
                        <div><span name="mobile_total_price">0</span>원</div>
                    </li>
                </ul>
                <button type="button" class="btn_request mobile_new_buy" >선택 데이터 구매</button>
            </div>

            @foreach($carts as $cart)
            <div class="card_wrap">
                <div class="card_inner">
                    <div class="cont_top form-inline">
                        <span class="checkbox">
                            @if (isset($cart->goods->buy_price) && $cart->state == 2)
                                <input type="checkbox" name="check" id="mo_Check_{{ $cart->id }}" value="{{ $cart->id }}" data-mo_count="{{ $cart->goods->data_count }}" data-mo_price="{{ $cart->goods->buy_price }}" />
                            @else
                                <input type="checkbox" name="" value="{{ $cart->id }}" disabled>
                            @endif
                            <label for="mo_Check_{{ $cart->id }}"></label>
                        </span>
                        <div>{{ $cart->goods->advertiser }}</div>
                        <div>
                            <button type="button" name="more" data-mo_cart="{{ $cart->id }}" >
                                <img src="/assets/img/common/mo_icon_dot.png" alt="모바일 더보기 아이콘"/>
                            </button>
                        </div>
                    </div>
                    <div class="cont">
                        <div>{{ $cart->goods->data_name }}</div>
                        <!-- <div class="icon_black">결제완료 <img src="../assets/img/icon_explanation_01.png" alt="아이콘 설명"/></div> -->
                    </div>

                    @if ($cart->state === 1)
                        <div class="cont mo_explanation icon_black">
                            결제완료
                            <img src="../assets/img/icon_explanation_01.png" class="mo_explanation_td " alt="아이콘 설명">
                            <div class="mo_explanation_box" style="display: none;">
                                <p>신청하신 데이터의 추출 가능 여부를 확인중입니다.</p>
                            </div>
                        </div>

                    @elseif ($cart->state === 2)
                        <div class="cont mo_explanation icon_yellow">
                            결제완료
                            <img src="../assets/img/icon_explanation_02.png" class="mo_explanation_td " alt="아이콘 설명">
                            <div class="mo_explanation_box" style="display: none;">
                                <p>구매가 완료된 데이터입니다. 선택 후 업로드 요청을 눌러주세요.</p>
                            </div>
                        </div>

                    @elseif ($cart->state === 3)
                        <div class="cont mo_explanation icon_green">
                            결제완료
                            <img src="../assets/img/icon_explanation_03.png" class="mo_explanation_td " alt="아이콘 설명">
                            <div class="mo_explanation_box" style="display: none;">
                                <p>구매가 완료된 데이터입니다. 선택 후 업로드 요청을 눌러주세요.</p>
                            </div>
                        </div>
                    @elseif ($cart->state === 4)
                        <div class="cont mo_explanation icon_yellow">
                            결제완료
                            <img src="../assets/img/icon_explanation_02.png" class="mo_explanation_td " alt="아이콘 설명">
                            <div class="mo_explanation_box" style="display: none;">
                                <p>요청하신 데이터가 추출중이며 시간소요는 영업일 기준 1-3일 소요 됩니다.</p>
                            </div>
                        </div>

                    @elseif ($cart->state === 5)
                        <div class="cont mo_explanation icon_black">
                            결제완료
                            <img src="../assets/img/icon_explanation_01.png" class="mo_explanation_td " alt="아이콘 설명">
                            <div class="mo_explanation_box" style="display: none;">
                                <p>데이터 추출이 완료되었습니다. 구매 후 광고플랫폼에 업로드 요청이 가능합니다.</p>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="cont_select">
                    @if ($cart->state != 5)
                        <button type="button">선택</button>
                    @else
                        <select class="select_control" name="mobile_select_data_types" data-mo_request="{{ $cart->goods->data_request }}" data-mo_goods="{{ $cart->goods_id }}" data-mo_cart="{{ $cart->id }}" data-mo_tr="td_{{ $cart->id }}" {{ $cart->state != 5 ? 'disabled' : '' }}>
                            <option value="">선택</option>
                            @foreach($platforms as $platform)
                                <option value="{{ $platform['platform_id'] }}">{{ $platform['name'] }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!--모바일 데이터 신청 팝업-->
    <div id="mo_add_data" class="add_data overlay-wrap alert">
        <div class="writing_wrap">
            <div class="writing_box">
                <div class="inner">
                    <form name="mobile_registerForm" method="POST" action="{{ route('goods.store') }}">
                        @csrf
                        <div class="top clearfix">
                            <h1>데이터 요청하기</h1>
                            <button type="button" onclick="moAddDataDisNone()"><img src="../assets/img/btn_close.png" alt="닫기 버튼"/></button>
                        </div>
                        <div class="cont">
                            <div class="input-group">
                                <label>광고주</label>
                                <input type="text" class="cont_form_control" name="advertiser" placeholder="업종 & 광고주명을 입력해주세요." />
                            </div>
                            <div class="form-group form-inline">
                                <label>타겟 유형</label>

                                <div class="target_wrap form-inline">
                                    <div class="target_radio">
                                        <input type="radio" name="data_target" id="mo_radio" value="app" />
                                        <label for="mo_radio">App</label>
                                    </div>
                                    <div class="target_radio">
                                        <input type="radio" name="data_target" id="mo_radio1" value="local" />
                                        <label for="mo_radio1">위치</label>
                                    </div>
                                    <div class="target_radio">
                                        <input type="radio" name="data_target" id="mo_radio2" value="applocal" />
                                        <label for="mo_radio2">App + 위치</label>
                                    </div>
                                    <div class="target_radio">
                                        <input type="radio" name="data_target" id="mo_radio3" value="none" />
                                        <label for="mo_radio3">유형없음</label>
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
                                <p>4회 이상의 횟수는 별도 문의 바랍니다.</p>
                            </div>

                            <div class="form-group">
                                <label>설명</label>
                                <textarea class="cont_form_control" style="resize: none;" name="data_content" placeholder="원하는 타겟을 설명해주세요." ></textarea>
                            </div>
                            <div class="cont_sub">
                                <ul>
                                    <li class="mb-2">타겟 구매시 주의사항</li>
                                    <li>- 기본 구매 활용 기간은 1개월 입니다.</li>
                                    <li>- 데이터 결제 완료 후 환불은 불가합니다.</li>
                                    <li>- 특정 앱 지정 데이터 판매 불가<br/> (특정 경쟁사 데이터만 구매 요청시 거절 될 수 있습니다.)</li>
                                    <li>- 불법적 활용 가능한 데이터 판매 불가 (도박, 성인 등)</li>
                                </ul>
                            </div>
                            <div class="btn_box">
                                <button type="submit" class="createBtn">요청하기</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--모바일 상세보기 팝업-->
    <div id="mo_detail_data" class="mo_detail_data overlay-wrap alert">
        <div class="writing_wrap">
            <div class="writing_box">
                <div class="inner">
                    <div class="top clearfix">
                        <div class="form-inline">
                            <p>추출수</p>
                            <p id="order_info_count"></p>
                        </div>
                        <div class="form-inline">
                            <p>구매가격</p>
                            <p><span id="order_info_price"></span>원</p>
                        </div>
                        <div class="form-inline">
                            <p>요청횟수</p>
                            <p><span id="order_info_request"></span>회</p>
                        </div>
                        <div class="form-inline detail_date">
                            <h5>구매일 <span id="order_info_buy_date"></span></h5>
                            <h5>유효기간 <span id="order_info_expiration_date"></span></h5>
                        </div>
                        <button type="button" onclick="moDetailDataDisNone()"><img src="../assets/img/btn_close.png" alt="닫기 버튼"/></button>
                    </div>
                    <div class="cont" id="contDiv">

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--모바일 결제방법 선택 팝업-->
    <div id="mo_request_data" class="request_data overlay-wrap alert">
        <div class="writing_wrap">
            <div class="writing_box">
                <div class="inner">
                    <div class="cont">
                        <div class="form_box">
                            <div class="close">
                                <button type="button" onclick="moRequestDisNone()">
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
                                    <li class="form-inline">
                                        <span class="mo_radio1">
                                            <input type="radio" name="mobile_radio" id="radio7" value="creditcard" />
                                            <label for="radio7"></label>
                                        </span>
                                        <span class="txt">
                                            <p>신용카드</p>
                                        </span>
                                    </li>
                                    <li class="form-inline">
                                        <span class="mo_radio2">
                                            <input type="radio" name="mobile_radio" id="radio8" value="virtualaccount" />
                                            <label for="radio8"></label>
                                        </span>
                                        <span class="txt">
                                            <p>무통장 입금</p>
                                        </span>
                                    </li>
                                </ul>
                                <div class="but_box mt-4">
                                    <button type="button" id="mobile_new_payment">다음</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
