$(document).ready(function () {
    //scroll to top
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds
    //default values
    $('#btnStaffEditLink').attr('href', '#!staff/edit/update/' + staffID.value
        + '/' + staffName.value + '/' + staffRole.value
        + '/' + staffEmail.value + '/' + staffUID.value
        + '/' + staffPW.value + '/' + staffPhone.value
        + '/' + staffAdd.value + '/' + staffEmployed.value + '/0'
    );
    console.log($('#btnStaffEditLink').attr('href'));
    $('#staffEditForm').change(function (e) {
        e.preventDefault();
        $('#btnStaffEditLink').attr('href', '#!staff/edit/update/' + staffID.value
            + '/' + staffName.value + '/' + staffRole.value
            + '/' + staffEmail.value + '/' + staffUID.value
            + '/' + staffPW.value + '/' + staffPhone.value
            + '/' + staffAdd.value + '/' + staffEmployed.value + '/0'
        );
        console.log($('#btnStaffEditLink').attr('href'));
    });

    $("form").on('submit', function (e) {
        //stop form submission
        e.preventDefault();
        var error = 0;
        var nameReg = /[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ ]+$/;
        var usernameReg = /^[A-Za-z0-9]+$/;
        var phoneReg = /^[0-9]{10}$/;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var addressReg = /[-0-9a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ ]+$/;
        var pwReg = /^[A-Za-z0-9]{5,}$/;

        var name = $('#staffName').val();
        var email = $('#staffEmail').val();
        var username = $('#staffUID').val();
        var pwd = $('#staffPW').val();
        var phone = $('#staffPhone').val();
        var address = $('#staffAdd').val();
        var role = $('#staffRole').val();
        var employed = $('#staffEmployed').val();

        var inputVal = new Array(name, email, username, pwd, phone, address);
        // console.log(inputVal[5]);

        var inputMessage = new Array("Tên", "email", "username", "mật khẩu", "điện thoại", "địa chỉ");

        $('.error').hide();

        //name
        if (inputVal[0] == "") {
            $('#staffName').after(
                '<span class="errorm"> Vui lòng nhập ' + inputMessage[0] + '</span>');
            error = error + 1;
        }
        else if (!nameReg.test(inputVal[0])) {
            $('#staffName').after('<span class="errorm">Chỉ chữ</span>');
            error = error + 1;
        }

        //email
        if (inputVal[1] == "") {
            $('#staffEmail').after('<span class="errorm"> Vui lòng nhập ' + inputMessage[1] + '</span>');
            error = error + 1;
        }
        else if (!emailReg.test(inputVal[1])) {
            $('#staffEmail').after('<span class="errorm">Vui lòng nhập email đúng</span>');
            error = error + 1;
        }

        //username
        if (inputVal[2] == "") {
            $('#staffUID').after('<span class="errorm"> Vui lòng nhập ' + inputMessage[2] + '</span>');
            error = error + 1;
        }
        else if (!usernameReg.test(inputVal[2])) {
            $('#staffUID').after('<span class="errorm">Chỉ chữ và số</span>');
            error = error + 1;
        }

        //pwd
        if (inputVal[3] == "") {
            $('#staffPW').after('<span class="errorm"> Vui lòng nhập ' + inputMessage[3] + '</span>');
            error = error + 1;
        }
        else if (!pwReg.test(inputVal[3])) {
            $('#staffPW').after('<span class="errorm">Chỉ chữ và số, ít nhất 5 ký tự</span>');
            error = error + 1;
        }

        //phone
        if (inputVal[4] == "") {
            $('#staffPhone').after('<span class="errorm"> Vui lòng nhập ' + inputMessage[4] + '</span>');
            error = error + 1;
        }
        else if (!phoneReg.test(inputVal[4])) {
            $('#staffPhone').after('<span class="errorm">Chỉ số</span>');
            error = error + 1;
        }

        //address
        if (inputVal[5] == "") {
            $('#staffAdd').after('<span class="errorm"> Vui lòng nhập ' + inputMessage[5] + '</span>');
            error = error + 1;
        }
        else if (!addressReg.test(inputVal[5])) {
            $('#staffAdd').after('<span class="errorm">Vui lòng kiểm tra</span>');
            error = error + 1;
        }

        if (error == 0) {
            $('#btnStaffEditLink').click();
        }
        // $('#btnStaffEditLink').click();
        $(".errorm").delay(1750)
            .hide(500)
            .queue(function () {
                $(this).remove();
            });
    });
});