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
    <button class='btn btn-shop'>
        <a href="#!occasion/">
            Về Trang Dịp
        </a>
    </button>
    <div class='py-1'></div>
    <table class='table table-hover table-bordered table-sm text-center'>
        <?php
include '../src/flowerdb.php';
include '../src/fconnectadmin.php';
$bsql = "SELECT * from bouquet";
$occaID = $_GET['occaID'];
$sql = "SELECT * FROM bouquet, occasion_detail, occasion WHERE occasion_detail.b_ID = bouquet.b_ID AND occasion_detail.occa_ID = occasion.occa_ID and occasion.occa_ID = '$occaID'";
$rs = mysqli_query($cn, $sql);
//list bouqs in occa
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<tr>";
    echo "<td>" . $row['b_name'] . "</td>";
    echo "
    <td>
        <a class='btn btn-danger' href='#!occasion/bouq/del/" . $row['b_ID'] . "/$occaID'>&nbsp;Xóa&nbsp;</a>
    </td>
    ";
    echo "</tr>";
}
//list bouqs not in occa
$sql = "SELECT b_name,b_ID from bouquet where b_ID not in (SELECT bouquet.b_ID FROM bouquet, occasion_detail, occasion WHERE occasion_detail.b_ID = bouquet.b_ID AND occasion_detail.occa_ID = occasion.occa_ID and occasion.occa_ID = '$occaID')";
$rs = mysqli_query($cn, $sql);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<tr>";
    echo "<td>" . $row['b_name'] . "</td>";
    echo "
    <td>
        <a class='btn btn-shop' href='#!occasion/bouq/add/" . $row['b_ID'] . "/$occaID'>Thêm</a>
    </td>
    ";
    echo "</tr>";
}

?>
    </table>
</body>

</html>