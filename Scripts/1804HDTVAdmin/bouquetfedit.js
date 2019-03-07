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
$(document).on("click","#flower_list button",function(){
    $(this).remove();
 });

// Thêm hoa vào danh sách
$("#cmdAddFBouquet").click(function(e){
    // Kiểm tra có quan chưa
    if ($("#finsertquan").val()>0) {
        // Gán các giá trị cho dễ gọi
        var finsertID = $("#finsert :selected").val();
        var finsertname = $("#finsert :selected").html();
        var finsertquan = $("#finsertquan").val();

        // Kiểm tra xem có trong danh sách trên chưa
        if (($("#flower_list").html()).indexOf(finsertID)!=-1) {
            //alert("Đã có hoa này rồi");
            $("button[name=flower_item]").each(function(i,data){
                if (($(this).html()).indexOf(finsertID)!=-1) {
                    var foldquan = $(this).find("[name=fquan]");
                    var fnewquan = +foldquan.html() + +finsertquan;
                    //consolelog(fnewquan);
                    var fdata = $(this).find("[name='fdata[]']");
                    //console.log(fdata.val());

                    foldquan.html(fnewquan);
                    fdata.val(finsertID+":"+fnewquan)
                    return;
                }
            });
            //return;
        }else{
            $("#flower_list").append(
                '<button name="flower_item" class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">'+finsertname+
                '  <span name="fquan" class="badge badge-info badge-pill">'+finsertquan+'</span>'+
                '<input name="fdata[]" type="hidden" value="'+finsertID+':'+finsertquan+'"></button>'
            );
        }
    }else{
        alert('Hãy nhập số lượng!');
    }
    
    
    $("#finsertquan").val("1");
});

//=========================== Xử lý submit dữ liệu =================================//
var request;
//Nếu form submit
$('#frmEditFBouquet').submit(function(event){
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
            window.setTimeout(reloadPage,500);
        }else{
            //$("#txtResult").addClass("text-success");
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