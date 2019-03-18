<html>
<?php
session_start();
if (!in_array("Q04", $_SESSION["sRight"], true) && !in_array("Q00", $_SESSION["sRight"], true)) {
    echo "<h2>Bạn không có quyền truy cập vào trang này!<h2>";
    exit;
}
?>

<style>
img {
    max-width: 20vh;
}
</style>

<body>
    <div class='row'>
        <h2 class="col-9">Quản lý Dịp</h2>
        <button type="button" class="btn btn-success btn-lg col-2 ml-5 btn-shop" data-toggle="modal"
            data-target="#modal" ng-click="temp.url = 'occasionadd.php';modalHText='Thêm Dịp mới';">
            Thêm Dịp mới
        </button>
    </div>

    <br>
    <?php
include '../src/flowerdb.php';
$data = getSql("SELECT * FROM occasion");
$ocdata = getSql("SELECT occa_ID,bouquet.b_ID, b_name FROM occasion_detail,bouquet WHERE occasion_detail.b_ID = bouquet.b_ID");
$num = sizeof($data);
$n = 0;
if ($num <= 0) {
    echo "Chưa có dữ liệu dịp";
} else {
    echo "<table id='octable' class='table table-hover table-bordered table-sm text-center'>";
    echo "<tr class='table-info table-shop'>
                    <th>Mã dịp</th>
                    <th>Tên dịp</th>
                    <th>Hình ảnh dịp</th>
                    <th>Hiện trên web</th>
                    </tr>";
    foreach ($data as $key => $oc) {
        echo "<tr>";
        echo "<td>", $oc['occa_ID'], "</td>";
        echo "<td>", $oc['occa_name'], "</td>";

        echo "<td><img src='../", $oc['occa_img'], "' style='max-width=20vw'></td>";

        echo "<td>";
        if ($oc['occa_fp'] == 0) {
            echo "
            <button class='btn btn-outline-danger' disabled>
                Không
            </button>";
        } else {
            echo "
            <button class='btn btn-outline-success' disabled>
                Có
            </button>";
        }
        echo "</td>";

        echo '
        <td>
            <button class="btn btn-info btn-sm text-light btn-shop" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'occasionedit.php?oid=', $oc["occa_ID"], '\';modalHText=\'Chỉnh sửa\';">
                Sửa
            </button>
        </td>';
        echo '
        <td>
            <button class="btn btn-danger btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'occasiondel.php?oid=', $oc["occa_ID"], '\';modalHText=\'Xóa\';">
                Xóa
            </button>
        </td>';
        $n++;
    }
    echo "</tr>";
    echo "</table>";

}

?>
</body>

</html>