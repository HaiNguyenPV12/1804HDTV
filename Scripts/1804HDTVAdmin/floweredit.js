var oldFID = $("#editfid").val();
var oldFName = $("#editfname").val();
var oldFCate = $("#editfcate option:selected").val();
var oldFDetail = $("#editfdetail").html();
var oldFImg = $("#editfimg").val();
var oldFImgView = $("#editimgPreview").html();

function closeModal(){
    $('#modal').modal('hide');
    $('#result').modal('hide');
    $('.modal-backdrop').remove();
}


$('#cmdReset').click(function (e) {
    $("#imgPreview").html(oldFImgView);
    $("#fimgfiletext").html("(Hãy để trống nếu không muốn thay đổi)");
});

//reload để load lại dữ liệu từ sql
function reloadPage(){   
    //location.reload();
    //angular.element('#myMain').scope().reloadData();
}

//Reset khi tắt modal add
$('#modal').on('hidden.bs.modal', function (e) {
    closeModal();
});

// Khi những thứ ảnh hưởng tới ID thay đổi thì khởi động validateID
$('#editfcate').change(function() {
    editvalidateID();
});

function editvalidateID(){
    // Mọi thứ phải kiểm tra có dữ liệu trước
    if ( $('#editfcate').val()!="") {
        // khởi tạo prefix ID
        var oldPreFID = oldFID.substring(0,oldFID.length-2);
        var oldSufFID = oldFID.substring(oldFID.length-2,oldFID.length);
        var preFID = "H"+$('#editfcate').val();
        var sufFID = 0;
        var items=[];
        //Lấy index cột chứa mã hoa
        var IDIndex = $('th:contains("Mã")').index()+1;
        //console.log(IDIndex);
        // ở từng dòng của cột đó thực hiện lệnh nếu giống prefixID thì cho phần số ở sau vào array
        $('#ftable tr td:nth-child('+IDIndex+')').each( 
            function(i,data){
                var str = data.innerHTML; 
                if (str.substring(0,str.length-2)==preFID) {
                    //console.log(str);
                    items.push(parseInt(str.substring(str.length-2,str.length)));
                }
            }
        );
        
        // nếu array rỗng nghĩa là prefix ID đó chưa có trong dữ liệu, cho số =0, còn không thì tìm max của dữ liệu đã có và + thêm 1
        if (items.length==0||items.length<0) {
            sufFID=0;
        }else{
            sufFID = Math.max.apply(Math,items)+1;
        }
        // Nếu vẫn màu cũ và loại cũ thì sẽ giữ nguyên số
        if (preFID==oldPreFID) {
            sufFID=parseInt(oldSufFID);
        }
        //nếu số đằng sau có 1 chữ số thì thêm số 0 vào trước
        if (sufFID<=9) {
            sufFID="0"+sufFID;
        }
        //đưa ra dữ liệu
        var fid = preFID+sufFID;
        $('#editfid').val(fid);
        if ($("#editfimgfile").val()!="") {
            var imgext = $("#editfimgfile").val().replace(/^.*\./, '');
            if (imgext == $("#editfimgfile").val()) {
                imgext = '[hãy chọn file để xác định đuôi tập tin]';
            } else {
                imgext = imgext.toLowerCase();
            }
        }else{
            var imgext = $("#editfimg").val().replace(/^.*\./, '');
            imgext = imgext.toLowerCase();
        }
        $("#editfimg").val("img/Flower/"+fid+"/"+fid+"."+imgext);
    }
}

$("#editfimgfile").change(function(){
    editvalidateID();
    $("#editimgPreview").html("");
    if ($(this).val()!="") {
        $("#editfimgfiletext").html($(this).prop('files')[0].name);
        uploadFile($(this).prop('files')[0]);
    }else{
        $("#editimgPreview").html(oldFImgView);
        $("#editfimgfiletext").html("(Hãy để trống nếu không muốn thay đổi)");
    }
});

function uploadFile(file){
    var request;
    //var $form = $("#frmImgAdd");
    //var $inputs = $form.find("fimgfile, button");
    var myFormData = new FormData();
    myFormData.append('fimgfile', file);
    myFormData.append('fid', $("#editfid").val());
    myFormData.append('fimg', $("#editfimg").val());
    myFormData.append('cmdFImgUpload', "");

    //$inputs.prop("disabled", true);

    request = $.ajax({
        url: "flowerimg_upload.php",
        type: "post",
        data: myFormData,
        processData: false,
        contentType: false
    });
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        //alert(textStatus);
        $("#editimgPreview").html(""); 
        $("#editimgPreview").html(response); 
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

var request;
//Nếu form submit
$("#frmEditFlower").submit(function(event){
    // Ngừng submit mặc định
    event.preventDefault();
    // Abort any pending request
    if (request) {
        request.abort();
    }
    var imgchanged=false;
    if ($("#imgtmpdir").length) {
        imgchanged=true;
    }else{
        imgchanged=false;
    }
    if (oldFID==$("#editfid").val() && oldFName==$("#editfname").val() && oldFCate==$("#editfcate option:selected").val() && oldFDetail == $("#editfdetail").val() && $("#editfimgfile").val()=="" && !imgchanged) {
        $("#txtResult").addClass("text-success");
        $("#txtResult").html("<h2>Không có thay đổi!</h2>");
        $('#result').modal('show');
        window.setTimeout(closeModal, 1500);
        //window.setTimeout(reloadPage,500);
    }else{
        // đặt tên cho dễ
        var $form = $(this);

        // Chọn tất cả trừ cái fid
        var $inputs = $form.find("input, select, button, textarea").not("#editfid");

        // Mã hóa để đưa dữ liệu qua post
        var serializedData = $form.serialize();
        /*
        var myFormData = new FormData();
        myFormData.append('fid_old', $("#fid_old").val());
        myFormData.append('fimg_old', oldFImg);
        myFormData.append('fid', $("#fid").val());
        myFormData.append('fname', $("#fname").val());
        myFormData.append('fcate', $("#fcate").val());
        myFormData.append('fdetail', $("#fdetail").val());
        myFormData.append('fimg', $("#fimg").val());
        myFormData.append('cmdEditFlower', "cmdEditFlower");
        
        if ($("#fimgfile").val()!="") {
            myFormData.append('fimgfile', "hello");
            var tempimg = $("#imgPreview img").attr('src');
            myFormData.append('tempimg', tempimg);
        }
        */

        $inputs.prop("disabled", true);

        // Fire off the request to /form.php
        request = $.ajax({
            url: "process.php",
            type: "post",
            data: serializedData
            //processData: false,
            //contentType: false
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
});