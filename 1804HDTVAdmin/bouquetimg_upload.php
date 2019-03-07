<?php
// Trang xử lý hình ảnh

// Đường dẫn tới root chưa folder img
$target_dir = "../"; // -> http://localhost:8080/
// Đường dẫn từ thư mục root
$target_file_name= $_POST["bimg"]; // -> img/Bouquet/[ID bó]/[Tên hình].[đuôi]
// Đường dẫn full
$target_file = $target_dir . $target_file_name;
// Biến check cho upload hay không
$uploadOk = 1;
// Lấy đuôi của file
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Khởi tạo Folder tạm để chứa file đã upload
$tmp_dir = "tmp/".$_POST["bimgid"].".".$imageFileType; // -> tmp/[Tên hình].[đuôi]
// Kiểm tra xem đây có phải file hình ảnh hay không
$check = getimagesize($_FILES["bimgfile"]["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
} else {
    echo "Tập tin không phải hình ảnh.<br>";
    $uploadOk = 0;
}

// Kiểm tra kích cỡ file
if ($_FILES["bimgfile"]["size"] > 5000000) {
    echo "Tập tin quá lớn. (phải nhỏ hơn 5mb)<br>";
    $uploadOk = 0;
}

// Bắt đầu xử lý
// Nếu là nút upload để xem trước (không phải là nút thêm hình vào dữ liệu)
if (isset($_POST['cmdImgUpload'])) {
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
        if (move_uploaded_file($_FILES["bimgfile"]["tmp_name"], $tmp_dir)) {
            echo "<img src=".$tmp_dir." style='max-width:70vh'></img>";
            echo "<input type='hidden' value='$target_file'>";
        } else {
            echo "Có vấn đề khi tải lên!";
        }
    }
// Nếu là nút thêm vào dữ liệu
}else if (isset($_POST['cmdImgAdd'])){
    // Kiểm tra xem file có tồn tại kg
    if (file_exists($target_file)) {
        // Có thì xóa nó đi để ghi đè
        unlink($target_file);
    }

    // Kiểm tra xem có folder chưa, chưa thì tạo folder
    if (!file_exists($target_dir."img/Bouquet/".$_POST["bid"])) {
        mkdir($target_dir."img/Bouquet/".$_POST["bid"], 0777, true);
    }

    // Bắt đầu chuyển file từ folder tạm của server sang folder img
    if (move_uploaded_file($_FILES["bimgfile"]["tmp_name"], $target_file)) {
        include "../src/flowerdb.php";
        // insert dữ liệu vào database
        $insert = insertSql("insert into bouq_img values('".$_POST["bimgid"]."','".$_POST["bid"]."','".$_POST["bimg"]."')");
        echo "ok";
    } else {
        echo "Có vấn đề khi tải lên!";
    }
// Nếu là nút chỉnh sửa dữ liệu
}else if (isset($_POST['cmdImgEdit'])) {
    // Kiểm tra xem file có tồn tại kg
    if (file_exists($target_file)) {
        // Có thì xóa nó đi để ghi đè
        unlink($target_file);
    }
    // Kiểm tra xem có folder chưa, chưa thì tạo folder
    if (!file_exists($target_dir."img/Bouquet/".$_POST["bid"])) {
        mkdir($target_dir."img/Bouquet/".$_POST["bid"], 0777, true);
    }
    // Bắt đầu chuyển file từ folder tạm của server sang folder img
    if (move_uploaded_file($_FILES["bimgfile"]["tmp_name"], $target_file)) {
        // Nếu đường dẫn có khác (thường do thay đổi đuôi file)
        include "../src/flowerdb.php";
        if ((getSql("select * from bouq_img where b_img_ID = '".$_POST["bimgid"]."'"))[0]['b_img']!=$_POST["bimg"]) {
            // Thì update dữ liệu
            updateSql("update bouq_img set b_img='".$_POST["bimg"]."' where b_img_ID = '".$_POST["bimgid"]."'");
        }
        echo "ok";
    } else {
        echo "Có vấn đề khi tải lên!";
    }

}else{
    echo "no";
}

?>