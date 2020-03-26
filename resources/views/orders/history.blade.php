@extends('layouts.backend')

@prepend('scripts')
    <script>

        $(function() {

            {{--$("[name=tax_request]").click(function() {--}}

            {{--    var data = new Object() ;--}}
            {{--    data.order_id = $(this).data("order_id");--}}
            {{--    var jsonData = JSON.stringify(data);--}}

            {{--    $.ajax({--}}
            {{--        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
            {{--        url: "{{ route('tax_state') }}",--}}
            {{--        method: "POST",--}}
            {{--        dataType: "json",--}}
            {{--        data: {'data': jsonData},--}}
            {{--        success: function (data) {--}}
            {{--            var JSONArray = JSON.parse(JSON.stringify(data));--}}

            {{--            if (JSONArray['result'] == "success") {--}}
            {{--                alert('계산서신청이 되었습니다.');--}}
            {{--                location.reload();--}}
            {{--            } else if (JSONArray['result'] == "error") {--}}
            {{--                alert(JSONArray['error_message']);--}}
            {{--            };--}}
            {{--        },--}}
            {{--        error: function () {--}}
            {{--            alert("Error while getting results");--}}
            {{--        }--}}
            {{--    });--}}

            {{--});--}}

            $("[name=btn]").click(function() {
                var data = new Object() ;
                var ids = new Array();

                $("input[name='check']:checked").each(function() {
                    ids.push($(this).val());
                });

                data.ids = ids;
                var jsonData = JSON.stringify(data);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('tax_state') }}",
                    method: "POST",
                    dataType: "json",
                    data: {'data': jsonData},
                    success: function (data) {
                        alert('계산서신청이 되었습니다.');
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert("Error while getting results");
                    }
                });
            });

        });
    </script>

@endprepend

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y payment_history">
        <div class="top">
            결제 내역
{{--            <button type="button" onclick="addRequestData()">세금계산서 요청</button>--}}
            <button type="button" name="btn">세금계산서 요청</button>
        </div>

        <div class="table_wrap">
            <table class="table">
                <colgroup>
                    <col width="10px">
                    <col width="20px">
                    <col width="20px">
                    <col width="30px">
                    <col width="20px">
                    <col width="20px">
                    <col width="20px">
                    <col width="8px">
                </colgroup>
                <thead>
                <tr>
                    <th>
                        <span class="checkbox">
                            <input type="checkbox" id="all_checkbox" />
                            <label for="all_checkbox"></label>
                        </span>
                    </th>
                    <th>주문번호</th>
                    <th>구매내역</th>
                    <th>구매날짜</th>
                    <th>구매가격</th>
                    <th>결제방식</th>
                    <th>계산서 발행여부</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="toggle_tr historytr">
                        <td>
                        <span class="checkbox">
                            <input type="checkbox" name="check" id="Check_{{$order['order_id']}}" value="{{$order['order_id']}}" />
                            <label for="Check_{{$order['order_id']}}"></label>
                        </span>
                        </td>
                        <td>{{$order['order_no']}}</td>
                        <td>{{$order['order_name']}}</td>
                        <td>{{$order['created_at']}}</td>
                        <td>{{ number_format($order['total_price']) }}</td>
                        <td>신용카드</td>
                        <td>
                            @if ($order['tax_state'] === 1)
                               미발행
                            @elseif ($order['tax_state'] === 2)
                               확인중
                            @elseif ($order['tax_state'] === 3)
                               발행
                            @endif
                        </td>
                        <td class="toggle_tr"><img src="../assets/img/icon_down_arrow.png" alt="아이콘 아래 화살표"/></td>
                    </tr>
                    <tr class="toggle_dropdown_tr">
                        <td colspan="8">
                            <table>
                                <colgroup>
                                    <col width="20px">
                                    <col width="20px">
                                    <col width="20px">
                                    <col width="20px">
                                    <col width="20px">
                                    <col width="20px">
                                    <col width="20px">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>광고주</th>
                                    <th>타겟유형</th>
                                    <th>데이터명</th>
                                    <th>데이터 항목</th>
                                    <th>데이터 추출수</th>
                                    <th>구매가격</th>
                                    <th>유효기간</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!--묶음-->
                                @foreach(json_decode($order['goods_info']) as $goods)
                                    <tr>
                                        <td>{{ $goods->advertiser }}</td>
                                        <td>
                                            @if ($goods->data_target === "app")
                                                App
                                            @elseif ($goods->data_target === "local")
                                                위치
                                            @elseif ($goods->data_target === "applocal")
                                                App + 위치
                                            @elseif ($goods->data_target === "none")
                                                유형없음
                                            @endif
                                        </td>
                                        <td>{{ $goods->data_name }}</td>
                                        <td>{{ $goods->data_category }}</td>
                                        <td>{{ $goods->data_count }}</td>
                                        <td>{{ number_format($goods->buy_price) }}</td>
                                        <td>{{ $goods->expiration_date}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>

        <div id="request_data" class="request_data overlay-wrap alert">
            <div class="writing_wrap">
                <div class="writing_box">
                    <div class="inner">
                        <div class="cont">
                            <p>세금계산서 요청이 완료 되었습니다.</p>
                        </div>
                        <div class="btn_box">
                            <button type="button" onclick="addRequestDataDisNone()">확인</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


@endsection
