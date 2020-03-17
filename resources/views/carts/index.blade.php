@extends('layouts.backend')

@prepend('scripts')
    <script>

        $(function() {

            $("select[name=select_data_types]").change(function() {
                //alert($(this).val());
                //alert($(this).data("tr"));
                if ($(this).val()) {
                    $(this).parent().parent().next('tr').show();
                    $("td[name="+$(this).data("tr")+"]").prepend("<div class=\"item mb-1\"><div class=\"form-inline\"><div class=\"form-inline\"><p class=\"form-control label_control\">"+$(this).val()+"</p><p class=\"form-control\">https://ads.google.com</p></div><div class=\"input_control form-inline\"><label class=\"form-control label_control\">아이디</label><input type=\"text\" class=\"form-control\" value=\"abs@aasaa.com\"></div><div class=\"input_control form-inline\"><label class=\"form-control label_control\">비밀번호</label><input type=\"password\" class=\"form-control\" value=\"1234\"></div><div><button type=\"button\" class=\"form-control label_control\">수정</button></div><div><button type=\"button\" class=\"form-control label_control\">업로드 요청</button></div></div></div>");
                }

            });

            $("input[name=sel]").click(function() {
                var total_int=0;
                var total_count=0;
                var total_price=0;
                $("input[name=sel]:checked").each(function() {
                    total_int += 1;
                    total_count += $(this).data("count");
                    total_price += $(this).data("price");
                });
                $("span[name=total_int]").text(total_int);
                $("span[name=total_count]").text(total_count);
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

                if (total_price <= 0) {
                    alert("구매 금액이 0원 이상 이여야 합니다.");
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
    </script>

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
                    <col width="20px">
                    <col width="20px">
                    <col width="20px">
                    <col width="10px">
                </colgroup>
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="all_checkbox">
                        <label for="all_checkbox">
                            <span></span>
                        </label>
                    </th>
                    <th>광고주</th>
                    <th>데이터명</th>
                    <th>데이터<br/>추출수</th>
                    <th>구매가격</th>
                    <th>구매일</th>
                    <th>유효기간</th>
                    <th>대상 플랫폼</th>
                    <th>상태</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <!--묶음-->
                @foreach($carts as $cart)
                    <tr>
                        <td>
                            @if ($cart->state === 3)
                                <input type="checkbox" name="sel" value="{{ $cart->id }}" data-count="{{ $cart->goods->data_count }}" data-price="{{ $cart->goods->buy_price }}">
                            @else
                                <input type="checkbox" name="sel" value="{{ $cart->id }}" disabled>
                            @endif
                            <label for="chk_02">
                                <span></span>
                            </label>
                        </td>
                        <td class="toggle_tr">{{ $cart->goods->advertiser }}</td>
                        <td>{{ $cart->goods->data_name }}</td>
                        <td>{{ $cart->goods->data_count }}</td>
                        <td>
                            @if (isset($cart->goods->buy_price))
                                {{$cart->mark_price}}
                            @endif
                        </td>
                        <td>{{ $cart->buy_date }}</td>
                        <td>{{ $cart->goods->expiration_date }}</td>
                        <td>
                            <select class="select_control" name="select_data_types" data-tr="td_{{ $cart->id }}" {{ $cart->state == 3 ? 'disabled' : '' }}>
                                <option value="">선택</option>
                                @foreach($platforms as $platform)
                                    <option value="{{ $platform['platform_id'] }}">{{ $platform['name'] }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            @if ($cart->state === 1)
                                요청중
                            @elseif ($cart->state === 2)
                                추출중
                            @elseif ($cart->state === 3)
                                승인요청
                            @elseif ($cart->state === 4)
                                결제완료
                            @endif
                        </td>
                        <td  class="explanation_td">◎
                            <div class="explanation_box">
                                <p>업로드 할 플랫폼의 이용하는 아아디/비밀번호를 입력해주세요.</p>
                            </div>
                        </td>
                    </tr>

                    <tr class="toggle_dropdown_tr">
                        <td colspan="10" name="td_{{ $cart->id }}">

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <hr/>
        <div class="sum_wrap mt-2">
            <ul class="form-inline">
                <li class="form-control"><span name="total_int">0</span></li>
                <li class="form-control"><span name="total_count">데이터 총 개수</span></li>
                <li class="form-control"><span name="total_price">데이터 총 금액</span>원</li>
                <li><button type="button" class="form-control new_buy">선택된 데이터 구매</button></li>
                <!--<li><button type="button" class="form-control" onclick="addRequestData()">구매한 데이터 업로드 요청</button></li>-->
                <li><button type="button" class="form-control" onclick="addData()">데이터 등록</button></li>
            </ul>
        </div>

        <div id="request_data" class="request_data overlay-wrap alert">
            <div class="writing_wrap">
                <div class="writing_box">
                    <div class="inner">
                        <div class="top clearfix">
                            <h1>총 12개의 데이터가 업로드 목록으로 복사됩니다.</h1>
                        </div>
                        <div class="cont">
                            <p>업로드 하실 플랫폼의 아이디/비밀번호를 꼭 입력해주세요.</p>
                            <p>입력하지 않을 시 업로드가 되지 않습니다.</p>
                        </div>
                        <div class="cont_sub">
                            <p>*DMP9은 개인정보 보호법을 위반 하지 않습니다.</p>
                        </div>
                        <div class="btn_box">
                            <button type="button" onclick="addRequestDataDisNone()">확인</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="add_data" class="add_data overlay-wrap alert">
            <div class="writing_wrap">
                <div class="writing_box">
                    <form name="registerForm" method="POST" action="{{ route('goods.store') }}">
                        @csrf
                        <div class="inner">
                        <div class="top clearfix">
                            <h1>데이터 요청하기</h1>
                            <button type="button" onclick="addDataDisNone()"><img src="/img/btn_close.png" alt="닫기 버튼"/></button>
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
                                <label>타겟 유형</label>
                                <div class="target_wrap">
                                    <input type="radio" name="data_target" value="app"> App
                                    <input type="radio" name="data_target" value="local"> 위치
                                    <input type="radio" name="data_target" value="applocal"> App + 위치
                                    <input type="radio" name="data_target" value="none"> 유형없음
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
                            <!--<button type="button" onclick="addDataDisNone()">요청하기</button>-->
                            <button type="submit"class="createBtn">요청하기</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- content : end-->
@endsection
