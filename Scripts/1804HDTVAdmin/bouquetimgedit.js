var bimgnum;
var oldimgext = $("#imgext").val();
var imgext;
function validateID(){
    // khởi tạo ID
    var imgdir= "img/Bouquet/"+$("#bid").val()+"/"+$("#bimgid").val();
    imgext = $("#bimgfile").val().replace(/^.*\./, '');
    if (imgext == $("#bimgfile").val()) {
        imgext = '[hãy chọn file trước để xác định đuôi tập tin]';
    } else {
        imgext = imgext.toLowerCase();
    }
    //đưa ra dữ liệu
    //$('#bimgid').val(bID);
    $("#bimg").val(imgdir+"."+imgext);  
}

function closeModal(){
    $('#imgModal').modal('hide');
}
function reloadPage(){   
    location.reload(true);
}

$('#imgModal').on('hidden.bs.modal', function (e) {
    $("#bimgfile").val("");
    $("#imgPreview").html("");
    location.reload(true);
});


$("#bimgfile").change(function(){
    validateID();
    $("#imgPreview").html("");
    if ($(this).val()!="") {
        $("#bimgfiletext").html($(this).prop('files')[0].name);
        uploadFile($(this).prop('files')[0]);
    }
});

$(document).on("click","#imgPreview div",function(){
    $(this).remove();
    $("#bimgfile").val("");
    $("#bimgfiletext").html("Chọn file");
});


function uploadFile(file){
    var request;
    var $form = $("#frmImgAdd");

    var myFormData = new FormData();
    myFormData.append('imgfile', file);
    myFormData.append('uploadTo', "bouquetimgedit"); 
    myFormData.append('id', $("#bid").val());
    myFormData.append('bimgid', $("#bimgid").val());
    if (imgext!=oldimgext) {
        myFormData.append("extchanged", imgext)
    }

    request = $.ajax({
        url: "imgupload.php",
        type: "post",
        data: myFormData,
        processData: false,
        contentType: false
    });
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        //alert(textStatus);
        $("#imgPreview").html(response); 
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
        
    });
}

//=========================== Xử lý submit dữ liệu =================================//
var request;
//Nếu form submit
$('#frmImgEdit').submit(function(event){
    // Ngừng submit mặc định (tránh việc load lại trang trước khi thực hiện các lệnh khác)
    event.preventDefault();
    if (request) {
        request.abort();
    }

    if ($("[name='imgold']").length) {
        $("#txtResult").addClass("text-success");
        $("#txtResult").html("<h2>Không có thay đổi!</h2>");
        // Hiện modal hiển thị kết quả
        $('#result').modal('show');
        // Cho tự động tắt và load lại trang sau vài giây
        window.setTimeout(closeModal, 1500);
        window.setTimeout(reloadPage,500);
    }else if($("[name='imgshow']").length){
        var $form = $(this);
        // Mã hóa để đưa dữ liệu qua post
        var serializedData = $form.serialize();

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
                $("#txtResult").html("<h2>Chỉnh sửa thành công!</h2>");
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
        
        });
    }else{
        $("#txtResult").addClass("text-success");
        $("#txtResult").html("<h2>Không có thay đổi!</h2>");
        // Hiện modal hiển thị kết quả
        $('#result').modal('show');
        // Cho tự động tắt và load lại trang sau vài giây
        window.setTimeout(closeModal, 1500);
        window.setTimeout(reloadPage,500);
    }
});


/*
function addImg(file){
    var request;
    event.preventDefault();
    if (request) {
        request.abort();
    }
    var $form = $("#frmImgAdd");
    var $inputs = $form.find("bimgfile, button");
    var myFormData = new FormData();
    myFormData.append('bimgfile', file);
    myFormData.append('bid', $("#bid").val());
    myFormData.append('bimg', $("#bimg").val());
    myFormData.append('bimgid', $("#bimgid").val());
    myFormData.append('cmdImgEdit', "");

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "bouquetimg_upload.php",
        type: "post",
        data: myFormData,
        processData: false,
        contentType: false
    });
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        //alert(textStatus);
        if (response=="ok") {
            $("#txtResult").addClass("text-success");
            $("#txtResult").html("<h2>Chỉnh sửa thành công!</h2>");
            $('#result').modal('show');
            window.setTimeout(closeModal, 1500);
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
}
*/