
// Function tắt bảng Modal
function closeModal(){
    $('#modal').modal('hide');
    $('#result').modal('hide');
}

// Function reload lại trang để cập nhật lại dữ liệu từ sql
function reloadPage(){   
    location.reload(true);
}


// Khi Modal tắt sẽ gọi function xóa các input
$('#modal').on('hidden.bs.modal', function (e) {
    $("#frmAddRole")[0].reset();
});


//=========================== Xử lý submit dữ liệu =================================//
var request;
//Nếu form submit
$('#frmAddRole').submit(function(event){
    // Ngừng submit mặc định (tránh việc load lại trang trước khi thực hiện các lệnh khác)
    event.preventDefault();
    if (request) {
        request.abort();
    }

    // đặt lại tên form cho dễ gọi :))
    var $form = $(this);
    // Chọn tất cả input trừ cái bid để disable (bid mặc định đã disabled)
    var $inputs = $form.find("input, select, button, textarea");
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
            $("#txtResult").addClass("text-success");
            $("#txtResult").html("<h2>Thêm vào thành công!</h2>");
            // Hiện modal hiển thị kết quả
            $('#result').modal('show');
            // Cho tự động tắt và load lại trang sau vài giây
            window.setTimeout(closeModal, 1500);
            window.setTimeout(reloadPage,500);
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
        $inputs.prop("disabled", false);
    });
});