@extends('layouts.backend')

@prepend('scripts')

@endprepend

@section('content')
    <!-- content : start-->
    <div class="container-fluid flex-grow-1 container-p-y mydata_main">

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
                <th>날짜</th>
                <th>구매내역</th>
                <th>가격</th>
                <th>계산서발행여부</th>
                <th>결제방식</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                @if (!is_null($order['payment']))
                <tr>
                    <td>{{$order['buy_date']}}</td>
                    <td>{{$order['data_name']}}</td>
                    <td>{{$order->mark_price}} 원</td>
                    <td></td>
                    <td>{{$order['payment']['pgcode']}}</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- content : end-->
@endsection
