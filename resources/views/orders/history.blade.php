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
                <tr class="toggle_dropdown_tr">
                    <td colspan="6">
                        {{$order['goods_info']}}
                        <div class="form-inline">
                            <div class="form-inline">
                                <p class="form-control label_control"></p>
                                <p class="form-control"></p>
                            </div>

                            <div class="input_control form-inline">
                                <label class="form-control login_control">아이디</label>
                                <input type="text" class="form-control value_control" name="sns_id" value="">
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- content : end-->

@endsection
