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
<?php
include '.././src/staffdb.php';
include '.././src/sconnectadmin.php';
if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['role'])
    && isset($_GET['email']) && isset($_GET['uname']) && isset($_GET['pass'])
    && isset($_GET['phone']) && isset($_GET['add']) && isset($_GET['employed']) && isset($_GET['sadd'])) {
    $id = $_GET['id'];
    $name = $_GET['name'];
    $role = $_GET['role'];
    $email = $_GET['email'];
    $uName = $_GET['uname'];
    $pass = $_GET['pass'];
    $phone = $_GET['phone'];
    $address = $_GET['add'];
    $employed = $_GET['employed'];
    $sadd = $_GET['sadd'];
    if ($sadd == 0) {
        $sql = "UPDATE staff set s_u_ID = '$uName', s_u_PW = '$pass', s_role_ID = '$role', s_name = '$name', s_phone = '$phone', s_address = '$address', s_email = '$email', s_employed = $employed where s_ID = $id";
        $rs = mysql_query($cn, $sql);
        $ra = mysql_affected_rows($cn);
        if ($ra <= 0) {
            echo "Lỗi cập nhật thông tin.";
        } else {
            echo "Cập nhật thông tin thành công";
        }
    }
    else if ($sadd == 1) {
        // echo 'test';
        $sqla = "INSERT INTO `staff` (`s_ID`, `s_u_ID`, `s_u_PW`, `s_role_ID`, `s_name`, `s_phone`, `s_address`, `s_email`, `s_employed`) VALUES (NULL, '$uName', '$pass', '$role', '$name', '$phone', '$address', '$email', $employed)";
        $rs = mysql_query($cn, $sqla);
        $ra = mysql_affected_rows($cn);
        if ($ra <= 0) {
            echo "Lỗi cập nhật thông tin.";
        } else {
            echo "Cập nhật thông tin thành công";
        }
    }
}
?>
<div class='py-1'></div>
<button class="btn btn-shop">
    <a id='' href='#!staff/'>
        Về Trang Quản Lý
    </a>
</button>

</html>