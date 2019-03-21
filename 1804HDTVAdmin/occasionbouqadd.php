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
<script src="../Scripts/1804HDTVAdmin/occabadd.js"></script>

<body>
    <?php
include '../src/fconnectadmin.php';
include '../src/flowerdb.php';
$occaID = $_GET['occaID'];
$bid = $_GET['bid'];
// $sql = "INSERT into occasion_detail (oc_d_ID,b_ID,occa_ID,occa_has) values (NULL,'$bid','$occaID',1)";
insertSql("INSERT into occasion_detail (oc_d_ID,b_ID,occa_ID,occa_has) values (NULL,'$bid','$occaID',1)");
// header('location:#!occasion/bouq/');
echo "<a href='#!occasion/bouq/$occaID' id='btnBouqAdd'></a>"
?>

</body>

</html>