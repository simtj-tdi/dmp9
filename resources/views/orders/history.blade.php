@extends('layouts.backend')

@prepend('scripts')

@endprepend

@section('content')
    <!-- content : start-->
    <div class="container-fluid flex-grow-1 container-p-y data_up_load">
        <div class="table_wrap">
            <table class="table">
                <colgroup>
                    <col width="10px">
                    <col width="20px">
                    <col width="20px">
                    <col width="20px">
                    <col width="20px">
                    <col width="20px">
                </colgroup>
                <thead>
                <tr>
                    <th>주문번호</th>
                    <th>구매내역</th>
                    <th>구매날짜</th>
                    <th>구매가격</th>
                    <th>결제방식</th>
                    <th>계산서<br/>발행여부</th>
                </tr>
                </thead>
                <tbody>
                <!--묶음-->
                @foreach($orders as $order)
                <tr>
                    <td class="toggle_tr">{{$order['order_no']}}</td>
                    <td>{{$order['order_name']}}</td>
                    <td>{{$order['updated_at']}}</td>
                    <td>{{$order['total_price']}}</td>
                    <td></td>
                    <td>{{$order['tax_state']}}</td>
                </tr>
                <tr class="toggle_dropdown_tr" >
                    <td colspan="6">
                        <table class="table">
                            <colgroup>
                                <col width="150px">
                                <col width="150px">
                                <col width="150px">
                                <col width="150px">
                                <col width="150px">
                                <col width="150px">
                                <col width="150px">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>광고주</th>
                                <th>타겟 유형</th>
                                <th>데이터 명</th>
                                <th>데이터 항목</th>
                                <th>데이터<br/>추출수</th>
                                <th>구매가격</th>
                                <th>유효기간</th>
                            </tr>
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
                                    {{ $goods->data_target }}
                                </td>
                                <td>{{ $goods->data_name }}</td>
                                <td>{{ $goods->data_category }}</td>
                                <td>{{ $goods->data_count }}</td>
                                <td>{{ $goods->buy_price }}</td>
                                <td>{{ $goods->expiration_date }}</td>
                            </tr>
                            @endforeach
                            </thead>
                        </table>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- content : end-->

@endsection
