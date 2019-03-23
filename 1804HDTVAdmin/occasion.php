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
<script src="../Scripts/1804HDTVAdmin/occasion.js"></script>
<?php
if (!in_array("Q01", $_SESSION["sRight"], true) && !in_array("Q00", $_SESSION["sRight"], true)) {
    echo "<h2>Bạn không có quyền truy cập vào trang này!<h2>";
    exit;
}
?>

<style>
img {
    max-width: 20vw;
    height: 8rem;
    object-fit: cover;
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
        <a href="#!occasion/add" class="btn btn-success btn-lg col-2 btn-shop">
            Thêm mới
        </a>
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
    echo "<table id='octable' class=' table table-hover table-bordered table-sm text-center'>";
    echo "<tr class='table-info table-shop'>
                    <th>Mã dịp</th>
                    <th>Tên dịp</th>
                    <th>Hình ảnh dịp</th>
                    <th>Hiện trên web</th>
                    </tr>";
    foreach ($data as $key => $oc) {
        echo "<tr>";
        echo "<td class='align-middle'>", $oc['occa_ID'], "</td>";
        echo "<td class='align-middle'>", $oc['occa_name'], "</td>";

        echo "<td class='align-middle'><img src='../", $oc['occa_img'], "?" . date("dmyHis") . "' alt='Chưa Có Hình'></td>";

        echo "<td class='align-middle'>";
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
        <td class='align-middle'>
            <a class='btn btn-info btn-sm text-light btn-shop' href='#!occasion/edit/" . $oc["occa_ID"] . "'>
                Sửa thông tin
            </a>
            <div class='py-1'></div>
            <button class='btn btn-info btn-sm text-light btn-shop'>
            <a href='#!occasion/img/" . $oc["occa_ID"] . "'>Upload Hình</a>
            </button>
            <div class='py-1'></div>
            <button class='btn btn-info btn-sm text-light btn-shop'>
                <a href='#!occasion/bouq/" . $oc["occa_ID"] . "'>Bó của dịp</a>
            </button>
        </td>";
        echo "
        <td class='align-middle'>
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