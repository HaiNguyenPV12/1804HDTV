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
});