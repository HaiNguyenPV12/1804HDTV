function validateID(){
    // khởi tạo ID
    var imgdir= "img/Bouquet/"+$("#bid").val()+"/"+$("#bimgid").val();
    var imgext = $("#bimgfile").val().replace(/^.*\./, '');
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


$('#imgModal').on('hidden.bs.modal', function (e) {
    $("#bimgfile").val("");
    $("#imgPreview").html("");
    //$('#fimgdiv').load("./Pages/productimg_table.php?fid="+$('#fid').val());
    location.reload(true);
});

$("#cmdUploadImg").click(function(event){
    validateID();
    $("#imgPreview").html("");
    if ($("#bimgfile").val()!="") {
        uploadFile($("#bimgfile").prop('files')[0]);
    }else{
        $("#imgPreview").html("Chưa có file!");
    }
});

$("#bimgfile").change(function(){
    validateID();
    $("#imgPreview").html("");
    if ($(this).val()!="") {
        $("#bimgfiletext").html($(this).prop('files')[0].name);
        uploadFile($(this).prop('files')[0]);
    }else{
        $("#imgPreview").html("Chưa có file!");
        $("#bimgfiletext").html("Chọn file");
    }
});

$("#cmdImgEdit").click(function(event){
    $("#imgPreview").html("");
    if ($("#bimgfile").val()!="") {
        addImg($("#bimgfile").prop('files')[0]);
    }else{
        $("#imgPreview").html("Hãy chọn hình!");
    }
});

function uploadFile(file){
    var request;
    var $form = $("#frmImgAdd");
    var $inputs = $form.find("fimgfile, button");
    var myFormData = new FormData();
    myFormData.append('bimgfile', file);
    myFormData.append('bid', $("#bid").val());
    myFormData.append('bimg', $("#bimg").val());
    myFormData.append('bimgid', $("#bimgid").val());
    myFormData.append('cmdImgUpload', "");

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "./Pages/bouquetimg_upload.php",
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
        $inputs.prop("disabled", false);
    });
}



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
        url: "./Pages/bouquetimg_upload.php",
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