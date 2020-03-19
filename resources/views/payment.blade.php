@extends('layouts.app')

@prepend('scripts')
    <script>
    $(function() {
        $('#btn').click(function() {
            var formSerializeArray = $('#form_pay').serializeArray();
            var object = {};
            for (var i = 0; i < formSerializeArray.length; i++){
                object[formSerializeArray[i]['name']] = formSerializeArray[i]['value'];
            }
            var json = JSON.stringify(object);
            //console.log(json);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('Payments.payrequest') }}",
                method: "POST",
                dataType: "json",
                data: object,
                success: function (data) {
                    var JSONArray = JSON.parse(data['success']);
                    console.log(JSONArray['token']);
                    window.open(JSONArray['online_url'],"페이레터","width=800, height=700, toolbar=no, menubar=no, scrollbars=no, resizable=yes");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        });
    });
    </script>
@endprepend

@section('content')
    <form name="form_pay" id="form_pay">
        <input type="hidden" name="pgcode" value="creditcard" >
        <input type="hidden" name="user_id" value="tests" >
        <input type="hidden" name="user_name" value="테스트이름" >
        <input type="hidden" name="service_name" value="서비스이름" >
        <input type="hidden" name="client_id" value="pay_test" >
        <input type="hidden" name="order_no" value="1234567890" >
        <input type="hidden" name="amount" value="1000" >
        <input type="hidden" name="product_name" value="테스트상품" >
        <input type="hidden" name="email_flag" value="Y" >
        <input type="hidden" name="email_addr" value="payletter@payletter.com" >
        <input type="hidden" name="autopay_flag" value="N" >
        <input type="hidden" name="receipt_flag" value="Y" >
        <input type="hidden" name="custom_parameter" value="this is custom parameter" >
        <input type="hidden" name="return_url" value="{{ route('Payments.payreturn') }}" >
        <input type="hidden" name="callback_url" value="{{ route('Payments.paycallback') }}" >
        <input type="hidden" name="cancel_url" value="{{ route('Payments.payCancel') }}" >

        <button type="button" class="btn btn-outline-primary" name="btn" id="btn">전송</button>
    </form>
@endsection

