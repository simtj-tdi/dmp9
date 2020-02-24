@extends('layouts.backend')

@section('content')
    <!-- content : start-->
    <div class="container-fluid flex-grow-1 container-p-y question">
        <div class="wrap">
            <div class="top">
                질문 목록
            </div>
            <div class="cont">
                @foreach($faqs as $faq)
                    <ul>
                        <li class="text_question">
                            <p>
                                <span><img src="/img/btn_Q.png" alt="Q"/></span>
                                {{ $faq->title }}
                                <span><img src="/img/btn_arrow_down.png" alt="화살표 아래" /></span>
                            </p>
                        </li>
                        <li class="text_answer">
                            {{ $faq->content }}
                        </li>
                    </ul>
                @endforeach
            </div>
            <div class="pager">
                <ul class="clearfix">
                    <li class="active">1</li>
                    <li>2</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- content : end-->



{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">FAQ</div>--}}

{{--                    <div class="card-body">--}}
{{--                        <ul class="list-group">--}}
{{--                            @foreach($faqs as $faq)--}}
{{--                                <li class="list-group-item">--}}
{{--                                    <div class="d-flex w-100 justify-content-between">--}}
{{--                                        <a href="{{ route('faqs.show', $faq->id ) }}">--}}
{{--                                            <h5 class="mb-1">{{ $faq->id }}. {{ $faq->title }}</h5>--}}
{{--                                        </a>--}}
{{--                                        <small></small>--}}
{{--                                    </div>--}}
{{--                                    <p class="mb-1">{{ $faq->content }}</p>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a class="btn btn-primary" href="{{ route('faqs.create') }}" role="button">글쓰기</a>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
