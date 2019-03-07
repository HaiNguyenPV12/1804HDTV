function validateID(){
    // Mọi thứ phải kiểm tra có dữ liệu trước
    if ($('#fcolor').val()!="" && $('#fcate').val()!="" && $('#fholder').val()!="") {
        // khởi tạo prefix ID
        var preFID = $('#fid').val();
        var sufFID = 0;
        var items=[];
        //Lấy index cột chứa mã hoa
        var IDIndex = $('th:contains("Tên hình")').index()+1;
        console.log(IDIndex);
        // ở từng dòng của cột đó thực hiện lệnh nếu giống prefixID thì cho phần số ở sau vào array
        $('#fimgtable tr td:nth-child('+IDIndex+')').each( 
            function(i,data){
                var str = data.innerHTML; 
                if (str.substring(0,str.length-3)==preFID) {
                    console.log(str);
                    if ($.isNumeric(str.substring(str.length-2,str.length))) {
                        items.push(parseInt(str.substring(str.length-2,str.length)));
                    }        
                }
            }
            );
        // nếu array rỗng nghĩa là prefix ID đó chưa có trong dữ liệu, cho số =0, còn không thì tìm max của dữ liệu đã có và + thêm 1
        if (items.length==0||items.length<0) {
            sufFID=0;
        }else{
            sufFID = Math.max.apply(Math,items)+1;
        }
        console.log(sufFID);
        //nếu số đằng sau có 1 chữ số thì thêm số 0 vào trước
        if (sufFID<=9) {
            sufFID="0"+sufFID;
        }
        fID= preFID+"_"+sufFID;
        var imgext = $("#fimgfile").val().replace(/^.*\./, '');
        if (imgext == $("#fimgfile").val()) {
            imgext = '[hãy chọn file trước để xác định đuôi tập tin]';
        } else {

            imgext = imgext.toLowerCase();
        }
        //đưa ra dữ liệu
        $('#fimgid').val(fID);
        $("#fimg").val("img/"+preFID+"/"+fID+"."+imgext);
    }
}

function closeModal(){
    $('#imgModal').modal('hide');
}

$('#fimgext').change(function (e) 
    {
        validateID();
    }
);

$('document').ready(function (e) 
    {
        validateID();
    }
);

$('#imgModal').on('hidden.bs.modal', function (e) {
    $("#fimgfile").val("");
    $("#imgPreview").html("");
    //$('#fimgdiv').load("./Pages/productimg_table.php?fid="+$('#fid').val());
    location.reload(true);
});

$("#cmdUploadImg").click(function(event){
    $("#imgPreview").html("");
    if ($("#fimgfile").val()!="") {
        uploadFile($("#fimgfile").prop('files')[0]);
    }else{
        $("#imgPreview").html("Chưa có file!");
    }
});

$("#fimgfile").change(function(){
    validateID();
    $("#imgPreview").html("");
    if ($(this).val()!="") {
        uploadFile($(this).prop('files')[0]);
    }else{
        $("#imgPreview").html("Chưa có file!");
    }
});

$("#cmdImgAdd").click(function(event){
    $("#imgPreview").html("");
    if ($("#fimgfile").val()!="") {
        addImg($("#fimgfile").prop('files')[0]);
    }else{
        $("#imgPreview").html("Hãy chọn hình!");
    }
});

function uploadFile(file){
    var request;
    var $form = $("#frmImgAdd");
    var $inputs = $form.find("fimgfile, button");
    var myFormData = new FormData();
    myFormData.append('fimgfile', file);
    myFormData.append('fid', $("#fid").val());
    myFormData.append('fimg', $("#fimg").val());
    myFormData.append('fimgid', $("#fimgid").val());
    myFormData.append('cmdImgUpload', "");

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "./Pages/productimg_upload.php",
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
    var $inputs = $form.find("fimgfile, button");
    var myFormData = new FormData();
    myFormData.append('fimgfile', file);
    myFormData.append('fid', $("#fid").val());
    myFormData.append('fimg', $("#fimg").val());
    myFormData.append('fimgid', $("#fimgid").val());
    myFormData.append('cmdImgAdd', "");

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "./Pages/productimg_upload.php",
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
            $("#txtResult").html("<h2>Thêm vào thành công!</h2>");
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