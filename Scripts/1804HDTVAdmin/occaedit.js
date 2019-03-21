$(document).ready(function () {
    //scroll to top
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds
    //default values
    $('#btnOccaEditLink').attr('href', '#!occasion/edit/update/' + occaID.value
        + '/' + occaIDnew.value + '/' + occaName.value + '/' + occaDetail.value
        + '/' + occaFP.value + '/0'
    );
    console.log($('#btnOccaEditLink').attr('href'));
    $('#occaEditForm').change(function (e) {
        e.preventDefault();
        $('#btnOccaEditLink').attr('href', '#!occasion/edit/update/' + occaID.value
            + '/' + occaIDnew.value + '/' + occaName.value + '/' + occaDetail.value
            + '/' + occaFP.value + '/0'
        );
        console.log($('#btnOccaEditLink').attr('href'));
    });
    $("form").on('submit', function (e) {
        //stop form submission
        e.preventDefault();
        var error = 0;
        var idReg = /^[A-Z]{0,10}$/;
        var nameReg = /[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ ]{1,45}$/;
        var detailReg = /[\p{L}\s\d]+$/;

        var id = $('#occaIDnew').val();
        var name = $('#occaName').val();
        var detail = $('#occaDetail').val();

        var inputVal = new Array(id, name, detail);
        console.log(inputVal[0]);

        var inputMessage = new Array("ID", "Tên", "Thông Tin Dịp");

        $('.error').hide();

        //id
        if (inputVal[0] == "") {
            $('#occaIDnew').after(
                '<span class="errorm"> Vui lòng nhập ' + inputMessage[0] + '</span>');
            error = error + 1;
        }
        else if (!idReg.test(inputVal[0])) {
            $('#occaIDnew').after('<span class="errorm">Chỉ 10 Ký Tự Hoa.</span>');
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
            $('#occaDetail').after('<span class="errorm">Chỉ chữ và số</span>');
            error = error + 1;
        }

        if (error == 0) {
            $('#btnOccaEditLink').click();
        }
        // $('#btnStaffEditLink').click();
        $(".errorm").delay(1750)
            .hide(500)
            .queue(function () {
                $(this).remove();
            });
    });

});