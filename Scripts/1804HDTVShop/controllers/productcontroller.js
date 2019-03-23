app.controller('productcontroller', function ($scope, $location, $anchorScroll, $timeout) {
    document.title = '1804HDTV Shop';

    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds

    $(".thumbnail").on("click", function() {
        if (!$(this).hasClass("selected")) {
            var clicked = $(this);
            var newSelection = clicked.data('big');
            var $img = $('.primary').css("background-image", "url(" + newSelection + ")");
            clicked.parent().find('.thumbnail').removeClass('selected');
            clicked.addClass('selected');
            $('.primary').empty().append($img.hide().fadeIn('fast'));
        }
    });

    $('#modal').on('hidden.bs.modal', function (e) {
        
    });

    function closeModal(){
        $('#result').modal('hide');
    }

    function reloadPage(){
        location.reload();
    }

    //=========================== Xử lý submit dữ liệu giỏ hàng =================================//
    //var request;
    //Nếu form submit
    $('#cmdAddToCart').click(function(){
        // Ngừng submit mặc định (tránh việc load lại trang trước khi thực hiện các lệnh khác)
        //event.preventDefault();
        var myFormData = new FormData();
        myFormData.append('add', "");
        myFormData.append('bid', $("#bid").val());
        myFormData.append('quan', $("#quantity").val());
        // Bắt đầu đưa dữ liệu qua trang xử lý
        request = $.ajax({
            url: "cart_process.php",
            type: "post",
            data: myFormData,
            processData: false,
            contentType: false
        });

        // Nếu việc truyền dữ liệu xảy ra ổn thỏa (ý là đã submit qua đó thành công)
        request.done(function (response, textStatus, jqXHR){
            // Nếu dữ liệu trả về là "ok" (nghĩa là đã xử lý tốt các dữ liệu, không bị lỗi gì khác)
            if (response=="ok") {
                $("#txtResult").addClass("text-success");
                $("#txtResult").html("<h2>Thêm vào giỏ hàng thành công!</h2>");
                // Hiện modal hiển thị kết quả
                $('#result').modal('show');
                window.setTimeout(closeModal, 1500);

            }else{
                // Nếu dữ liệu trả về bị bất kì lỗi gì
                $("#txtResult").html(response);
                $('#result').modal('show');
            }
            
        });

        // Nếu việc truyền dữ liệu qua file xử lý bị lỗi
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Ghi lại trong console để sửa
            console.error(
                "Lỗi khi truyền dữ liệu: "+
                textStatus, errorThrown
            );
        });

        // Dù việc truyền dữ liệu bị lỗi hay không thì cũng phải enable lại input
        request.always(function () {
            //$inputs.prop("disabled", false);
        });
    });

    function showAlert(str){
        $('#txtResult').attr('class','text-danger text-center');
        $("#txtResult").html("<h4>"+str+"</h4>");
        $('#result').modal('show');
        window.setTimeout(closeModal, 1500);
    }

    //=========================== Xử lý submit dữ liệu bình luận =================================//
    //var request;
    //Nếu form submit
    $('#cmdAddComment').click(function(){
        // Ngừng submit mặc định (tránh việc load lại trang trước khi thực hiện các lệnh khác)
        //event.preventDefault();
        var cmName = $("#txtName").val();
        var cmPhone = $("#txtPhone").val();
        var cmEmail = $("#txtEmail").val();
        var cmDetail = $("#txtDetail").val();
        var bid = $("#cmbid").val();
        if (cmName=="") {
            showAlert("Hãy nhập Tên");
            $("#txtName").focus();
            return;
        }
        if (cmPhone=="") {
            showAlert("Hãy nhập Số điện thoại");
            $("#txtPhone").focus();
            return;
        }
        if (cmPhone.length <10 || cmPhone.length >11) {
            showAlert("Hãy nhập đúng Số điện thoại (10-11 số)");
            $("#txtPhone").focus();
            return;
        }
        if (cmEmail=="") {
            showAlert("Hãy nhập Email");
            $("#txtEmail").focus();
            return;
        }
        if (cmDetail=="") {
            showAlert("Hãy nhập nội dung Bình Luận");
            $("#txtDetail").focus();
            return;
        }


        var myFormData = new FormData();
        myFormData.append('comment', "");
        myFormData.append('name', cmName);
        myFormData.append('phone', cmPhone);
        myFormData.append('email', cmEmail);
        myFormData.append('detail', cmDetail);
        myFormData.append('bid', bid);
        // Bắt đầu đưa dữ liệu qua trang xử lý
        request = $.ajax({
            url: "comment_process.php",
            type: "post",
            data: myFormData,
            processData: false,
            contentType: false
        });

        // Nếu việc truyền dữ liệu xảy ra ổn thỏa (ý là đã submit qua đó thành công)
        request.done(function (response, textStatus, jqXHR){
            // Nếu dữ liệu trả về là "ok" (nghĩa là đã xử lý tốt các dữ liệu, không bị lỗi gì khác)
            if (response=="ok") {
                $('#txtResult').attr('class','text-success');
                $("#txtResult").html("<h4>Gửi bình luận thành công! Hãy chờ bình luận của bạn được duyệt.</h4>");
                // Hiện modal hiển thị kết quả
                $('#result').modal('show');
                window.setTimeout(closeModal, 1500);
                window.setTimeout(reloadPage, 1500);
            }else{
                // Nếu dữ liệu trả về bị bất kì lỗi gì
                $('#txtResult').attr('class','text-danger');
                $("#txtResult").html("<h4>"+response+"</h4>");
                $('#result').modal('show');
            }
            
        });

        // Nếu việc truyền dữ liệu qua file xử lý bị lỗi
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Ghi lại trong console để sửa
            console.error(
                "Lỗi khi truyền dữ liệu: "+
                textStatus, errorThrown
            );
        });

        // Dù việc truyền dữ liệu bị lỗi hay không thì cũng phải enable lại input
        request.always(function () {
            //$inputs.prop("disabled", false);
        });
    });
});