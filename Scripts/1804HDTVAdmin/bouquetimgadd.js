function validateID(){
    // khởi tạo prefix ID
    var preBID = $('#bid').val();
    var sufBID = 0;
    var items=[];
    var checkPV = false;
    //Lấy index cột chứa mã hoa
    var IDIndex = $('th:contains("Mã hình")').index()+1;
    //console.log(IDIndex);
    // ở từng dòng của cột đó thực hiện lệnh nếu giống prefixID thì cho phần số ở sau vào array
    $('#bimgtable tr td:nth-child('+IDIndex+')').each( 
        function(i,data){
            var str = data.innerHTML; 
            if (str.substring(0,str.length-3)==preBID) {
                //console.log(str.substring(str.length-2,str.length));
                if ($.isNumeric(str.substring(str.length-2,str.length))) {
                    items.push(parseInt(str.substring(str.length-2,str.length)));
                }else if(str.substring(str.length-2,str.length)=="PV"){
                    checkPV = true;
                }
            }
        }
        );
    // nếu array rỗng nghĩa là prefix ID đó chưa có trong dữ liệu, cho số =0, còn không thì tìm max của dữ liệu đã có và + thêm 1
    if (items.length==0||items.length<0) {
        sufBID=0;
    }else{
        sufBID = Math.max.apply(Math,items)+1;
    }
    //console.log(sufBID);
    //nếu số đằng sau có 1 chữ số thì thêm số 0 vào trước
    if (!checkPV) {
        sufBID="PV";
    }else if (sufBID<=9) {
        sufBID="0"+sufBID;
    }

    bID= preBID+"_"+sufBID;
    var imgext = $("#bimgfile").val().replace(/^.*\./, '');
    if (imgext == $("#bimgfile").val()) {
        imgext = '[hãy chọn file để xác định đuôi tập tin]';
    } else {
        imgext = imgext.toLowerCase();
    }
    //đưa ra dữ liệu
    $('#bimgid').val(bID);
    $("#bimg").val("img/Bouquet/"+preBID+"/"+bID+"."+imgext);  
}

function closeModal(){
    $('#imgModal').modal('hide');
}


$('#imgModal').on('shown.bs.modal',function (e) 
    {
        validateID();
    }
);

$('#imgModal').on('hidden.bs.modal', function (e) {
    $("#bimgfile").val("");
    $("#imgPreview").html("");
    location.reload(true);
});

$("#cmdUploadImg").click(function(event){
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

$("#cmdImgAdd").click(function(event){
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
        url: "bouquetimg_upload.php",
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
    myFormData.append('cmdImgAdd', "");

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