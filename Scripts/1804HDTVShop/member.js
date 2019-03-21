$(document).ready(function(){

    $('#cmdMember').click(function(){
        if(validateForm() == true)
        {
            $("#frmLogin").submit();
        }
    });
    
    function validateForm(){
        var check = true;
        var nameReg = /^[A-Za-z ]+$/;
        var phoneReg =  /^[0-9]{10,11}$/;
        var emailReg = /^([\w+]+@([\w]+\.)+[\w]{2,4})?$/;
        var idReg = /^\w+$/;
        var pwReg = /^\w+$/;
    
        var name = $('#memName').val();
        var id = $('#memID').val();
        var pw = $('#memPW').val();
        var email = $('#memEmail').val();
        var phone = $('#memPhone').val();
        var address = $('#memAddress').val();
        var repw = $('#memRPW').val();
    
        var inputVal = new Array(name, email,address, phone,  id, pw, repw);
    
        var inputMessage = new Array("Tên", "Địa chỉ Email", "Địa chỉ", "Số điện thoại ", "ID đăng nhập","Mật khẩu lần 1", "Mật khẩu lần 2");
    
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
            if(inputVal[4] == ""){
                $('#idLabel').after('<p class="error"> Xin mời nhập ' + inputMessage[4] + '</p>');
                check = false;
            }       
            else if(!idReg.test(id)){
                $('#idLabel').after('<p class="error"> ID đăng nhập chỉ gồm các kí tự không bao gồm khoảng trắng và kí tự đặc biệt</p>');
                check = false;
            }
            if(inputVal[5] == ""){
                $('#pwLabel').after('<p class="error"> Xin mời nhập ' + inputMessage[5] + '</p>');
                check = false;
            }       
            else if(!pwReg.test(pw)){
                $('#pwLabel').after('<p class="error"> Mật khẩu chỉ gồm các kí tự không bao gồm khoảng trắng và kí tự đặc biệt</p>');
                check = false;
            }
            if(inputVal[6] == ""){
                $('#repwLabel').after('<p class="error"> Xin mời nhập ' + inputMessage[6] + '</p>');
                check = false;
            }       
            else if(pw != repw){
                $('#repwLabel').after('<p class="error"> Mật khẩu lần 2 phải trùng với mật khẩu lần 1</p>');
                check = false;
            }
        
        return check;
    }   
    
    }); 