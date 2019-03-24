// Script tùy chỉnh của trang bouquetadd.php

var addimglist = [];
// Function xóa các input (reset)
function eraseInput(){
    // Vì sao không dùng lệnh reset form bình thường??
    // --> Vì nó sẽ làm mất ID bó hoa đã tạo ra
    $('#addbname').val("");
    $('#addbprice').val("");
    $('#addbdetail').val("");
    $('#addimgPreview').html("");
}

// Function tắt bảng Modal
function closeModal(){
    $('#modal').modal('hide');
    $('#result').modal('hide');
    $('.modal-backdrop').remove();
}

// Function reload lại trang để cập nhật lại dữ liệu từ sql
function reloadPage(){   
    location.reload(true);
}

// Function tạo mã bó hoa (Mã bó hoa: B[3 con số theo thứ tự từ 0]. VD: B000, B001,...)
function IDGenerate(){
    if (!$("#cmdAddBouquet").length) {
        return;
    }
    // Tiền tố là chữ B
    var preBID = "B";
    // Hậu tố là 3 chữ số, nhưng đầu tiên để so sánh lấy số cao nhất thì đặt mặc định là 0 trước
    var sufBID = 0;
    // Tạo array chứa các số đã có
    var items=[];
    // Tìm ID bó hoa ở mỗi dòng trong bảng, lấy số ở mã đó ra đưa vào mảng items...để làm gì?
    // Để tìm ra số lớn nhất trong mảng
    // Lấy index cột chứa mã bó hoa
    var IDIndex = $('th:contains("Mã")').index()+1; //+1 là vì nth-child ở dưới lấy index từ 1 chứ không phải là 0
    // ở từng dòng của cột đó ...
    $('#btable tr td:nth-child('+IDIndex+')').each( 
        function(i,data){
            // Đặt biến str là ID lấy được trong dòng đó (nếu không sai thì là B000, B001...)
            var str = data.innerHTML;
            // lấy 3 kí tự cuối, parse thành số rồi đưa vào array
            items.push(parseInt(str.substring(str.length-3,str.length)));
        }
    );

    // nếu array rỗng nghĩa là danh sách bó hoa trống
    if (items.length==0||items.length<0) {
        // cho số =0
        sufBID=0;
    }else{
        // Còn không thì tìm max của dữ liệu đã có và + thêm 1 (thành ID mới)
        sufBID = Math.max.apply(Math,items)+1;
    }

    // Nếu số đằng sau có 1 chữ số 
    if (sufBID<=9) {
        // thì thêm 2 số 0 vào trước để đủ 3 kí tự
        sufBID="00"+sufBID;
    }else if(sufBID<=99){
        // Nếu có 1 chữ số thì chỉ cần thêm 1 số 0, còn không thì nghĩa là đã đủ 3 kí tự
        sufBID="0"+sufBID;
    }
    //đưa ra dữ liệu ID cho bó hoa vào input có id là "bid"
    $('#addbid').val(preBID+sufBID);
}

// Lúc hiện modal là thực hiện tạo ID bó hoa
$('#modal').on('shown.bs.modal', function (e) {
    if ($("#cmdAddBouquet").length) {
        IDGenerate();
    }
});

// Khi nhấn nút cmdResetBouquet sẽ thực hiện function xóa các input
$('#cmdResetAddBouquet').click(function (e) {
    eraseInput();
});

// Khi Modal tắt sẽ gọi function xóa các input
$('#modal').on('hidden.bs.modal', function (e) {
    //eraseInput();
    //reloadPage();
});

$('#addbprice').keyup(function(event){
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
    $("#addbpriceshow").val(bpriceshow +" VNĐ");
});

$(document).on("click","#addimgPreview div",function(){
    var n = $(this).find("#imgnum").val();
    if (n) {
        //console.log(n);
        addimglist = addimglist.filter(e=>e!=n);
    }
    $(this).remove();
});

$("#addimgfile").change(function(){
    if (addimglist.length<5) {
        if ($(this).get(0).files.length<=(5-addimglist.length)) {
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                var bid;
                if (addimglist.length==0) {
                    bid=0;
                }else{    
                    for (var j = 0; j < 5; j++) {
                        const found = addimglist.some(el => el == j);
                        if (!found) {
                            bid=j;
                            break;
                        }
                    }
                }
                // Bắt đầu function upload hình (và đưa nó ra phần hiển thị mẫu)
                uploadFile($(this).get(0).files[i],"bouquetadd",$("#addbid").val(), bid);
                addimglist.push(bid);
                // Đưa tên file ra hiển thị
                $("#addimgfiletext").html("Đã có "+addimglist.length+" hình.");
            }
            $(this).val("");
        }else{
            alert("Không thể quá 5 hình! Chỉ có thể tải lên "+(5-addimglist.length)+" hình nữa!");
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
        $("#addimgPreview").append(response); 
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
$('#frmAddBouquet').submit(function(event){
    // Ngừng submit mặc định (tránh việc load lại trang trước khi thực hiện các lệnh khác)
    event.preventDefault();
    if (request) {
        request.abort();
    }
    if (!$("[name='imgshow[]']").length) {
        alert("Chưa có hình!");
        $("#addimgfile").focus();
        return;
    }
    // đặt lại tên form cho dễ gọi :))
    var $form = $(this);
    // Chọn tất cả input trừ cái bid để disable (bid mặc định đã disabled)
    var $inputs = $form.find("input, select, button, textarea").not("#addbid");
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
            //eraseInput();
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