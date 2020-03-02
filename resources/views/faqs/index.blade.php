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
                                {{ $faq['title'] }}
                                <span><img src="/img/btn_arrow_down.png" alt="화살표 아래" /></span>
                            </p>
                        </li>
                        <li class="text_answer">
                            {{ $faq['content'] }}
                        </li>
                    </ul>
                @endforeach
            </div>

            {{ $faqs->links() }}

        </div>
    </div>
    <!-- content : end-->

@endsection
