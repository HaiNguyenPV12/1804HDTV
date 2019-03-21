// Script tùy chỉnh của trang bouquetedit.php

// Khởi tạo các giá trị cũ để so sánh có thay đổi hay không khi nhấn Lưu
var bid_old = $("#bid").val();
var bname_old = $("#bname").val();
var bprice_old = $("#bprice").val();
var bdetail_old = $("#bdetail").val();
var bselling_old;
if ($("#bselling").is(":checked")) {
    bselling_old = 1;
}else{
    bselling_old = 0;
}
// Vì sao ở đây không dùng lệnh xóa input giống bouquetadd.js??
// --> Vì các dữ liệu ở các input mặc định đã là những dữ liệu có sẵn lấy từ database (gán qua php)
//     khi reset, nó không đưa về trống, mà đưa về dữ liệu ban đầu

// Function tắt bảng Modal
function closeModal(){
    $('#result').modal('hide');
    $('#modal').modal('hide');
    $('.modal-backdrop').remove();
    //reloadPage();
}

//reload để load lại dữ liệu từ sql
function reloadPage(){   
    //location.reload();
    //$(location).attr('href',"#!bouquet?reload=true");
    window.location.reload(true);
}

// Reset khi tắt modal
$('#modal').on('hidden.bs.modal', function (e) {
    //$("#frmEditBouquet")[0].reset();
    reloadPage();
});

//=========================== Xử lý submit dữ liệu =================================//
var request;
//Nếu form submit
$("#frmEditBouquet").submit(function(event){
    // Ngừng submit mặc định (tránh việc load lại trang trước khi thực hiện các lệnh khác)
    event.preventDefault();
    if (request) {
        request.abort();
    }
    var bselling;
    if ($("#bselling").is(":checked")) {
        bselling=1; 
    }else{
        bselling=0;
    }
    // Kiểm tra xem dữ liệu có thay đổi không
    if ($("#bid").val()== bid_old && $("#bname").val()==bname_old && $("#bprice").val()==bprice_old && $("#bdetail").val()==bdetail_old && bselling==bselling_old) {
    // Nếu không thay đổi
        $("#txtResult").addClass("text-success");
        $("#txtResult").html("<h2>Không có thay đổi!</h2>");
        $('#result').modal('show'); 
        window.setTimeout(closeModal, 1000);
        window.setTimeout(reloadPage,2500);
    }else{
    // Nếu có thay đổi
        // đặt lại tên form cho dễ gọi :))
        var $form = $(this);
        // Chọn tất cả input trừ cái bid để disable (bid mặc định đã disabled)
        var $inputs = $form.find("input, select, button, textarea").not("#bid");
        // Mã hóa để đưa dữ liệu qua post
        var serializedData = $form.serialize();

        // Disabled tất cả các input khi dữ liệu đang submit
        $inputs.prop("disabled", true);

        // Bắt đầu đưa dữ liệu qua trang xử lý
        request = $.ajax({
            url: "process.php",
            type: "post",
            data: serializedData
        });

        // Nếu việc truyền dữ liệu xảy ra ổn thỏa (ý là đã submit qua đó thành công)
        request.done(function (response, textStatus, jqXHR){
            // Nếu dữ liệu trả về là "ok" (nghĩa là đã xử lý tốt các dữ liệu, không bị lỗi gì khác)
            if (response=="ok") {
                // Những lệnh dưới là gì?? --> Xem lại bouquetadd.js
                $("#txtResult").addClass("text-success");
                $("#txtResult").html("<h2>Chỉnh sửa thành công!</h2>");
                $('#result').modal('show'); 
                window.setTimeout(closeModal, 1000);
                window.setTimeout(reloadPage,2500);
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
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });

        // Dù việc truyền dữ liệu bị lỗi hay không thì cũng phải enable lại input
        request.always(function () {
            $inputs.prop("disabled", false);
        });
    }
});