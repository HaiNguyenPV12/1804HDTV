// Script tùy chỉnh của trang flowercateadd.php

var fcateidvalid=false;

// Function xóa các input (reset)
function eraseInput(){
    //$("#frmAddFlowerCate")[0].reset();
    $("#frmAddFlowerCate").trigger("reset");
    $("#addimgPreview").html("");
    $("#validatetext").html("");
}

// Function tắt bảng Modal
function closeModal(){
    $('#modal').modal('hide');
    $('#result').modal('hide');
    $('.modal-backdrop').remove();
}

// Function check mã loại hoa
function validateFCateID(){
    if (!$("#cmdAddFlowerCate").length) {
        return;
    }
    if ($("#addfcateid").val().length!=2 && $("#addfcateid").val().length!=3) {
        $('#validatetext').attr('class','text-danger');
        $("#validatetext").html("Mã phải có 2 hoặc 3 kí tự!");
        fcateidvalid=false;
    }else{
        var items=[];
        var IDIndex = $('th:contains("Mã")').index()+1;
        $('#fcatetable tr td:nth-child('+IDIndex+')').each( 
            function(i,data){
                // Đặt biến str là ID lấy được trong dòng đó 
                var str = data.innerHTML;
                items.push(str);
            }
        );
        //console.log(items);
        
        if (jQuery.inArray($("#addfcateid").val(),items)>=0) {
            $('#validatetext').attr('class','text-danger');
            $("#validatetext").html("ID đã tồn tại!");
            fcateidvalid=false;
        }else{
            $('#validatetext').attr('class','text-success');
            $("#validatetext").html("ID hợp lệ!");
            fcateidvalid=true;
        }
        
    }
}

// Khi thay đổi ở ID thì thay đổi những cái liên quan tới nó + validate
$("#addfcateid").keyup(function(){
    $(this).val($(this).val().toUpperCase());
    var imgext;
    var imgfilename;
    if ($("#imgext").length) {
        imgext = $("#imgext").val();
    }
    if ($("#imgfilename").length) {
        imgfilename = $(this).val()+"."+imgext;
        $("#imgfilename").html(imgfilename);

    }
    if ($("#addfcateimg").length) {
        $("#addfcateimg").val("img/Category/"+$(this).val()+"/"+imgfilename);
    }
    validateFCateID();
});

// Khi nhấn nút cmdResetBouquet sẽ thực hiện function xóa các input
$('#cmdResetAddFlowerCate').click(function (e) {
    eraseInput();
});

// Khi Modal tắt sẽ gọi function xóa các input
$('#modal').on('hidden.bs.modal', function (e) {
    eraseInput();
});

$("#addfcateimgfile").change(function(){
    if ($(this).val()!="") {
        uploadFile($(this).get(0).files[0],"flowercateadd",$("#addfcateid").val());
    }
});

//=========================== Xử lý upload hình =================================//
function uploadFile(file,uploadTo, fcateid){
    var request;
    //var $form = $("#frmImgAdd");
    //var $inputs = $form.find("fimgfile, button");

    // Làm theo cách thủ công hơn, tạo form data thủ công
    var myFormData = new FormData();
    // Đưa từng giá trị vào form data
    myFormData.append('imgfile', file); // file từ input
    myFormData.append('uploadTo', uploadTo); 
    myFormData.append('id', fcateid); 
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
        $("#addimgPreview").html(response); 
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });
}

//=========================== Xử lý submit dữ liệu =================================//
var request;
//Nếu form submit
$('#frmAddFlowerCate').submit(function(event){
    // Ngừng submit mặc định (tránh việc load lại trang trước khi thực hiện các lệnh khác)
    event.preventDefault();
    if (request) {
        request.abort();
    }
    if (!fcateidvalid) {
        alert($("#validatetext").html());
        $("#addfcateid").focus();
        return;
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
            // Xóa input
            eraseInput();
            // Cho tự động tắt và load lại trang sau vài giây
            window.setTimeout(closeModal, 1500);
            //window.setTimeout(reloadPage,500);
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