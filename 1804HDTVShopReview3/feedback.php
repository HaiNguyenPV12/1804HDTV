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
    <link rel="stylesheet" href="../Content/1804HDTVShop/product.css">
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
$rs = mysql_query($cn, $sql);
while ($row = mysql_fetch_assoc($rs)) {
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
$rs = mysql_query($cn, $sql);
while ($row = mysql_fetch_assoc($rs)) {
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
$rs = mysql_query($cn, $sql);
while ($row = mysql_fetch_assoc($rs)) {
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
    <br>
    <div class="container col-5">
    <div id="contact_form" class="row">
            <div class="col-md-12">
                <h2 class="text-center">Đóng góp ý kiến!</h2>
                <p>Mỗi góp ý của bạn đều giúp cho dịch vụ của chúng tôi hoàn thiện hơn để phục vụ khách hàng một cách tốt nhất!</p>
                <form role="form" id="feedbackForm" data-toggle="validator" data-disable="false">
                    <div class="form-group">
                        <label class="control-label" for="name">Tên *</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên.."
                                required />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-unchecked form-control-feedback"></i></span>
                        </div>
                        <span class="help-block" style="display: none;">Nhập họ và tên của bạn</span>
                    </div>
                    <!-- Thêm phần phone nếu cần! -->
                    <!-- <div class="form-group">
                        <label class="control-label" for="phone">Phone</label>
                        <input type="tel" class="form-control optional" id="phone" name="phone" placeholder="Enter your phone (Optional)" />
                        <span class="help-block" style="display: none;">Please enter a valid phone number.</span>
                    </div> -->
                    <div class="form-group">
                        <label class="control-label" for="email">Địa chỉ mail *</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="ex.. abc@gmail.com"
                                required />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-unchecked form-control-feedback"></i></span>
                        </div>
                        <span class="help-block" style="display: none;">Vui lòng không bỏ trống ô này.</span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="message">Tin nhắn *</label>
                         <div class="input-group">
                            <textarea rows="5" cols="30" class="form-control" id="message" name="message" placeholder="..."
                                required></textarea>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-unchecked form-control-feedback"></i></span>
                          </div>
                        <span class="help-block" style="display: none;">Vui lòng không bỏ trống ô này.</span>
                        <button type="submit" id="feedbackSubmit" class="btn btn-primary btn-lg btn-shop" data-loading-text="Sending..."
                            style="display: block; margin-top: 10px;">Gửi góp ý</button>
                </form>
            </div></span>
        </div>
        </row>
        <hr>
    </div>
    </div>
    <br>

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
                        <li><a href="#" class="footer-link">Ý kiến đóng góp</a></li>
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
</body>

</html>