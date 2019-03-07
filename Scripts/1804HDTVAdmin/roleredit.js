// 
function closeModal(){
    $('#modal').modal('hide');
    $('#result').modal('hide');
}

// Reload để load lại dữ liệu từ sql
function reloadPage(){   
    location.reload(true);
}

// Reset khi tắt modal
$('#modal').on('hidden.bs.modal', function (e) {
    reloadPage();
});

// Khi nhấn vào hoa nào thì hoa đó sẽ bị loại ra
$(document).on("click","#right_list button",function(){
    var rid=$(this).find("[name='rid']").val();
    var rname=$(this).find("[name='rname']").val();
    $("#right_list_not").append(
        '<button type="button" name="r_item_not" class="list-group-item list-group-item-info d-flex justify-content-between align-items-center py-2">'+rname+
        '<input name="rinsertid" type="hidden" value="'+rid+'">'+
        '<input name="rinsertname" type="hidden" value="'+rname+'">'+
        '</button>'
    );
    $(this).remove();
});

$(document).on("click","#right_list_not button",function(){
    var rinsertid=$(this).find("[name='rinsertid']").val();
    var rinsertname=$(this).find("[name='rinsertname']").val();
    console.log(rinsertid+":"+rinsertname);
    $("#right_list").append(
        '<button type="button" name="r_item_not" class="list-group-item list-group-item-info d-flex justify-content-between align-items-center py-2">'+rinsertname+
        '<input name="rid" type="hidden" value="'+rinsertid+'">'+
        '<input name="rname" type="hidden" value="'+rinsertname+'">'+
        '<input name="rdata[]" type="hidden" value="'+rinsertid+'">'+
        '</button>'
    );
    $(this).remove();
});
/*
// Thêm hoa vào danh sách
$("#cmdAddRPosition").click(function(e){
    // Gán các giá trị cho dễ gọi
    var rinsertID = $("#rinsert :selected").val();
    var rinsertname = $("#rinsert :selected").html();

    // Kiểm tra xem có trong danh sách trên chưa
    if (($("#right_list").html()).indexOf(rinsertID)!=-1) {
        alert("Đã có quyền này rồi");
    }else{
        $("#right_list").append(
            '<button name="r_item" class="list-group-item list-group-item-info d-flex justify-content-between align-items-center py-2">'+rinsertname+
            '<input name="rdata[]" type="hidden" value="'+rinsertID+'"></button>'
        );
    }
});
*/

//=========================== Xử lý submit dữ liệu =================================//
var request;
//Nếu form submit
$('#frmEditRoleR').submit(function(event){
    // Ngừng submit mặc định
    event.preventDefault();
    if (request) {
        request.abort();
    }

    // đặt tên cho dễ
    var $form = $(this);

    // Chọn tất cả trừ cái bid (bid mặc định đã disabled)
    var $inputs = $form.find("input, select, button, textarea").not("#bid");

    // Mã hóa để đưa dữ liệu qua post
    var serializedData = $form.serialize();

    // Disabled tất cả các input khi dữ liệu đang dưa lên
    $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "./Pages/process.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        //alert(textStatus);
        if (response=="ok") {
            $("#txtResult").addClass("text-success");
            $("#txtResult").html("<h2>Chỉnh sửa thành công!</h2>");
            $('#result').modal('show');
            window.setTimeout(closeModal, 1500);
            //window.setTimeout(reloadPage,500);
        }else{
            $("#txtResult").addClass("text-danger");
            $("#txtResult").html(response);
            $('#result').modal('show');
        }
        
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
        
    });

});