<html>
<!-- <script src="../Scripts/1804HDTVShop/member_login.js"></script> -->
<?php
session_start();
if (isset($_SESSION['member'])) {
    header('location:home');
}
?>
<div class='container col-8'>
    <div class="login-form">
        <form id="frmLogin" name="frmLogin" method="post">
            <input type="hidden" name="cmdLogin">
            <h3 class="text-center text-info text-shop">Đăng nhập</h3>
            <div class="form-group">
                <input name="id" id="id" type="text" class="form-control" placeholder="Tên đăng nhập"
                    required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <input name="pw" id="pw" type="password" class="form-control" placeholder="Mật khẩu" required="required"
                    autocomplete="off">
            </div>
            <div class="form-group">
                <button name="memLogin" id="memLogin" type="submit" class="btn btn-info btn-block btn-shop">ĐĂNG NHẬP</button>
            </div>
            <div class="form-group">
                <a href="#!member" class="nav-link" style="text-align: center">ĐĂNG KÝ TÀI KHOẢN</a>
            </div>
        </form>
    </div>
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

</html>