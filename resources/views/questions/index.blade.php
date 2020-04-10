@extends('layouts.backend')

@prepend('scripts')
    <script>

        function validateEmail(sEmail) {
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (filter.test(sEmail)) {
                return true;
            }
            else {
                return false;
            }
        };

        $('#frm button[name=btn]').click(function(){
            if ($("#frm input[name=name]").val() == "") {
                alert('이름을 입력하세요.');
                return false;
            }

            if ($("#frm input[name=title]").val() == "") {
                alert('제목을 입력하세요.1');
                return false;
            }

            if ($("#frm [name=content]").val() == "") {
                alert('내용을 입력하세요.');
                return false;
            }

            if ($("#frm input[name=phone]").val() == "") {
                alert('연락처를 입력하세요.');
                return false;
            }

            if ($("#frm input[name=email]").val() == "") {
                alert('이메일을 입력하세요.');
                return false;
            }

            var sEmail = $("#frm input[name=email]").val();

            if (!validateEmail(sEmail)) {
                alert('잘못된 이메일 형식 입니다');
                return false;
            }

            if ($("#frm input:checkbox[name=check]").is(":checked") == false) {
                alert('개인정보 수집 동의 확인 후 가능합니다.');
                return false;
            }

            $('#frm').submit();
        });


    </script>

@endprepend

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y contact_us">
        <div class="wrap">
            <div class="top clearfix">
                <p>문의하기
                    <span class="txt">DMP9에게 궁금한 점을 쉽고 빠르게 찾아보세요.</span>
                </p>
                <button type="button" onclick="addWriting()">글쓰기</button>
            </div>
            <div class="table_wrap">
                <table class="table">
                    <colgroup>
                        <col width="5%">
                        <col width="40%">
                        <col width="10%">
                        <col width="15%">
                        <col width="15%">
                        <col width="5%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>번호</th>
                        <th>제목</th>
                        <th>작성자</th>
                        <th>작성일</th>
                        <th>진행상태</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                    <tr>
                        <td>{{ $question['id'] }}</td>
                        <td>{{ $question['title'] }}</td>
                        <td>{{ $question['name'] }}</td>
                        <td>{{ $question['created_at']->format('Y.m.d') }}</td>
                        <td>
                            @if (!$question['answers']->isEmpty())
                                <p>완료</p>
                            @else
                                <p>대기중</p>
                            @endif
                        </td>
                        <td class="toggle_tr"><img src="./assets/img/icon_down_arrow.png" alt="아이콘 아래 화살표"/></td>
                    </tr>
                    <tr class="toggle_dropdown_tr">
                        <td colspan="6">
                            <!--itme 묶음-->
                            <div class="item mb-1">
                                <div class="txt-box form-inline">
                                    <div class="label">질문</div>
                                    <div class="txt">{{ $question['content'] }}</div>
                                </div>
                                @if (!$question['answers']->isEmpty())
                                <div class="txt-box form-inline">
                                    <div class="label">답변</div>
                                    <div class="txt">
                                         @foreach ($question['answers'] as $answer)
                                            {{ $answer['content'] }}
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!--itme 묶음-->
                        </td>
                    </tr>
                    @endforeach
                    @if ($questions->isEmpty())
                        <tr>
                            <td colspan="6">
                                <div class="no_data">
                                    <img src="https://image.flaticon.com/icons/svg/87/87980.svg"/>
                                    <p>문의 내역이 없습니다.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div id="add_writing" class="overlay-wrap alert">
            <div class="writing_wrap">

                <div class="writing_box">
                    <form method="POST" id="frm" name="frm" action="{{ route('questions.store') }}">
                        @csrf
                    <div class="inner">
                        <div class="top clearfix">
                            <h1>문의하기</h1>
                            <button type="button" onclick="addWritingDisNone()"><img src="/assets/img/btn_close.png" alt="닫기 버튼"/></button>
                        </div>
                        <div class="cont">
                            <div class="form-group">
                                <label for="name">이름/회사명</label>
                                <input type="text"  class="form-control" name="name" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}" autocomplete="off" placeholder="이름/회사명을 입력해주세요">
                            </div>
                            <div class="form-group">
                                <label for="title">제목</label>
                                <input type="text"  class="form-control" name="title" autocomplete="off" placeholder="제목을 입력해주세요">
                            </div>
                            <div class="form-group">
                                <label for="context">문의내용</label>
                                <textarea  class="form-control" style="resize: none;"  name="content" autocomplete="off" placeholder="내용을 입력해주세요"></textarea>
                            </div>
                            <div class="form-group form-inline">
                                <p>
                                    <label for="phone">연락처</label>
                                    <input type="number" class="form-control" name="phone" value="{{ \Illuminate\Support\Facades\Auth::user()->phone }}"  autocomplete="off" placeholder="(ex. 01012345678910)">
                                </p>
                                <p>
                                    <label for="email">이메일</label>
                                    <input type="text"  class="form-control" name="email" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" autocomplete="off" placeholder="이메일을 입력해주세요">
                                </p>

                            </div>
                        </div>
                        <div class="cont_sub">
                            <span class="checkbox" style="position: absolute; left: 0; top: 14px;">
                                <input type="checkbox" id="Check_1" name="check" />
                                <label for="Check_1"></label>
                            </span>
                            <label for="Check_1">
                                <span class="txt">개인정보 수집 동의</span>
                                <div class="context">
                                    <p>문의접수 및 처리를 위해 이메일, 연락처를 수집하고 접수된 내용은 6개월 동안 보관합니다.</p>
                                    <p>개인정보 수집 동의를 거부할 수 있으며, 거부 시 문의가 불가할 수 있습니다.</p>
                                </div>
                            </label>
                        </div>
                        <div class="btn_box">
                            <button type="button" id="btn" name="btn">문의등록</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@include('questions.mobile')

@endsection
