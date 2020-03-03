@extends('layouts.backend')

@section('content')

    <!-- content : start-->
    <div class="container-fluid flex-grow-1 container-p-y contact_us">
        <div class="wrap">
            <div class="top clearfix">
                <p>문의하기</p>
                <button type="button" onclick="addWriting()"><img src="/img/btn_add_wrighting.png" alt="글쓰기 버튼"/></button>
            </div>
            <div class="cont">
                @foreach($questions as $question)
                    <ul>
                        <li class="text_question">
                            <p class="type_a">일반</p>
                            <p>{{ $question['title'] }}</p>
                            <p></p>
                            @if ($question['answers']->count() >0)
                                <p>완료</p>
                            @else
                                <p>대기</p>
                            @endif
                        </li>
                        <li class="text_answer">
                            <p>
                                {{ $question['content'] }}
                            </p>
                            @if ($question['answers']->count() >0)
                            <li class="text_answer">
                                <p>
                                    <span>답변</span>
                                    @foreach ($question['answers'] as $answer)
                                        {{ $answer['content'] }}
                                    @endforeach
                                </p>
                            </li>
                            @endif
                        </li>
                    </ul>
                @endforeach

            </div>
            {{ $questions->links() }}
        </div>

        <div id="add_writing" class="overlay-wrap alert">
            <div class="writing_wrap">
                <div class="writing_box">

                    <form method="POST" action="{{ route('questions.store') }}">
                        @csrf
                        <div class="inner">
                        <div class="top clearfix">
                            <h1>문의하기</h1>
                            <button type="button" onclick="addWritingDisNone()"><img src="/img/btn_close.png" alt="닫기 버튼"/></button>
                        </div>
                        <div class="cont">
                            <div class="form-group form-inline">
                                <select class="form-control">
                                    <option>질문구분</option>
                                    <option>b</option>
                                </select>
                                <input id="title" type="text" class="form-control" name="title" value="" placeholder="제목">
                            </div>
                            <div class="form-group">
                                <textarea id="content" class="form-control" name="content" value="" placeholder="문의 내용"></textarea>
                            </div>
                            <div class="form-group form-inline">
                                <input type="text" class="form-control" placeholder="이메일">
                                <input type="text" class="form-control" placeholder="연락처">
                            </div>
                        </div>
                        <div class="cont_sub">
                            <div>
                                <input type="checkbox" name="check" id="add_writing_check">
                                <label for="add_writing_check">
                                    <span></span> 개인정보 수집 동의
                                </label>
                            </div>
                            <div>
                                <p>문의 접수 및 처리를 위해 이메일, 연락처를 수집하고 접수된 내용은 6개월 동안 보관합니다. 개인정보 수집 동의를
                                    <br/>
                                    거부할 수 있으며, 거부 시 문의가 불가할 수 있습니다</p>
                                <br/>
                                <p>상담시간 : 오전 10시 - 오후 6시   대표전화 : 070-7853-1644   이메일 : helpfs9@nsmg21.com</p>
                            </div>
                        </div>
                        <div class="btn_box">
                            <button type="submit" onclick="addWritingDisNone()"><img src="/img/btn_commit.png" alt="문의등록 버튼"/></button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- content : end-->
@endsection
