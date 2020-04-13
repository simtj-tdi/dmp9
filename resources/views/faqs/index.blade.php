@extends('layouts.backend')

@section('content')

    <div class="container-fluid flex-grow-1 container-p-y question">

        <div class="wrap">
            <div class="top">
                자주 묻는 질문
                <span class="txt">DMP9에게 궁금한 점을 쉽고 빠르게 찾아보세요.</span>
            </div>
            <div class="cont">
                <div class="top">목록</div>
                @foreach($faqs as $faq)
                <ul>
                    <li class="text_question">
                        <p>
                            Q. {{ $faq['title'] }}
                        </p>
                        <span><img src="./assets/img/btn_arrow_down.png" alt="화살표 아래"/></span>
                    </li>
                    <li class="text_answer">
                        <span class="index">A.</span>
                        <span class="txt">
                           {{ $faq['content'] }}
                        </span>
                    </li>
                </ul>
                @endforeach
            </div>


        </div>
    </div>



@endsection
