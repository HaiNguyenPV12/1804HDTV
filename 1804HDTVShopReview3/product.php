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
    <div class="container col-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-10">
                        <div class="card-body store-body">
                            <div class="product-info">
                                <div class="product-gallery">

                                    <div class="product-gallery-thumbnails">
                                        <ol class="thumbnails-list list-unstyled">
                                            <li><img src="https://via.placeholder.com/350x350/ffcf5b" alt=""></li>
                                            <li><img src="https://via.placeholder.com/350x350/f16a22" alt=""></li>
                                            <li><img src="https://via.placeholder.com/350x350/d3ffce" alt=""></li>
                                            <li><img src="https://via.placeholder.com/350x350/7937fc" alt=""></li>
                                        </ol>
                                    </div>

                                    <div class="product-gallery-featured">
                                        <img src="../img/Bouquet/B003/B003_PV.jpg" alt="">
                                    </div>
                                </div>
                                <div class="product-seller-recommended">

                                    <!-- /.recommended-items-->
                                    <div class="product-description mb-5">
                                        <h2>Đặc tính</h2>
                                        <dl class="row">
                                            <dt class="col-sm-3">Hoa có trong bó:</dt>
                                            <dd class="col-sm-9"><a href="">Hướng dương</a>, <a href="">Baby Hà Lan</a>
                                            </dd>
                                            <dt class="col-sm-3">Màu:</dt>
                                            <dd class="col-sm-9"><a href="">Vàng</a>, <a href="">Trắng</a></dd>
                                            <dt class="col-sm-3">Dịp:</dt>
                                            <dd class="col-sm-9"><a href="">Sinh nhật</a>, <a href="">Cảm ơn</a></dd>
                                        </dl>
                                        <h2>Chi tiết</h2>
                                        <p>Bó hoa hướng dương- Người bí ẩn bao gồm các loại hoa:<br>
                                            - Hoa hướng dương<br>
                                            - Hoa baby Hà Lan<br>
                                            - Giấy gói cao cấp Hàn Quốc</p>
                                    </div>

                                    <div class="product-comments">
                                        <h2>Bình luận</h2>
                                        <form action="" class="form mb-5">
                                            <input class="form-control" type="text" placeholder="Tên *">
                                            <input class="form-control" type="text" placeholder="Email *">
                                            <textarea name="" id="" cols="50" rows="2" class="form-control mr-4"
                                                placeholder="Hãy viết bình luận tại đây *"></textarea>
                                            <button class="btn btn-lg btn-primary btn-shop">Gửi bình luận</button><br>
                                        </form>
                                        <p><i>Lưu ý: Bình luận của bạn sẽ được hiện lên sau khi được xét duyệt</i></p>
                                        <div class="media border p-2 bg-primary bg-shop">
                                            <img src="../img/user.png" alt="John Doe" class="mr-3 mt-3 rounded-circle"
                                                style="width:4vw;">
                                            <div class="media-body text-dark">
                                                <h5><b>Thiên</b></h5>
                                                <p class="text-muted"><i>Ngày 08 tháng 03 năm 2019</i></p>
                                                <p>Bó này trông rất bí ẩn!</p>
                                            </div>
                                        </div>

                                        <div class="media border p-2 bg-primary bg-shop">
                                            <img src="../img/user.png" alt="John Doe" class="mr-3 mt-3 rounded-circle"
                                                style="width:4vw;">
                                            <div class="media-body text-dark">
                                                <h5><b>L.Anh</b></h5>
                                                <p class="text-muted"><i>Ngày 08 tháng 03 năm 2019</i></p>
                                                <p>Shop dịch vụ rất tốt! Chị giao hàng rất xinh :></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-payment-details">
                                <p class="last-sold text-muted"><small>Đã bán 15 sản phẩm</small></p>
                                <h4 class="product-title mb-2">Bó Hướng Dương - Người Bí Ẩn</h4>
                                <h2 class="product-price display-4">500.000 Đ</h2>
                                <p class="mb-0"><i class="fa fa-truck"></i> Giao nội thành TP.HCM</p>
                                <label for="quant">Số lượng</label>
                                <input type="number" name="quantity" min="1" id="quant"
                                    class="form-control mb-5 input-lg" placeholder="Nhập số lượng bạn muốn mua">
                                <button class="btn btn-primary btn-lg btn-block btn-shop">Thêm vào giỏ hàng</button>
                            </div>
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