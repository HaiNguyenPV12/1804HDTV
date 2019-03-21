var oldMName = $("#memName").val();
var oldMEmail = $("#memEmail").val();
var oldMPhone = $("#memPhone").val();
var oldMAddress = $("#memAddress").val();
var oldMUID = $("#memUID").val();
var oldMUPW = $("#memUPW").val();

function closeModal(){
    $('#modal').modal('hide');
    $('#result').modal('hide');
}

function clearModal(){
    $('#modal').html('');
    $('#result').html('');
}
//reload để load lại dữ liệu từ sql
function reloadPage(){   
    location.reload();
    //angular.element('#myMain').scope().reloadData();
}

//Reset khi tắt modal add
$('#modal').on('hidden.bs.modal', function (e) {
    //clearModal();
    reloadPage();
});


var request;
//Nếu form submit
$("#frmEditMember").submit(function(event){
    // Ngừng submit mặc định (tránh việc load lại trang trước khi thực hiện các lệnh khác)
    event.preventDefault();
    if (request) {
        request.abort();
    }
    if ($("#memName").val()==oldMName && $("#memEmail").val()==oldMEmail && $("#memPhone").val()==oldMPhone && $("#memAddress").val()==oldMAddress && $("#memUID").val()==oldMUID && $("#memUPW").val()==oldMUPW )  {
        $("#txtResult").html("<h2>Không có gì thay đổi!</h2>");
        $('#result').modal('show'); 
        window.setTimeout(closeModal, 1500);
        window.setTimeout(reloadPage,500);
    }else{
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
                $("#txtResult").removeClass("text-danger");
                $("#txtResult").addClass("text-success");
                $("#txtResult").html("<h2>Chỉnh sửa thành công!</h2>");
                $('#result').modal('show'); 
                window.setTimeout(closeModal, 1500);
                window.setTimeout(reloadPage,500);
            }else{
                // Nếu dữ liệu trả về bị bất kì lỗi gì
                $("#txtResult").removeClass("text-success");
                $("#txtResult").addClass("text-danger");   
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