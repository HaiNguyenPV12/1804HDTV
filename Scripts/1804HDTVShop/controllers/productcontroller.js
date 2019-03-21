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

    //=========================== Xử lý submit dữ liệu =================================//
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


});