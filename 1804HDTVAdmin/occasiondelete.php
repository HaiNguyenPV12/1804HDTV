<html>

<body>
    <?php
include '../src/flowerdb.php';
$id = $_GET['bid'];
deleteSql("DELETE from `occasion_detail` where occa_ID = '$id'");
deleteSql("DELETE from `occasion` where occa_ID = '$id'");
echo "Đã xóa dịp";
?>
    <div class='py-1'></div>
    <button class="btn btn-shop">
        <a id='' href='#!occasion/'>
            Về Trang Quản Lý
        </a>
    </button>
</body>

</html>