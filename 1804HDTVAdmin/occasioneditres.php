<?php
    // Bắt đầu session để lấy dữ liệu từ session ra
    session_start();
    // Kiểm tra xem nếu người đăng nhập hiện tại có quyền quản lý bó hoa (Q01) hoặc quyền admin (Q00) hay không
    if (!in_array("Q01",$_SESSION["sRight"],true) && !in_array("Q00",$_SESSION["sRight"],true)) {
        // Không thì ngăn truy cập bằng cách hiện ra dòng sau
        echo "<h2>Bạn không có quyền truy cập vào trang này!<h2>";
        // Phải có lệnh exit mới dừng việc load những phần bên dưới
        exit;
    }
    //xóa file tạm trên server'
    $files = glob('tmp/*'); // get all file names
    if (sizeOf($files)>0) {
        foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
        }
    }
?>
<html>

<body>
    <?php
include '.././src/flowerdb.php';
include '.././src/fconnectadmin.php';
if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['detail'])
    && isset($_GET['fp']) && isset($_GET['oadd'])) {
    $idnew = $_GET['idnew'];
    $id = $_GET['id'];
    $name = $_GET['name'];
    $detail = $_GET['detail'];
    $fp = $_GET['fp'];
    $oadd = $_GET['oadd'];
    if ($oadd == 0) {
        $sql = "UPDATE occasion set occa_ID = '$idnew', occa_name = '$name', occa_detail = '$detail', occa_fp = $fp, occa_img = 'img/Occasion/$idnew.jpg' where occa_ID = '$id'";
        $rs = mysqli_query($cn, $sql);
        $ra = mysqli_affected_rows($cn);
        if ($ra <= 0) {
            echo "Lỗi cập nhật thông tin.";
        } else {
            echo "Cập nhật thông tin thành công";
        }
        echo "<div class='py-0'></div>";
        if (@rename("../img/Occasion/" . $id . ".jpg", "../img/Occasion/" . $idnew . ".jpg") == true) {
            echo "Tên hình đã đổi";
        } else {
            echo "không đổi tên hình thành công.";
        }
    } else if ($oadd == 1) {
        // echo 'test';
        $sqla = "INSERT INTO `occasion` (`occa_ID`, `occa_name`, `occa_detail`, `occa_fp`, `occa_img`) VALUES ('$id', '$name', '$detail', 0, 'img/Occasion/$id.jpg')";
        $rs = mysqli_query($cn, $sqla);
        $ra = mysqli_affected_rows($cn);
        if ($ra <= 0) {
            echo "Lỗi cập nhật thông tin.";
        } else {
            echo "Cập nhật thông tin thành công";
        }
    }
}
?>
    <div class='py-1'></div>
    <button class="btn btn-shop">
        <a id='' href='#!occasion/'>
            Về Trang Dịp
        </a>
    </button>
</body>

</html>