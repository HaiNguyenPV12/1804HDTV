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
        $rs = mysqli_query($cn, $sql);
        $ra = mysqli_affected_rows($cn);
        if ($ra <= 0) {
            echo "Lỗi cập nhật thông tin.";
        } else {
            echo "Cập nhật thông tin thành công";
        }
    }
    else if ($sadd == 1) {
        echo 'test';
        $sqla = "INSERT INTO `staff` (`s_ID`, `s_u_ID`, `s_u_PW`, `s_role_ID`, `s_name`, `s_phone`, `s_address`, `s_email`, `s_employed`) VALUES (NULL, '$uName', '$pass', '$role', '$name', '$phone', '$address', '$email', $employed)";
        $rs = mysqli_query($cn, $sqla);
        $ra = mysqli_affected_rows($cn);
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