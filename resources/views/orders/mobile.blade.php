@prepend('scripts')
    <script>
        /*모바일 상세보기 팝업*/
        function moDetailData() {
            $("#mo_detail_data").show();
        }
        function moDetailDataDisNone() {
            $("#mo_detail_data").hide();
        }

        $("button[name=mobile_btn]").click(function() {
            var data = new Object();
            data.order_id = $(this).data("order_id");
            var jsonData = JSON.stringify(data);

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('orders.findById') }}",
                method: "POST",
                dataType: "json",
                data: {'data': jsonData},
                success: function (data) {
                    $("#contDiv").empty();
                    var strDiv = "";
                    var strTarget = "";
                    var JSONArray = JSON.parse(JSON.stringify(data));

                    $("#order_no").text(JSONArray['order_info'][0]['order_no']);
                    $("#order_name").text(JSONArray['order_info'][0]['order_name']);
                    $("#total_price").text(JSONArray['order_info'][0]['total_price']);
                    $("#created_at").text(JSONArray['order_info'][0]['created_at']);

                    for(var i=0; i<JSON.parse(JSONArray['order_info'][0]['goods_info']).length; i++) {
                        if (JSON.parse(JSONArray['order_info'][0]['goods_info'])[i]['data_target']=="app") {
                            strTarget = "App";
                        } else if (JSON.parse(JSONArray['order_info'][0]['goods_info'])[i]['data_target']=="local") {
                            strTarget = "위치";
                        } else if (JSON.parse(JSONArray['order_info'][0]['goods_info'])[i]['data_target']=="applocal") {
                            strTarget = "App + 위치";
                        } else if (JSON.parse(JSONArray['order_info'][0]['goods_info'])[i]['data_target']=="none") {
                            strTarget = "유형없음";
                        }

                        strDiv += "" +
                            "<div class=\"item\">" +
                            "    <div class=\"detail_data\">" +
                            "        <div class=\"form-inline\">" +
                            "            <p>광고주</p>" +
                            "            <p>"+JSON.parse(JSONArray['order_info'][0]['goods_info'])[i]['advertiser']+"</p>" +
                            "        </div>" +
                            "        <div class=\"form-inline\">" +
                            "            <p>타겟유형</p>" +
                            "            <p>" + strTarget + "</p>" +
                            "            </div>" +
                            "            <div class=\"form-inline\">" +
                            "            <p>데이터명</p>" +
                            "            <p>"+JSON.parse(JSONArray['order_info'][0]['goods_info'])[i]['data_name']+"</p>" +
                            "        </div>" +
                            "        <div class=\"form-inline\">" +
                            "            <p>데이터 추출수</p>" +
                            "            <p>"+JSON.parse(JSONArray['order_info'][0]['goods_info'])[i]['data_count']+"</p>" +
                            "        </div>" +
                            "        <div class=\"form-inline\">" +
                            "        <p>유효기간</p>" +
                            "        <p>"+JSON.parse(JSONArray['order_info'][0]['goods_info'])[i]['expiration_date']+"</p>" +
                            "        </div>" +
                            "    </div>" +
                            "</div>";
                    }

                    $("#contDiv").append(strDiv);
                    $("#mo_detail_data").show();
                },
                error: function () {

                }
            });
        });

    </script>

@endprepend
<div class="container-fluid flex-grow-1 container-p-y payment_history_mo">
    <div class="wrap">
        <div class="top clearfix">
            <p>결제 내역</p>
            <span class="txt">사업자 정보 수정은 <br/>관리자 승인 후 변경 가능합니다.</span>
            <button type="button">{{ $txt }} 요청</button>
        </div>
        <div class="cont">
            <div class="cont_title">
                <p>결제내역</p>
            </div>
            <div class="card_wrap">
                @foreach($orders as $order)
                <div class="card_inner">
                    <div class="cont_top form-inline">
                        <span class="checkbox">
                            <input type="checkbox" name="check" id="mo_Check_{{$order['order_no']}}" />
                            <label for="mo_Check_{{$order['order_no']}}"></label>
                        </span>
                        <div class="form-inline">
                            <p>주문번호</p>
                            <p>{{$order['order_no']}}</p>
                        </div>
                    </div>
                    <div class="cont">
                        <div class="form-inline">
                            <p>구매내역</p>
                            <p>{{$order['order_name']}}</p>
                        </div>
                        <div>
                            @if ($order['tax_state'] === 1)
                                <p>미발행</p>
                            @elseif ($order['tax_state'] === 2)
                                <p>확인중</p>
                            @elseif ($order['tax_state'] === 3)
                                <p>발행</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="cont_btn">
                    <button type="button" class="btn_request" name="mobile_btn" data-order_id="{{ $order['order_id'] }}" >자세히보기</button>
                </div>
                @endforeach
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
                            <p>주문번호</p>
                            <p id="order_no">1123123123</p>
                        </div>
                        <div class="form-inline">
                            <p>구매내역</p>
                            <p id="order_name">구매내역 테스트 외 1건</p>
                        </div>
                        <div class="form-inline">
                            <p>구매가격</p>
                            <p id="total_price">20,000원</p>
                        </div>
                        <div class="form-inline detail_date mt-2">
                            <h5>구매일 <span id="created_at">2020-03-19</span></h5>
                            <h5>결제방식 - 신용카드</h5>
                        </div>
                        <button type="button" onclick="moDetailDataDisNone()"><img src="../assets/img/btn_close.png" alt="닫기 버튼"/></button>
                    </div>
                    <div class="cont" id="contDiv">


                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
