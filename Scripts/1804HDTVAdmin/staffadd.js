$(document).ready(function () {
    //scroll to top
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds
    //default values
    $('#btnStaffAddLink').attr('href', '#!staff/edit/update/' + staffID.value
        + '/' + staffName.value + '/' + staffRole.value
        + '/' + staffEmail.value + '/' + staffUID.value
        + '/' + staffPW.value + '/' + staffPhone.value
        + '/' + staffAdd.value + '/' + staffEmployed.value + '/1'
    );
    console.log($('#btnStaffAddLink').attr('href'));
    $('#staffAddForm').change(function (e) {
        e.preventDefault();
        $('#btnStaffAddLink').attr('href', '#!staff/edit/update/' + staffID.value
            + '/' + staffName.value + '/' + staffRole.value
            + '/' + staffEmail.value + '/' + staffUID.value
            + '/' + staffPW.value + '/' + staffPhone.value
            + '/' + staffAdd.value + '/' + staffEmployed.value + '/1'
        );
        console.log($('#btnStaffAddLink').attr('href'));
    });

    $("form").on('submit', function (e) {
        //stop form submission
        e.preventDefault();
        var error = 0;
        var nameReg = /[^a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ ]+$/u;
        var usernameReg = /^[A-Za-z0-9]+$/;
        var phoneReg = /^[0-9]{10}$/;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var addressReg = /[^0-9a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ ]+$/u;

        var name = $('#staffName').val();
        var email = $('#staffEmail').val();
        var username = $('#staffUID').val();
        var pwd = $('#staffPW').val();
        var phone = $('#staffPhone').val();
        var address = $('#staffAdd').val();
        var role = $('#staffRole').val();
        var employed = $('#staffEmployed').val();

        var inputVal = new Array(name, email, username, pwd, phone, address, role, employed);
        // console.log(inputVal[5]);

        var inputMessage = new Array("Tên", "email", "username", "mật khẩu", "điện thoại", "địa chỉ");

        $('.error').hide();

        //name
        if (inputVal[0] == "") {
            $('#staffName').after(
                '<span> Vui lòng nhập ' + inputMessage[0] + '</span>');
            error = error + 1;
        }
        else if (!nameReg.test(name)) {
            $('#staffName').after('<span>Chỉ chữ</span>');
            error = error + 1;
        }

        //email
        if (inputVal[1] == "") {
            $('#staffEmail').after('<span> Vui lòng nhập ' + inputMessage[1] + '</span>');
            error = error + 1;
        }
        else if (!emailReg.test(email)) {
            $('#staffName').after('<span>Vui lòng nhập email đúng</span>');
            error = error + 1;
        }

        //username
        if (inputVal[2] == "") {
            $('#staffUID').after('<span> Vui lòng nhập ' + inputMessage[2] + '</span>');
            error = error + 1;
        }
        else if (!usernameReg.test(username)) {
            $('#staffUID').after('<span>Chỉ chữ và số</span>');
            error = error + 1;
        }

        //pwd
        if (inputVal[3] == "") {
            $('#staffPW').after('<span> Vui lòng nhập ' + inputMessage[3] + '</span>');
            error = error + 1;
        }
        else if (!usernameReg.test(pwd)) {
            $('#staffPW').after('<span>Chỉ chữ và số</span>');
            error = error + 1;
        }

        //phone
        if (inputVal[4] == "") {
            $('#staffPhone').after('<span> Vui lòng nhập ' + inputMessage[4] + '</span>');
            error = error + 1;
        }
        else if (!phoneReg.test(phone)) {
            $('#staffPhone').after('<span>Chỉ 10 số</span>');
            error = error + 1;
        }

        //address
        if (inputVal[5] == "") {
            $('#staffPhone').after('<span> Vui lòng nhập ' + inputMessage[5] + '</span>');
            error = error + 1;
        }
        else if (!addressReg.test(address)) {
            $('#staffPhone').after('<span>Vui lòng kiểm tra</span>');
            error = error + 1;
        }

        if (error == 0) {
            $('#btnStaffAddLink').click();
        }
        // $('#btnStaffEditLink').click();
    });
});