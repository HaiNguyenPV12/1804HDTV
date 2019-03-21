<?php
include "../src/fconnectadmin.php";
session_start();
?>

<!DOCTYPE html>
<html ng-app="1804HDTVShop">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>1804HDTV Shop</title>
    <link rel="stylesheet" href="../Content/bootstrap.min.css">
    <link rel="stylesheet" href="../Content/font-awesome.min.css">
    <link rel="stylesheet" href="../Content/bootstrap-social.css">
    <link rel="stylesheet" href="../Content/1804HDTVShop/custom.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="bg-shop">
    <!--LOGO-->
    <a href="index.php">
        <div class="abovenavbar">
        </div>
    </a>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-light justify-content-start sticky-top shadow">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Trang Chủ</a>
            </li>
            <!-- Flower Type Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">Loại Hoa</a>
                <div class="dropdown-menu">
                    <!-- <a class="dropdown-item" href="#!test">test</a> -->
                    <?php
$sql = "SELECT * from flower_cate order by f_cate_name asc";
$rs = mysqli_query($cn, $sql);
while ($row = mysqli_fetch_assoc($rs)) {
    $cate = $row['f_cate_name'];
    echo "<a class=\"dropdown-item\" href=\"#!browse.php/" . $cate . "\">" . $row['f_cate_name'] . "</a>";
}
?>
                </div>
            </li>
            <!-- Flower Color Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">Màu Hoa</a>
                <div class="dropdown-menu">
                    <?php
$sql = "SELECT * from flower_color order by f_color_name asc";
$rs = mysqli_query($cn, $sql);
while ($row = mysqli_fetch_assoc($rs)) {
    $color = $row['f_color_name'];
    echo "<a class=\"dropdown-item\" href=\"#!browse.php/" . $color . "\">" . $row['f_color_name'] . "</a>";
}
?>
                </div>
            </li>
            <!-- Occasion Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">Dịp</a>
                <div class="dropdown-menu">
                    <?php
$sql = "SELECT * from flower_color order by f_color_name asc";
$rs = mysqli_query($cn, $sql);
while ($row = mysqli_fetch_assoc($rs)) {
    $color = $row['f_color_name'];
    echo "<a class=\"dropdown-item\" href=\"#!browse.php/" . $color . "\">" . $row['f_color_name'] . "</a>"; //TODO link to actual ocasions
}
?>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Giỏ Hàng</a>
            </li>
        </ul>
    </nav>

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

    <!-- Footer -->
    <div class="footer">
        <!-- Social buttons -->
        <div class="container-fluid pt-md-3 text-center">
            <a class="btn btn-social-icon btn-sm btn-google" href="https://www.google.com" target="_blank"><i
                    class="fa fa-google"></i></a>
            <a class="btn btn-social-icon btn-sm btn-facebook" href="https://www.facebook.com/" target="_blank"><i
                    class="fa fa-facebook"></i></a>
            <a class="btn btn-social-icon btn-sm btn-twitter" href="https://www.twitter.com/" target="_blank"><i
                    class="fa fa-twitter"></i></a>
            <a class="btn btn-social-icon btn-sm btn-google" href="https://www.youtube.com/" target="_blank"><i
                    class="fa fa-youtube"></i></a>
            <a class="btn btn-social-icon btn-sm btn-instagram" href="https://www.instagram.com/" target="_blank"><i
                    class="fa fa-instagram"></i></a>
        </div>
        <hr class="py-1">
        <!-- FAQs and Sitemaps, etc. -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- Left Column -->
                <div class="col-2">
                    <b>1804 HDTV Co.</b>
                    <ul>
                        <li><a href="#" class="footer-link">Câu hỏi thường xuyên</a></li>
                        <li><a href="#" class="footer-link">Về Chúng tôi</a></li>
                    </ul>
                </div>
                <!-- Right Column -->
                <div class="col-2">
                    <b>Trợ Giúp</b>
                    <ul>
                        <li><a href="#" class="footer-link">Điều khoản dịch vụ</a></li>
                        <li><a href="#" class="footer-link">Chính sách bảo mật</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Bottom text -->
        <hr class="py-1">
        <div class="container-fluid text-center">
            <h4>&copy; COPYRIGHT 2019, 1804 HDTV COMPANY</h4>
        </div>
    </div>

    <!-- Scroll to top button, remove adblock to show in some cases -->
    <a href="#" class="ScrollToTop" title="về đầu trang">▲</a>

    <!--Scripts placed at end of document to make pages load faster-->
    <script src="../Scripts/angular.min.js"></script>
    <script src="../Scripts/angular-route.js"></script>
    <script src="../Scripts/jquery-3.3.1.min.js"></script>
    <script src="../Scripts/umd/popper.min.js"></script>
    <script src="../Scripts/bootstrap.min.js"></script>
    <script src="../Scripts/1804HDTVShop/shopScripts.js"></script>
    <!--Angular Controllers-->
    <script src="../Scripts/1804HDTVShop/Controllers/indexcontroller.js"></script>
    <script src="../Scripts/1804HDTVShop/Controllers/homecontroller.js"></script>
    <script src="../Scripts/1804HDTVShop/Controllers/browsecontroller.js"></script>
    <script src="../Scripts/1804HDTVShop/member.js"></script>
</body>

</html>