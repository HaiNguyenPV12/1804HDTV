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