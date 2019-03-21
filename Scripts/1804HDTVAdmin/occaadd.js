$(document).ready(function () {
    //scroll to top
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds
    //default values
    $('#btnOccaAddLink').attr('href', '#!occasion/edit/update/' + occaID.value
        + '/' + 0 + '/' + occaName.value + '/' + occaDetail.value
        + '/' + occaFP.value + '/1'
    );
    console.log($('#btnOccaAddLink').attr('href'));
    $('#occaAddForm').change(function (e) {
        e.preventDefault();
        $('#btnOccaAddLink').attr('href', '#!occasion/edit/update/' + occaID.value
            + '/' + 0 + '/' + occaName.value + '/' + occaDetail.value
            + '/' + occaFP.value + '/1'
        );
        console.log($('#btnOccaAddLink').attr('href'));
    });
    $("form").on('submit', function (e) {
        //stop form submission
        e.preventDefault();
        var error = 0;
        var idReg = /^[A-Z]{0,10}$/;
        var nameReg = /[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ ]{1,45}$/;
        var detailReg = /[0-9a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ ]+$/;

        var id = $('#occaID').val();
        var name = $('#occaName').val();
        var detail = $('#occaDetail').val();

        var inputVal = new Array(id, name, detail);
        console.log(inputVal[0]);

        var inputMessage = new Array("ID", "Tên", "Thông Tin Dịp");

        $('.error').hide();

        //id
        if (inputVal[0] == "") {
            $('#occaID').after(
                '<span class="errorm"> Vui lòng nhập ' + inputMessage[0] + '</span>');
            error = error + 1;
        }
        else if (!idReg.test(inputVal[0])) {
            $('#occaID').after('<span class="errorm"> Chỉ 10 Ký Tự Hoa.</span>');
            error = error + 1;
        }

        //name
        if (inputVal[1] == "") {
            $('#occaName').after('<span class="errorm"> Vui lòng nhập ' + inputMessage[1] + '</span>');
            error = error + 1;
        }
        else if (!nameReg.test(inputVal[1])) {
            $('#occaName').after('<span class="errorm">Chỉ chữ, tối đa 45 ký tự.</span>');
            error = error + 1;
        }

        //detail
        if (inputVal[2] == "") {
            $('#occaDetail').after('<span class="errorm"> Vui lòng nhập ' + inputMessage[2] + '</span>');
            error = error + 1;
        }
        else if (!detailReg.test(inputVal[2])) {
            $('#occaDetail').after('<span class="errorm"> Chỉ chữ và số</span>');
            error = error + 1;
        }

        if (error == 0) {
            $('#btnOccaAddLink').click();
        }
        // $('#btnStaffEditLink').click();
        $(".errorm").delay(1750)
            .hide(500)
            .queue(function () {
                $(this).remove();
            });
    });

});