<?php
include "../src/fconnectadmin.php";
session_start();
?>

    <!-- content -->
    <div class="card bg-light">
    <article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">ĐĂNG KÝ TÀI KHOẢN THÀNH VIÊN</h4>
	<form method="get" action="member_process" id="frmLogin">
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="memName" id="memName" class="form-control" placeholder="Họ và tên thành viên" type="text">            
        </div> <!-- form-group// -->
        <p style="color:red;display:none;" id="nameLabel"></p>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input name="memEmail" id="memEmail" class="form-control" placeholder="Email thành viên" type="text">
        </div> <!-- form-group// -->
        <p style="color:red;display:none;" id="emailLabel"></p>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input name="memAddress" id="memAddress" class="form-control" placeholder="Địa chỉ thành viên" type="text">
        </div> <!-- form-group// -->        
        <p style="color:red;display:none;" id="addressLabel"></p>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
            </div>
            <input name="memPhone" id="memPhone" class="form-control" placeholder="SĐT thành viên" type="text">
        </div> <!-- form-group// -->            
        <p style="color:red;display:none;"  id="phoneLabel"></p>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="memID" id="memID" class="form-control" placeholder="Tên đăng nhập" type="text">
        </div> <!-- form-group// -->        
        <p style="color:red;display:none;"  id="idLabel"></p>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input class="form-control" id="memPW" name="memPW" placeholder="Nhập mật khẩu" type="password">           
        </div> <!-- form-group// -->
        <p style="color:red;display:none;" id="pwLabel"></p>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input class="form-control" id="memRPW" name="memRPW" placeholder="Nhập lại mật khẩu" type="password">            
        </div> <!-- form-group// -->   
        <p style="color:red;display:none;" id="repwLabel"></p>
        <div id="repwLabel"></div>                                   
        <div class="form-group">
            <button type="button" name="cmdMember" id="cmdMember" class="btn btn-primary btn-block"> BẠN MUỐN LÀM THÀNH VIÊN CỦA SHOP CHỨ? </button>
            <input type="hidden" name ="cmdMember">
        </div> <!-- form-group// -->                                                           
    </form>
</article>
</div> <!-- card.// -->

    <!-- <script src="../Scripts/1804HDTVShop/member.js"></script> -->
</body>

</html>