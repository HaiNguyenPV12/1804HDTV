<?php
// Trang xử lý upload hình

// Lấy dữ liệu và khởi tạo dữ liệu có sẵn
$file = $_FILES["imgfile"];
$type = $_POST["uploadTo"];
$id = $_POST["id"];
if (isset($_POST["bid"])) {
    $bid = $_POST["bid"];
}
$imgext = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));

include "../src/flowerdb.php";
/*
echo '<div class="mb-2 col-2" name="imgshow">
    <div class="card border-primary border-shop">
        <img class="card-img-top custom" src="../img/Bouquet/B000/B000_PV.jpg" alt="">
        <p class="card-title text-center">Hoa Hồng</p>   
        <input type="hidden" name="img[]" value="'.$file["name"].':'.$type.':'.$id.'">
    </div>
</div>';
*/

// Khởi tạo thông tin và đường dẫn
// Đường dẫn root chứa folder img
$root_dir = "../";
$temp_dir = "tmp/";
// Khởi tạo file name
if ($type=="bouquetadd") {
    if ($bid<=9) {
        $filename=$id."_0".$bid.".".$imgext;
        $bimgid = $id."_0".$bid;
    }else{
        $filename=$id."_".$bid.".".$imgext;
        $bimgid = $id."_".$bid;
    }
}elseif($type=="bouquetedit") {
    $imgdata = getSql("SELECT * from bouq_img where b_ID = '$id'");
    if (sizeof($imgdata)>0) {
        $num = sizeof($imgdata);
        $num--;
        if ($num<=9) {
            $num = "0".$num;
        }
        $filename=$id."_".$num.".".$imgext;
    }else{
        $filename=$id."_PV.".$imgext;
    }
}

// Đường dẫn từ root đến file (cái sẽ lưu vào database)
$target_dir= "img/Bouquet/$id/$filename";

// Biến check cho upload hay không
$uploadOk = 1;

// Khởi tạo đường dẫn Folder tạm để chứa file đã upload
$tmp_dir = "tmp/$filename";

//echo $tmp_dir; 
// Kiểm tra xem đây có phải file hình ảnh hay không
$check = getimagesize($file["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
} else {
    echo "Tập tin không phải hình ảnh.<br>";
    $uploadOk = 0;
}

// Kiểm tra kích cỡ file
if ($file["size"] > 5000000) {
    echo "Tập tin quá lớn. (phải nhỏ hơn 5mb)<br>";
    $uploadOk = 0;
}


// Bắt đầu xử lý
// Nếu là nút upload để xem trước (không phải là nút thêm hình vào dữ liệu)

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
    if (move_uploaded_file($file["tmp_name"], $tmp_dir)) {
        echo '<div class="mb-2 col-2" name="imgshow">
                <div class="card border-primary border-shop">
                    <img class="card-img-top custom" src="'.$tmp_dir.'?'.date("dmyHis").'" 
                        style="width: 100%;height: 5rem;object-fit: cover;">
                    <small class="card-title text-center">'.$filename.'</small>   
                    <input type="hidden" name="img[]" value="'.$bimgid.':'.$tmp_dir.':'.$target_dir.'">
                    <input type="hidden" id="imgnum" value="'.$bid.'"
                </div>
            </div>';
    } else {
        echo "Có vấn đề khi tải lên!";
    }
}


?>