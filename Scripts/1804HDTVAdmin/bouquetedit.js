// Script tùy chỉnh của trang bouquetedit.php

var editimglist = [];
var editimgremoved = [];
$("#editimgPreview").find("[name='imgold[]']").each(function(i,data){
    //console.log($(this).find("#imgnum").val());
    editimglist.push($(this).find("#imgnum").val());
});

// Khởi tạo các giá trị cũ để so sánh có thay đổi hay không khi nhấn Lưu
var editbid_old = $("#editbid").val();
var editbname_old = $("#editbname").val();
var editbprice_old = $("#editbprice").val();
var editbpriceshow_old = $("#editbpriceshow").val();
var editbdetail_old = $("#editbdetail").val();
var editbselling_old;
if ($("#editbselling").is(":checked")) {
    editbselling_old = 1;
}else{
    editbselling_old = 0;
}
var editimgPreview_old = $("#editimgPreview").html();

$("#cmdResetEditBouquet").click(function(){
    $("#editbid").val(editbid_old);
    $("#editbname").val(editbname_old);
    $("#editbprice").val(editbprice_old);
    $("#editbpriceshow").val(editbpriceshow_old);
    $("#editbdetail").val(editbdetail_old);
    $("#editimgPreview").html(editimgPreview_old);
    if (editbselling_old==1) {
        $('#editbselling').prop('checked', true);
    }else{
        $('#editbselling').prop('checked', false);
    }
    editimgremoved = [];
});

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
    //reloadPage();
});

$(document).on("click","#editimgPreview div[name='imgshow[]']",function(){
    var n = $(this).find("#imgnum").val();
    if (n) {
        //console.log(n);
        editimglist = editimglist.filter(e=>e!=n);
    }
    //console.log(imglist);
    $(this).remove();
});

$(document).on("click","#editimgPreview div[name='imgold[]']",function(){
    var n = $(this).find("#imgnum").val();
    var imgid = $(this).find("#imgid").val();
    if (n) {
        //console.log(n);
        editimglist = editimglist.filter(e=>e!=n);
        editimgremoved.push(n);
        $("#editimgPreview").append("<input type='hidden' name='imgremove[]' value='"+imgid+"'>");
    }
    //console.log(imglist);
    //console.log(imgremoved);
    $(this).remove();
});

$('#editbprice').keyup(function(event){
    var bprice = $(this).val();
    var bpriceshow ="";
    if (bprice.length>8) {
        bprice = bprice.substring(0,8);
        //$(this).val(bprice);
    }
    if (bprice>10000000) {
        bprice = "10000000";
        //$(this).val(bprice);
    }
    if (bprice>=1000000) {
        bpriceshow = bprice.substring(0,bprice.length-6);
        bpriceshow+=".";
        bpriceshow+= bprice.substring(bprice.length-6,bprice.length-3);
        bpriceshow+=".";
        bpriceshow+= bprice.substring(bprice.length-3,bprice.length);
    }else if (bprice>=1000) {
        bpriceshow = bprice.substring(0,bprice.length-3);
        bpriceshow+=".";
        bpriceshow+= bprice.substring(bprice.length-3,bprice.length);
    }else{
        bpriceshow = bprice;
    }
    //bpriceshow += " VNĐ";
    $(this).val(parseInt(bprice));
    $("#editbpriceshow").val(bpriceshow+" VNĐ");
});

$("#editimgfile").change(function(){
    if (editimglist.length<5) {
        if ($(this).get(0).files.length<=(5-editimglist.length)) {
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                var bid;
                //console.log("imglist: "+imglist.length);
                if (editimglist.length==0) {
                    bid=0;
                }else{ 
                    for (var j = 0; j < 5; j++) {
                        const found = editimglist.some(el => el == j);
                        if (!found) {
                            bid=j;
                            break;
                        }
                    }
                }
                //console.log(bid);
                // Bắt đầu function upload hình (và đưa nó ra phần hiển thị mẫu)
                uploadFile($(this).get(0).files[i],"bouquetadd",$("#editbid").val(), bid);
                editimglist.push(bid);
                // Đưa tên file ra hiển thị
                $("#editimgfiletext").html("Đã có "+editimglist.length+" hình.");
            }
            $(this).val("");
        }else{
            alert("Không thể quá 5 hình! Chỉ có thể tải lên "+(5-editimglist.length)+" hình nữa!");
            $(this).val("");
        }
    }else{
        alert("Không thể thêm quá 5 hình!");
        $(this).val("");
        //alert($(this).get(0).files.length);
    }
});

//=========================== Xử lý upload hình =================================//
function uploadFile(file,uploadTo,id, bid){
    var request;
    //var $form = $("#frmImgAdd");
    //var $inputs = $form.find("fimgfile, button");

    // Làm theo cách thủ công hơn, tạo form data thủ công
    var myFormData = new FormData();
    // Đưa từng giá trị vào form data
    myFormData.append('imgfile', file); // file từ input
    myFormData.append('uploadTo', uploadTo); 
    myFormData.append('id', id); 
    myFormData.append('bid', bid); 
    //myFormData.append('fid', $("#fid").val()); 
    //myFormData.append('fimg', $("#fimg").val());
    //myFormData.append('cmdFImgUpload', "");

    //$inputs.prop("disabled", true);

    // Thực hiện đưa qua trang xử lý
    request = $.ajax({
        url: "imgupload.php",
        type: "post",
        data: myFormData,
        processData: false,
        contentType: false
    });
    // Xong rồi thì đưa ra hiện hình mẫu
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        //alert(textStatus);
        $("#editimgPreview").append(response); 
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
        //$inputs.prop("disabled", false);
    });
}

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
    var imgchanged;
    if ($("#editbselling").is(":checked")) {
        bselling=1; 
    }else{
        bselling=0;
    }
    if ($("#editimgPreview").find("[name='img[]']").length|| editimgremoved.length>0) {
        imgchanged=true;
    }else{
        imgchanged=false;
    }

    if (!$("[name='imgshow[]']").length && !$("[name='imgold[]']").length) {
        alert("Chưa có hình!");
        $("#editimgfile").focus();
        return;
    }
    
    // Kiểm tra xem dữ liệu có thay đổi không
    if ($("#editbid").val()== editbid_old && $("#editbname").val()==editbname_old && $("#editbprice").val()==editbprice_old && $("#editbdetail").val()==editbdetail_old && bselling==editbselling_old &&imgchanged==false) {
    // Nếu không thay đổi
        $("#txtResult").addClass("text-success");
        $("#txtResult").html("<h2>Không có thay đổi!</h2>");
        $('#result').modal('show'); 
        window.setTimeout(closeModal, 1000);
        //window.setTimeout(reloadPage,2500);
    }else{
    // Nếu có thay đổi
        // đặt lại tên form cho dễ gọi :))
        var $form = $(this);
        // Chọn tất cả input trừ cái bid để disable (bid mặc định đã disabled)
        var $inputs = $form.find("input, select, button, textarea").not("#editbid");
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
                //window.setTimeout(reloadPage,2500);
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