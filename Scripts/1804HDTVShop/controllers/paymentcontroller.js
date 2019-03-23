app.controller('paymentcontroller', function ($scope, $location, $anchorScroll, $timeout) 
{
    document.title = 'Payment';
    //scroll to top on load
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds
    $(document).ready(function(){

        $('#cmdPay').click(function(){
            if(validateForm() == true)
            {
                $("#frmPayment").submit();
            }
        });
        
        function validateForm(){
            var check = true;
            var nameReg = /^[A-Za-z ]+$/;
            var phoneReg =  /^[0-9]{10,11}$/;
            var emailReg = /^([\w+]+@([\w]+\.)+[\w]{2,4})?$/;        
        
            var name = $('#cusName').val();
            var email = $('#cusEmail').val();
            var phone = $('#cusPhone').val();
            var address = $('#cusAddress').val();
        
            var inputVal = new Array(name, email,address, phone);
        
            var inputMessage = new Array("Tên", "Địa chỉ Email", "Địa chỉ nhận hàng", "Số điện thoại ");
        
            $('.error').hide();
        
                if(inputVal[0] == ""){
                    $('#nameLabel').after('<p  class="error"> Xin mời nhập: ' + inputMessage[0] + '</p>');
                    check = false;
                } 
                else if(!nameReg.test(name)){
                    $('#nameLabel').after('<p class="error"> Chỉ bao gồm chữ cái</p>');
                    check = false;
                }
                if(inputVal[1] == ""){
                    $('#emailLabel').after('<p class="error"> Xin mời nhập: ' + inputMessage[1] + '</p>');
                    check = false;
                } 
                else if(!emailReg.test(email)){
                    $('#emailLabel').after('<p class="error"> Xin nhập đúng định dạng Email VD: abc@abc.abc</p>');
                    check = false;
                }
                if(inputVal[2] == ""){
                    $('#addressLabel').after('<p class="error"> Xin mời nhập: ' + inputMessage[2] + '</p>');
                    check = false;
                } 
                if(inputVal[3] == ""){
                    $('#phoneLabel').after('<p class="error"> Xin mời nhập: ' + inputMessage[3] + '</p>');
                    check = false;
                } 
                else if(!phoneReg.test(phone)){
                    $('#phoneLabel').after('<p class="error"> Số điện thoại chỉ gồm các chữ số và có độ dài từ 10 - 11 kí tự</p>');
                    check = false;
                }
            
                $(".error").delay(2500)
                .hide(500)
                .queue(function () {
                    $(this).remove();
                });
                return check;
            
        }   
        
        }); 
        var request;
        //Nếu form submit
        $('#frmPayment').submit(function (e) {
            // Ngừng submit mặc định (tránh việc load lại trang trước khi thực hiện các lệnh khác)
            e.preventDefault();
            if (request) {
                request.abort();
            }
    
            // đặt lại tên form cho dễ gọi :))
            var $form = $(this);
            // Chọn tất cả input trừ cái bid để disable (bid mặc định đã disabled)
            var $inputs = $form.find("input, select, button, textarea");
            // Mã hóa để đưa dữ liệu qua post
            var serializedData = $form.serialize();
    
            // Disabled tất cả các input khi dữ liệu đang submit
            $inputs.prop("disabled", true);
    
            // Bắt đầu đưa dữ liệu qua trang xử lý
            request = $.ajax({
                url: "paymentconfirm.php",
                type: "POST",
                data: serializedData
            });
    
            // Nếu việc truyền dữ liệu xảy ra ổn thỏa (ý là đã submit qua đó thành công)
            request.done(function (response, textStatus, jqXHR) {
                // Nếu dữ liệu trả về là "ok" (nghĩa là đã xử lý tốt các dữ liệu, không bị lỗi gì khác)
                if (response == "ok") {
                    $("#txtResult").removeClass("text-danger");
                    $("#txtResult").addClass("text-success");
                    // $("#txtResult").html("<h2>Thanh toán thành công!</h2>");
                    // Hiện modal hiển thị kết quả
                    $('#result').modal('show');
                    // window.location.replace("#!login");    
                    // Xóa input
                    // eraseInput();
    
                    // Cho tự động tắt và load lại trang sau vài giây
                    // window.setTimeout(closeModal, 1500);
                    // window.open('#!login');
                    // window.location.assign("https://www.example.com");
                    // window.location.href="#!login";
                } else {
                    $("#txtResult").removeClass("text-danger");
                    // Nếu dữ liệu trả về bị bất kì lỗi gì
                    $("#txtResult").addClass("text-danger");
                    $("#txtResult").html(response);
                    $('#result').modal('show');
                    // eraseInput();
                    // Cho tự động tắt và load lại trang sau vài giây
                    //window.setTimeout(closeModal, 1500);
                    //window.setTimeout(reloadPage,500);
                }
    
            });
    
            // Nếu việc truyền dữ liệu qua file xử lý bị lỗi
            request.fail(function (jqXHR, textStatus, errorThrown) {
                // Ghi lại trong console để sửa
                console.error(
                    "Lỗi khi truyền dữ liệu: " +
                    textStatus, errorThrown
                );
            });
    
            // Dù việc truyền dữ liệu bị lỗi hay không thì cũng phải enable lại input
            request.always(function () {
                $inputs.prop("disabled", false);
    
            });
        });
});