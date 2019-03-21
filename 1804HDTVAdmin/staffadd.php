<?php
// Bắt đầu session để lấy dữ liệu từ session ra
session_start();
// Kiểm tra xem nếu người đăng nhập hiện tại có quyền quản lý bó hoa (Q01) hoặc quyền admin (Q00) hay không
if (!in_array("Q01", $_SESSION["sRight"], true) && !in_array("Q00", $_SESSION["sRight"], true)) {
    // Không thì ngăn truy cập bằng cách hiện ra dòng sau
    echo "<h2>Bạn không có quyền truy cập vào trang này!<h2>";
    // Phải có lệnh exit mới dừng việc load những phần bên dưới
    exit;
}
//xóa file tạm trên server'
$files = glob('tmp/*'); // get all file names
if (sizeOf($files) > 0) {
    foreach ($files as $file) { // iterate files
        if (is_file($file)) {
            unlink($file);
        }
        // delete file
    }
}
?>
<html>
<script src="../Scripts/1804HDTVAdmin/staffadd.js"></script>
<?php
// File trung gian kết nối database
include '.././src/sconnectadmin.php';
include '.././src/staffdb.php';
$data = getSql("SELECT * from staff_role");
?>
<button class='btn btn-shop'>
    <a href="#!staff/">
        Về Trang Nhân Viên
    </a>
</button>
<div class='py-1'></div>
<form name='staffAddForm' id='staffAddForm'>
    <table class='table table-hover table-bordered table-sm'>
        <tbody>
            <tr>
                <td>ID</td>
                <td>
                    <input name='staffID' id='staffID' type='text' disabled value='<?php
$sql = "SELECT s_ID from staff order by s_ID desc";
$rs = mysqli_query($cn, $sql);
$row = mysqli_fetch_array($rs);
echo $row[0] + 1;
?>'>
                </td>
            </tr>
            <tr>
                <td>Tên</td>
                <td>
                    <input type='text' required name='staffName' id='staffName' value=''>
                </td>
            </tr>
            <tr>
                <td>Chức Vụ</td>
                <td>

                    <select name='staffRole' id='staffRole'>
                        <option value="">Chức vụ</option>
                        <?php
foreach ($data as $key => $r) {
    echo "
    <option value='" . $r['s_role_ID'] . "'>" . $r['s_role_name'] . "</option>
    ";
}
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type='text' required name='staffEmail' id='staffEmail' value=''>
                </td>
            </tr>
            <tr>
                <td>UserName</td>
                <td>
                    <input type='text' required name='staffUID' id='staffUID' value=''>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type='password' required name='staffPW' id='staffPW' value=''>
                </td>
            </tr>
            <tr>
                <td>Số ĐT</td>
                <td>
                    <input type='text' required name='staffPhone' id='staffPhone' value=''>
                </td>
            </tr>
            <tr>
                <td>Địa Chỉ</td>
                <td>
                    <input type='text' required name='staffAdd' id='staffAdd' value=''>
                </td>
            </tr>
            <tr>
                <td>Đang Làm Việc</td>
                <td>
                    <select name='staffEmployed' id='staffEmployed'>
                        <?php
function employedText($isEmployed)
{
    if ($isEmployed == 0) {
        return "Không";
    } else if ($isEmployed == 1) {
        return "Có";
    }
}
echo "
    <option value='" . 1 . "'>" . "Có" . "</option>
    <option value='" . 0 . "'>" . "Không" . "</option>
    ";
?>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-shop" name="btnStaffAdd" id="btnStaffAdd" type='submit'>
        Lưu
    </button>
    <a id="btnStaffAddLink" href='' hidden>
        Lưu
    </a>
</form>

</html>

</html>