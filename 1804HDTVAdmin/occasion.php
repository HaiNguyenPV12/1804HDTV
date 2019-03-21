<html>
<script src="../Scripts/1804HDTVAdmin/occasion.js"></script>
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

.btn a,
.btn-danger a,
.btn-sm a {
    text-decoration: none;
    color: inherit;
}
</style>

<body>
    <div class='row'>
        <h2 class="col-9">Quản lý Dịp</h2>
        <button type="button" class="btn btn-success btn-lg col-2 btn-shop">
            <a href="#!occasion/add">Thêm mới</a>
        </button>
    </div>

    <br>
    <?php
include '../src/flowerdb.php';
$data = getSql("SELECT * FROM occasion");
$ocdata = getSql("SELECT occa_ID,bouquet.b_ID, b_name FROM occasion_detail,bouquet WHERE occasion_detail.b_ID = bouquet.b_ID");
$num = sizeof($data);
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

        echo "
        <td>
            <button class='btn btn-info btn-sm text-light btn-shop'>
                <a href='#!occasion/edit/" . $oc["occa_ID"] . "'>Sửa</a> <br>
            </button>
            <div class='py-1'></div>
            <button class='btn btn-info btn-sm text-light btn-shop'>
                <a href='#!occasion/img/" . $oc["occa_ID"] . "'>Upload Hình</a>
            </button>
        </td>";
        echo "
        <td>
            <button class='btn btn-danger btn-sm text-light' id='btnOccaDelete'>
                <a onclick=\"javascript: return confirm('Delete this record?');\" href='#!occasion/delete/" . $oc["occa_ID"] . "'>Xóa</a>
            </button>
        </td>";
    }
    echo "</tr>";
    echo "</table>";

}

?>
</body>

</html>