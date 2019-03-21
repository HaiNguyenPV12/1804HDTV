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
<!-- Trang này phức tạp ở chỗ thêm cả thông tin hoa lẫn hình -->
<html>
<script src="../Scripts/1804HDTVAdmin/occaedit.js"></script>
<?php
if (!in_array("Q04", $_SESSION["sRight"], true) && !in_array("Q00", $_SESSION["sRight"], true)) {
    echo "<h2>Bạn không có quyền truy cập vào trang này!<h2>";
    exit;
}
?>

<body>
    <?php
include '../src/flowerdb.php';
$data;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    global $data;
    $id = $_GET['id'];
    $data = getSql("SELECT * from occasion where occa_ID = '$id'");
}
?>
    <button class='btn btn-shop'>
        <a href="#!occasion/">
            Về Trang Dịp
        </a>
    </button>

    <div class='py-1'></div>
    <form name='occaEditForm' id='occaEditForm'>
        <table class='table table-hover table-bordered'>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>
                        <input disabled name='occaID' id='occaID' type='text' value='<?php
foreach ($data as $key => $r) {
    echo $r['occa_ID'];
}
?>'>
                    </td>
                </tr>
                <tr>
                    <td>ID Mới</td>
                    <td>
                        <input name='occaIDnew' id='occaIDnew' type='text' value='<?php
foreach ($data as $key => $r) {
    echo $r['occa_ID'];
}
?>'>
                    </td>
                </tr>
                <tr>
                    <td>Tên Dịp</td>
                    <td>
                        <input type='text' name='occaName' id='occaName' value='<?php
foreach ($data as $key => $r) {
    echo $r['occa_name'];
}
?>'>
                    </td>
                </tr>
                <tr>
                    <td>Chi Tiết Dịp</td>
                    <td>
                        <textarea name='occaDetail' id='occaDetail'>
                    <?php
foreach ($data as $key => $r) {
    echo $r['occa_detail'];
}
?>
                    </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Hiện Trên Trang Chủ</td>
                    <td>
                        <select name='occaFP' id='occaFP'>
                            <?php
function frontpageText($isFP)
{
    if ($isFP == 0) {
        return "Không";
    } else if ($isFP == 1) {
        return "Có";
    }
}
foreach ($data as $key => $r) {
    echo "
    <option value='" . $r['occa_fp'] . "'>" . frontpageText($r['occa_fp']) . "</option>
    ";
}
echo "
    <option value='" . 0 . "'>" . "Không" . "</option>
    <option value='" . 1 . "'>" . "Có" . "</option>
    ";
?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-shop" name="btnOccaEdit" id="btnOccaEdit" type='submit'>
            Lưu
        </button>
        <a id="btnOccaEditLink" href='' hidden>
            Lưu
        </a>
    </form>
</body>

</html>