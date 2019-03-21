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
include '../src/fconnectadmin.php';
$id = $_GET['bid'];
// $del = deleteSql("DELETE from `occasion_detail` where occa_ID = '$id'");
// $del = deleteSql("DELETE from `occasion` where occa_ID = '$id'");
$sql = "DELETE from `occasion_detail` where occa_ID = '$id'";
$rs = mysqli_query($cn, $sql);
$sql = "DELETE from `occasion` where occa_ID = '$id'";
$rs = mysqli_query($cn, $sql);
// echo "Đã xóa dịp";
$ra = mysqli_affected_rows($cn);
if ($ra <= 0) {
    echo "Lỗi Xóa dịp.";
} else {
    echo "Xóa thành công";
}
?>
    <div class='py-1'></div>
    <button class="btn btn-shop">
        <a id='' href='#!occasion/'>
            Về Trang Quản Lý
        </a>
    </button>
</body>

</html>