app.controller('cartcontroller', function ($scope, $location, $anchorScroll, $timeout) {
    document.title = 'Giỏ hàng';
    //scroll to top on load
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds

    function reloadPage(){
        location.reload();
    }
    
     //=========================== Xử lý submit dữ liệu giỏ hàng =================================//
    //var request;
    //Nếu form submit
    $('[name=btnDel]').click(function(){
        // Ngừng submit mặc định (tránh việc load lại trang trước khi thực hiện các lệnh khác)
        //event.preventDefault();
        var bid = $(this).find("#bid").val();

        var myFormData = new FormData();
        myFormData.append('delete', "");
        myFormData.append('bid', bid);
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
                $("#txtResult").html("<h2>Xóa sản phẩm thành công!</h2>");
                // Hiện modal hiển thị kết quả
                $('#result').modal('show');
                window.setTimeout(reloadPage, 1000);

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