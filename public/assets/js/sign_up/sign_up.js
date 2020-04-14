/* 모두동의 */
$('#all_checkbox').on("change", function(){
    var checked = $(this).prop('checked'); // checked 문자열 참조(true, false)
    $('input[name="check"]').prop('checked', checked);
  });

  $('input[name="check"]').change(function () {
    var boxLength = $('input[name="check"]').length;
    // 체크된 체크박스 갯수를 확인하기 위해 :checked 필터를 사용하여 체크박스만 선택한 후 length 프로퍼티를 확인
    var checkedLength = $('input[name="check"]:checked').length;
    var selectAll = (boxLength == checkedLength);

    $('#all_checkbox').prop('checked', selectAll);
  });

/* 이메일 선택 */
  function selectEmail(){
    $("#select_email option:selected").each(function () {
    if($(this).val()== '1'){ //직접입력일 경우
        $("#email_text").val('');
        $("#email_text").attr("disabled",false);
    }else{
        $("#email_text").val($(this).text());
        $("#email_text").attr("disabled",true);
    }
    });
};


/* file 등록 */
$(document).ready(function(){
    var fileTarget = $('.upload_name');
        fileTarget.on('change', function(){
            if(window.FileReader){
                var fileName = $(this)[0].files[0].name;
            } else {
                var fileName = $(this).val().split('/').pop().split('\\').pop();
            }
            $(this).siblings('.text_name').val(fileName);
        });
    });


// 우편번호 찾기 찾기 화면을 넣을 element
function  execDaumPostcode() {
    new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                document.getElementById("extraAddress").value = extraAddr;

            } else {
                document.getElementById("extraAddress").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById('postcode').value = data.zonecode;
            document.getElementById("address").value = addr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("detailAddress").focus();
        }
    }).open();
}
