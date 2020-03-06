@extends('layouts.backend')

@prepend('scripts')
    $(function() {
        $(".checkBtn").click(function(){
            var object = new Array();
            var tr = $(this).parent().parent().parent().parent();
            var td = tr.children();
            var product_id = tr.find("input[type=hidden]").val();

            object.push(product_id);
            object.push(td.eq(3).text());
            object.push(td.eq(4).text());
            object.push(td.eq(5).text().replace("원",""));
            object.push(td.eq(6).text());
            object.push(td.eq(7).text());

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('Payments.payrequest') }}",
                method: "POST",
                dataType: "json",
                data: {'data': object},
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
                    alert('결제 실패');
                }
            });
        });

        $('button[name="orderBtn"], button[name="searchBtn"]').click(function(){
            $('input[name="sort"]').val($(this).attr("data-type"));
            $('[name="frm"]').submit();
        })
    });
@endprepend

@section('content')
<!-- content : start-->
<div class="container-fluid flex-grow-1 container-p-y">

    <form method="get" name="frm" action="{{ route('orders.index') }}" >
        <input type="hidden" name="sort" value="">

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
                        <input type="text" class="form-control" name="sch" placeholder="데이터명 검색" value="{{ $sch }}">
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
        @foreach($orders as $order)
            <tr>
                <input type="hidden" name="" value="{{ $order->id }}">
                <td>
                    @if ($order->state === 1)
                        <img src="/img/img_waiting.png" alt="결제 대기중"/>
                    @elseif ($order->state === 2)
                        <img src="/img/img_upload.png" alt="타겟 업로드"/>
                    @endif
                </td>
                <td>
                    <ul>
                        @foreach(explode(',', $order->types) as $type)
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
                <td>{{ $order->data_name }}</td>
                <td>{{ $order->data_count }}</td>
                <td>
                    @if (isset($order->buy_price))
                        {{ $order->buy_price }}원
                    @endif
                </td>
                <td>{{ $order->buy_date }}</td>
                <td>{{ $order->expiration_date }}</td>
                <td>
                    <ul>
                        <li>
                            @if ($order->state === 1)
                                결제 대기중
                            @elseif ($order->state === 2)
                                <button type="button" class="checkBtn" >결제하기 ></button>
                            @elseif ($order->state === 3)
                                결제 완료
                            @elseif ($order->state === 4)
                                유효 기간완료
                            @endif
                        </li>
                        <li><button type="button" onclick="location.href='/contact_us.html'">문의하기 ></button></li>
                    </ul>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

</div>
<!-- content : end-->
@endsection
