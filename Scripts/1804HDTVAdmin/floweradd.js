//Xóa các input
function eraseInput(){
    $("#fname").val("");
    $("#fdetail").val("");
}

function closeModal(){
    $('#modal').modal('hide');
    $('#result').modal('hide');
}

$('#cmdReset').click(function (e) {
    eraseInput();
});

//reload để load lại dữ liệu từ sql
function reloadPage(){   
    location.reload(true);
}

//Reset khi tắt modal add
$('#modal').on('hidden.bs.modal', function (e) {
        eraseInput();
        //reloadPage();
});

// Khi những thứ ảnh hưởng tới ID thay đổi thì khởi động validateID
$('#fcate').change(function() {
    validateID();
});

$('#fname').keypress(function() {
    validateID();
});

function validateID(){
    // Mọi thứ phải kiểm tra có dữ liệu trước
    if ($('#fcate').val()!="") {
        // khởi tạo prefix ID
        var preFID = "H"+$('#fcate').val();
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
        //nếu số đằng sau có 1 chữ số thì thêm số 0 vào trước
        if (sufFID<=9) {
            sufFID="0"+sufFID;
        }
        var fid = preFID+sufFID;
        //đưa ra dữ liệu
        $('#fid').val(fid);
        var imgext = $("#fimgfile").val().replace(/^.*\./, '');
        if (imgext == $("#fimgfile").val()) {
            imgext = '[hãy chọn file để xác định đuôi tập tin]';
        } else {
            imgext = imgext.toLowerCase();
        }
        $("#fimg").val("img/Flower/"+fid+"/"+fid+"."+imgext);
    }
}

$("#fimgfile").change(function(){
    validateID();
    $("#imgPreview").html("");
    if ($(this).val()!="") {
        $("#fimgfiletext").html($(this).prop('files')[0].name);
        uploadFile($(this).prop('files')[0]);
    }else{
        $("#imgPreview").html("Chưa có file!");
        $("#fimgfiletext").html("Chọn file");
    }
});

$('#modal').on('shown.bs.modal', function (e) {
    validateID();
});

$('#modal').on('hidden.bs.modal', function (e) {
    location.reload(true);
});

function uploadFile(file){
    var request;
    var $form = $("#frmImgAdd");
    var $inputs = $form.find("fimgfile, button");
    var myFormData = new FormData();
    myFormData.append('fimgfile', file);
    myFormData.append('fid', $("#fid").val());
    myFormData.append('fimg', $("#fimg").val());
    myFormData.append('cmdFImgUpload', "");

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "./Pages/flowerimg_upload.php",
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


var request;
//Nếu form submit
$("#frmAddFlower").submit(function(event){
    // Ngừng submit mặc định
    event.preventDefault();
    if (request) {
        request.abort();
    }
    // đặt tên cho dễ
    var $form = $(this);
    // Chọn tất cả trừ cái fid
    var $inputs = $form.find("input, select, button, textarea").not("#fid");
    // Mã hóa để đưa dữ liệu qua post
    var serializedData = $form.serialize();

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "./Pages/process.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        if (response=="ok") {
            $("#txtResult").addClass("text-success");
            $("#txtResult").html("<h2>Thêm vào thành công!</h2>");
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