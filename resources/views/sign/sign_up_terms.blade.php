@extends('layouts.sign')

@prepend('scripts')
    <script>
    $(function() {
        $("button[name=btn]").click(function(e) {
            var success = true;
            $("input:checkbox[name=check]").each(function() {
                if (this.checked == false) {
                    alert('필수 약관동의 후 가입이 가능합니다.');
                    success = false;
                    return false;
                }
            });

            if (success == false) {
                return false;
            }

            $("input[name=type]").val($(this).attr('id'));
            $("form[name=sign_up]").submit();

        });
    });
    </script>
@endprepend

@section('content')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-1">
    <!-- Layout inner -->
    <div class="layout-inner">
        <div class="layout-container terms"> <!--폴더 부분-->
            <div class="inner">
                <div class="title">
                    <h1>약관동의</h1>
                </div>
                <div class="text">
                    <p>약관 내용</p>
                </div>
                <div class="input_box">
                    <ul>
                        <li>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="check" class="custom-control-input">
                                <span class="custom-control-label">DMP9 서비스 이용약관 (필수)</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="check" class="custom-control-input">
                                <span class="custom-control-label">개인정보 수집 및 이용 안내 (필수)</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="check" class="custom-control-input">
                                <span class="custom-control-label">개인정보 처리 위탁 안내 (필수)</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" id="all_checkbox" class="custom-control-input mt-3">
                                <span class="custom-control-label">전체 동의</span>
                            </label>
                        </li>
                    </ul>
                </div>

                <div class="but_box">
                    <button name="btn" id="company" type="button">사업자로 가입하기</button>
                    <button name="btn" id="personal" type="button">개인으로 가입하기</button>
                </div>

                <form method="GET" name="sign_up"  action="{{ route('register') }}">
                    @csrf
                    <input type="hidden" name="type" value="">
                </form>

            </div>
        </div>
    </div>
    <!-- Layout inner -->

    <div class="layout-overlay layout-sidenav-toggle"></div>
</div>
<!-- / Layout wrapper -->

@endsection
