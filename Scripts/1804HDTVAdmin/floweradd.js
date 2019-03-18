//Xóa các input
function eraseInput(){
    $("#addfname").val("");
    $("#addfdetail").val("");
    $("#addfimgfile").val("");
    $("#addfimgfiletext").html("Chọn file");
    $("#addimgPreview").html("");
}

function closeModal(){
    $('#modal').modal('hide');
    $('#result').modal('hide');
    $('.modal-backdrop').remove();
}

$('#cmdAddFlowerReset').click(function (e) {
    eraseInput();
});


//Reset khi tắt modal add
$('#modal').on('hidden.bs.modal', function (e) {
    eraseInput();
});

// Khi những thứ ảnh hưởng tới ID thay đổi thì khởi động validateID
$('#addfcate').change(function() {
    validateID();
});

$('#addfname').keypress(function() {
    validateID();
});

// tạo mã
function validateID(){
    // Mọi thứ phải kiểm tra có dữ liệu trước
    if ($('#addfcate').val()!="" && $("#cmdAddFlower").length) {
        // khởi tạo prefix ID
        var preFID = "H"+$('#addfcate').val();
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
        $('#addfid').val(fid);
        var imgext = $("#addfimgfile").val().replace(/^.*\./, '');
        if (imgext == $("#addfimgfile").val()) {
            imgext = '[hãy chọn file để xác định đuôi tập tin]';
        } else {
            imgext = imgext.toLowerCase();
        }
        $("#addfimg").val("img/Flower/"+fid+"/"+fid+"."+imgext);
    }
}

// Khi input file hình thay đổi
$("#addfimgfile").change(function(){
    // Đầu tiên là tạo mã lại
    validateID();
    // Cho trống phần hiện hình mẫu
    $("#addimgPreview").html("");
    // Nếu sau khi thay đổi, file thực sự có thay đổi
    if ($(this).val()!="") {
        // Đưa tên file ra hiển thị
        $("#addfimgfiletext").html($(this).prop('files')[0].name);
        // Bắt đầu function upload hình (và đưa nó ra phần hiển thị mẫu)
        uploadFile($(this).prop('files')[0]);
    }else{
    // Nếu file vẫn trống (trong trường hợp user bấm cancel khi chọn file)
        $("#addimgPreview").html("");
        $("#addfimgfiletext").html("Chọn file");
    }
});

// Khi bảng thêm hoa xuất hiện thì tạo mã
$('#modal').on('shown.bs.modal', function (e) {
    validateID();
});

// Khi bảng thêm hoa tắt thì reload page để lấy lại dữ liệu
$('#modal').on('hidden.bs.modal', function (e) {
    //location.reload(true);
});

// chức năng upload tạm thời để hiện hình mẫu
function uploadFile(file){
    var request;
    //var $form = $("#frmImgAdd");
    //var $inputs = $form.find("fimgfile, button");

    // Làm theo cách thủ công hơn, tạo form data thủ công
    var myFormData = new FormData();
    // Đưa từng giá trị vào form data
    myFormData.append('fimgfile', file);
    myFormData.append('fid', $("#addfid").val());
    myFormData.append('fimg', $("#addfimg").val());
    myFormData.append('cmdFImgUpload', "");

    //$inputs.prop("disabled", true);

    // Thực hiện đưa qua trang xử lý
    request = $.ajax({
        url: "flowerimg_upload.php",
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

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        //$inputs.prop("disabled", false);
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
    var $inputs = $form.find("input, select, button, textarea").not("#addfid");
    // Mã hóa để đưa dữ liệu qua post
    var serializedData = $form.serialize();

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "process.php",
        type: "post",
        data: serializedData
    });

    // Nếu truyền dữ liệu thành công
    request.done(function (response, textStatus, jqXHR){
        if (response=="ok") {
            $("#txtResult").addClass("text-success");
            $("#txtResult").html("<h2>Thêm vào thành công!</h2>");
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

});