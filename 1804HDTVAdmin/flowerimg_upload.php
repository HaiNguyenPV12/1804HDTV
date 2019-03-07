<?php
// Trang xử lý upload hình hoa

// Đường dẫn tới root chứa folder img
$target_dir = "../";
// Đường dẫn hình hoa tính từ từ thư mục root
$target_file_name= $_POST["fimg"];
// Đường dẫn đầy đủ
$target_file = $target_dir . $target_file_name;
// Biến check cho upload hay không
$uploadOk = 1;

// Lấy đuôi của file
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Khởi tạo đường dẫn Folder tạm để chứa file đã upload
$tmp_dir = "tmp/".$_POST["fid"].".".$imageFileType;
// Kiểm tra xem đây có phải file hình ảnh hay không
$check = getimagesize($_FILES["fimgfile"]["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
} else {
    echo "Tập tin không phải hình ảnh.<br>";
    $uploadOk = 0;
}

// Kiểm tra kích cỡ file
if ($_FILES["fimgfile"]["size"] > 5000000) {
    echo "Tập tin quá lớn. (phải nhỏ hơn 5mb)<br>";
    $uploadOk = 0;
}

// Bắt đầu xử lý
// Nếu là nút upload để xem trước (không phải là nút thêm hình vào dữ liệu)
if (isset($_POST['cmdFImgUpload'])) {
    // Kiểm tra xem có cho upload hay không
    if ($uploadOk == 0) {
        echo "Có vấn đề khi tải lên!<br>";
    } else {
    // Nếu cho upload
        // Kiểm tra xem có folder tạm chưa, chưa thì tạo folder
        if (!file_exists("tmp")) {
            mkdir("tmp", 0777, true);
        }
        // Chuyển file từ folder tạm của server sang folder tạm của admin
        if (move_uploaded_file($_FILES["fimgfile"]["tmp_name"], $tmp_dir)) {
            echo "<img src=".$tmp_dir." style='max-width:50vh'></img>";
            echo "<input type='hidden' value='$target_file'>";
        } else {
            echo "Có vấn đề khi tải lên!";
        }
    }
}else if (isset($_POST['cmdImgEdit'])) {
     // Check if $uploadOk is set to 0 by an error
     if ($uploadOk == 0) {
        echo "Có vấn đề khi tải lên!<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fimgfile"]["tmp_name"], ".".$tmp_dir)) {
            echo "<img id='tempimg' src=".$tmp_dir." style='max-width:50vh'></img>";
            echo "<input type='hidden' id='tempdir' name='tempdir' value='$tmp_dir'>";
        } else {
            echo "Có vấn đề khi tải lên!";
        }
    }

}else{
    echo "no";
}

?>