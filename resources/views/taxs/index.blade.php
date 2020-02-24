@extends('layouts.backend')

@section('content')
    <!-- content : start-->
    <div class="request container-fluid flex-grow-1 container-p-y">
        <div class="wrap">
            <div class="text_box">
                <h1>세금계산서 요청</h1>
                <p>세금계산서는 매월 말일날 발행됩니다.</p>
            </div>
            <div class="btn_box">
                <button type="button"><img src="/img/btn_request_01.png" alt="작성하러 가기 버튼"/></button>
                <button type="button"><img src="/img/btn_request_02.png" alt="요청하기 버튼"/></button>
                <button type="button"><img src="/img/btn_request_03.png" alt="매월 세금계산서 요청하기 버튼"/></button>
            </div>
        </div>
    </div>
    <!-- content : end-->
@endsection
