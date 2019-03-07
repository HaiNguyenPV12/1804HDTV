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

// Khi nhấn vào màu nào thì màu đó sẽ bị loại ra
$(document).on("click","#color_list button",function(){
    var cid=$(this).find("[name='cid']").val();
    var cname=$(this).find("[name='cname']").val();
    $("#color_list_not").append(
        '<button type="button" name="c_item_not"'+
        'class="list-group-item d-flex justify-content-between align-items-center py-2 c-'+
        cid+'">'+cname+
        '<input name="cinsertid" type="hidden" value="'+cid+'">'+
        '<input name="cinsertname" type="hidden" value="'+cname+'">'+
        '</button>'
    );
    $(this).remove();
});

// Khi nhấn vào màu ở danh sách bên phải, nó sẽ thêm vào danh sách đang có
$(document).on("click","#color_list_not button",function(){
    var cinsertid=$(this).find("[name='cinsertid']").val();
    var cinsertname=$(this).find("[name='cinsertname']").val();
    console.log(cinsertid+":"+cinsertname);
    $("#color_list").append(
        '<button type="button" name="r_item_not"'+
        'class="list-group-item d-flex justify-content-between align-items-center py-2 c-'+
        cinsertid+'">'+cinsertname+
        '<input name="cid" type="hidden" value="'+cinsertid+'">'+
        '<input name="cname" type="hidden" value="'+cinsertname+'">'+
        '<input name="cdata[]" type="hidden" value="'+cinsertid+'">'+
        '</button>'
    );
    $(this).remove();
});


//=========================== Xử lý submit dữ liệu =================================//
var request;
//Nếu form submit
$('#frmFlowerColor').submit(function(event){
    // Ngừng submit mặc định
    event.preventDefault();
    if (request) {
        request.abort();
    }

    // đặt tên cho dễ
    var $form = $(this);

    // Chọn tất cả input để tắt
    var $inputs = $form.find("input, select, button, textarea");

    // Mã hóa để đưa dữ liệu qua post
    var serializedData = $form.serialize();

    // Disabled tất cả các input khi dữ liệu đang dưa lên
    $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "process.php",
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