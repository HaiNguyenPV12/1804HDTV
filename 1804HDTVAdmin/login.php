<?php
session_start();
if (isset($_SESSION["loggedin"])) {
    if ($_SESSION["loggedin"]==true) {
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đăng nhập trang quản trị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="../Content/bootstrap.min.css" rel="stylesheet">
</head>
    
<style type="text/css">
    .login-form {
        width: 340px;
        margin: 50px auto;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>

<body>
    <div class="login-form">
        <form id="frmLogin" name="frmLogin" method="post">
            <input type="hidden" name="cmdLogin">
            <h2 class="text-center text-info">Đăng nhập</h2>       
            <div class="form-group">
                <input name="id" id="id" type="text" class="form-control" placeholder="Tên đăng nhập" required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <input name="pw" id="pw" type="password" class="form-control" placeholder="Mật khẩu" required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <button name="cmdLogin" id="cmdLogin" type="submit" class="btn btn-info btn-block">Đăng nhập</button>
            </div>

            <!--
            <div class="clearfix">
                <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
                <a href="#" class="pull-right">Forgot Password?</a>
            </div> 
            -->
        </form>
        <!--
        <p class="text-center"><a href="#">Create an Account</a></p>
        -->
    </div>

    <!-- Modal kết quả -->
    <div class="modal" id="result">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body text-center" id="txtResult">
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../Scripts/jquery-3.3.1.js"></script>
    <!-- Bootstrap -->
    <script src="../Scripts/bootstrap.min.js"></script>
    <!-- Script tùy chỉnh -->
    <script src="../Scripts/1804HDTVAdmin/login.js"></script>
</body>
</html>