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
    <br>
    <!-- content -->
    <div class="container col-9">

    <div class="container">
        <h1 class="jumbotron-heading text-center">Giỏ Hoa của bạn </h1>
     </div>

<div class="container mb-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col" class="text-center">Bó hoa</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col" class="text-right">Đơn giá</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="../img/Bouquet/B000/B000_PV.jpg" style="max-width:10vw" /> </td>
                            <td>Bó hoa 1</td>
                            <td><input class="form-control" type="number" style="width: fit-content" value="1" /></td>
                            <td class="text-right">500.000Đ</td>
                            <td class="text-right"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> </td>
                        </tr>
                        <tr>
                            <td><img src="../img/Bouquet/B001/B001_PV.jpg" style="max-width:10vw"/> </td>
                            <td>Bó hoa 2</td>
                            <td><input class="form-control" type="number" style="width: fit-content" value="1" /></td>
                            <td class="text-right">200.000Đ</td>
                            <td class="text-right"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Đơn giá</td>
                            <td class="text-right">800.000Đ</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Phí vận chuyển</td>
                            <td class="text-right">30.000Đ</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Tổng đơn giá</strong></td>
                            <td class="text-right"><strong>830.000Đ</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <a href="thanhtoan.html" class="btn btn-block btn-light btn-active">Tiếp tục mua hàng</a>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <button class="btn btn-lg btn-block btn-success text-uppercase btn-shop">Thanh toán</button>
                </div>
            </div>
        </div>
    </div>
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