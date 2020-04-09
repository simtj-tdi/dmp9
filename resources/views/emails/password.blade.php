<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<style type="text/css">
    .btn-link {
        border: none;
        outline: none;
        background: none;
        cursor: pointer;
        color: #0000EE;
        padding: 0;
        text-decoration: underline;
        font-family: inherit;
        font-size: inherit;
    }
</style>
<body>
    <form method="POST" target="_blank" action="{{$url}}">
        <input type="hidden" name="user_id" value="{{$user_id}}">

        <p>DMP9 에서 드리는 알림메일입니다.</p>
        <p>{{$name}} 회원님</p>
        <p>[비밀번호 수정 메일]</p>
        <p><button type="submit" class="btn btn-link" >새 비밀번호 설정</button></p>
        <p>위 링크를 클릭하신 후</p>
        <p>새 비밀번호를 입력 해 주세요.</p>
        <p>변경하신 비밀번호로 로그인 가능합니다.</p>
    </form>

</body>
</html>
