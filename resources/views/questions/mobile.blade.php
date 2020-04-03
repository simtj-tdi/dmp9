@prepend('scripts')
    <script>
        $('#frm_mobile button[name=btn]').click(function(){
            if ($("#frm_mobile input[name=name]").val() == "") {
                alert('이름을 입력하세요.');
                return false;
            }

            if ($("#frm_mobile input[name=title]").val() == "") {
                alert('제목을 입력하세요.2');
                return false;
            }

            if ($("#frm_mobile [name=content]").val() == "") {
                alert('내용을 입력하세요.');
                return false;
            }

            if ($("#frm_mobile input[name=phone]").val() == "") {
                alert('연락처를 입력하세요.');
                return false;
            }

            if ($("#frm_mobile input[name=email]").val() == "") {
                alert('이메일을 입력하세요.');
                return false;
            }

            var sEmail = $("#frm_mobile input[name=email]").val();

            if (!validateEmail(sEmail)) {
                alert('잘못된 이메일 형식 입니다');
                return false;
            }

            if ($("#frm_mobile input:checkbox[name=check]").is(":checked") == false) {
                alert('개인정보 수집 동의 확인 후 가능합니다.');
                return false;
            }

            $('#frm_mobile').submit();
        });
    </script>

@endprepend

<div class="container-fluid flex-grow-1 container-p-y contact_us_mo">
    <div class="wrap">
        <div class="top clearfix">
            <p>문의하기
                <span class="txt">DMP9에게 궁금한 점을 쉽고 빠르게 찾아보세요.</span>
            </p>
            <button type="button" onclick="moAddWriting()">글쓰기</button>
        </div>
        <div class="cont">
            <div class="top">목록</div>
            <!--묶음-->
            @foreach($questions as $question)
            <ul>
                <li class="text_question">
                    <div class="text_01 form-inline">
                        <div>{{ $question['title'] }}</div>
                        <div><img src="./assets/img/icon_down_arrow.png" alt="아이콘 아래 화살표"/></div>
                    </div>
                    <div class="text_02 mt-2">
                        @if (!$question['answers']->isEmpty())
                            <div>답변완료</div>
                        @else
                            <div>답변대기</div>
                        @endif

                        <!-- <div><img src="./assets/img/icon_down_arrow.png" alt="아이콘 아래 화살표"/></div> -->
                    </div>
                </li>
                <li class="text_answer mt-3">
                    <div>
                        <span>질문</span>
                        {{ $question['content'] }}
                    </div>
                    @if (!$question['answers']->isEmpty())
                    <div class="mt-2">
                        <span>답변</span>
                        @foreach ($question['answers'] as $answer)
                            {{ $answer['content'] }}
                        @endforeach
                    </div>
                    @endif
                </li>
            </ul>
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

            <!--묶음-->
        </div>
    </div>

    <div id="mo_add_writing" class="overlay-wrap alert">
        <div class="writing_wrap">
            <div class="writing_box">
                <form method="POST" id="frm_mobile" name="frm_mobile" action="{{ route('questions.store') }}">
                    @csrf
                <div class="inner">
                    <div class="top clearfix">
                        <h1>문의하기</h1>
                        <button type="button" onclick="moAddWritingDisNone()"><img src="/assets/img/btn_close.png" alt="닫기 버튼"/></button>
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
                            <textarea id="context" class="form-control" style="resize: none;" name="content" autocomplete="off" placeholder="내용을 입력해주세요"></textarea>
                        </div>
                        <div class="form-group">
                            <p>
                                <label for="phone">연락처</label>
                                <input type="number"  class="form-control" name="phone" value="{{ \Illuminate\Support\Facades\Auth::user()->phone }}" autocomplete="off" placeholder="연락처를 입력해주세요">
                            </p>
                            <p>
                                <label for="email">이메일</label>
                                <input type="text"  class="form-control" name="email" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" autocomplete="off" placeholder="이메일을 입력해주세요">
                            </p>

                        </div>
                        <div class="cont_sub">
                        <span class="checkbox" style="position: absolute; left: 0; top: 14px;">
                            <input type="checkbox" id="Check_2" name="check" />
                            <label for="Check_2"></label>
                        </span>
                            <span class="txt">개인정보 수집 동의</span>
                            <div class="context">
                                <p>문의접수 및 처리를 위해 이메일, 연락처를 수집하고 접수된 내용은 6개월 동안 보관합니다.</p>
                                <p>개인정보 수집 동의를 거부할 수 있으며, 거부 시 문의가 불가할 수 있습니다.</p>
                            </div>
                        </div>
                        <div class="btn_box">
                            <button type="button" name="btn">문의등록</button>
                        </div>
                    </div>

                </div>

                </form>
            </div>
        </div>
    </div>

</div>
