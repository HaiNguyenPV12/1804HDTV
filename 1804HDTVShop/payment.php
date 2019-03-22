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
    <br>
    <!-- content -->

    <div class="container">
    <h2 class="text-center">Thanh toán</h2>
    <div class="row">
        <div class="container col-8">
            <div class="table-responsive">
                <table class="table table-striped" >
                    <thead>
                        <tr>
                            <th scope="col-4" class="text-left">Hình ảnh</th>
                            <th scope="col-2" class="text-left">Bó hoa</th>
                            <th scope="col-2" class="text-left">Số lượng</th>
                            <th scope="col-2" class="text-left">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        <?php
                                if (isset($_SESSION["cart"])) {
                                    //print_r($_SESSION["cart"]);
                                    include "../src/flowerdb.php";
                                    $bdata = getSql("SELECT * FROM bouquet"); 
                                    $sum= 0;
                                    $ship= 30000;                           
                                    foreach ($_SESSION["cart"] as $key => $cart) {
                                            foreach ($bdata as $key2 => $b) {
                                                if ($b["b_ID"]==$cart["bid"]) {
                                                    echo "<tr>";
                                                    $img = getSql("SELECT * FROM bouq_img WHERE b_ID = '".$b["b_ID"]."' ORDER BY b_img_ID ASC");                                                    
                                                    if (sizeof($img)<=0) {
                                                        echo "<td>"."<img style='max-width:10vw' src='../img/undefined.jpg'>"."</td>";
                                                    }else{
                                                        if (file_exists("../".$img[0]["b_img"])) {
                                                            echo "<td>"."<img style='max-width:10vw' src='../".$img[0]["b_img"]."'>"."</td>";
                                                        }else{
                                                            echo "<td>"."<img style='max-width:10vw' src='../img/undefined.jpg'"."</td>";
                                                        }
                                                    }
                                                    echo "<td>",$b["b_name"],"</td>";
                                                    echo "<td>",$cart["quan"],"</td>";
                                                    echo "<td>",$aprice = $b["b_price"]*$cart["quan"],"</td>";
                                                    $sum = $sum + $aprice;
                                                    echo "</tr>";
                                                    break;
                                                }
                                            }
                                        }
                                    echo "<tr>";
                                    echo "<td>"."</td>";
                                    echo "<td>"."</td>";
                                    echo "<td>"."PHÍ SHIP"."</td>";
                                    echo "<td>".$ship."</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>"."</td>";
                                    echo "<td>"."</td>";
                                    echo "<td>"."TỔNG TIỀN THANH TOÁN"."</td>";
                                    echo "<td>",$sum+$ship,"</td>";
                                    echo "</tr>";
                                    
                                }else{
                                    echo "Chưa có dữ liệu giỏ hàng";
                                }
                        ?>
                    </tbody>
                    </tbody>
                </table>
            </div>

        </div>
        
        <div class="container col-4">
            <form method="get" action="paymentconfirm" id="frmPayment">
            <div class="card bg-light">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Thông tin thanh toán</h4>
                    <form>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="cusName" id="cusName" class="form-control" placeholder="Họ tên khách hàng" type="text">
                        </div> <!-- form-group// -->
                        <p style="color:red;display:none;"  id="nameLabel"></p>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="cusEmail" id="cusEmail"  class="form-control" placeholder="Địa chỉ email" type="text">
                        </div> <!-- form-group// -->
                        <p style="color:red;display:none;"  id="emailLabel"></p>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="cusAddress" id="cusAddress"  class="form-control" placeholder="Địa chỉ nhận hàng" type="text">
                        </div> <!-- form-group// -->
                        <p style="color:red;display:none;"  id="addressLabel"></p>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                            </div>
                            <input name="cusPhone" id="cusPhone"  class="form-control" placeholder="Số điện thoại" type="text">
                        </div> <!-- form-group// -->
                        <p style="color:red;display:none;"  id="phoneLabel"></p>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
                            </div>
                            <input name="dateVal" id="dateVal" class="form-control" placeholder="Ngày nhận hàng" type="datetime-local">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button  name="cmdPayment" id="cmdPayment"  type="button" class="btn btn-primary btn-block">Xác nhận thanh toán </button>
                                <input type="hidden" name ="cmdPayment">
                        </div> <!-- form-group// -->
                    </form>
                </article>
            </div>
            </form><!-- card.// -->
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
    <script src="../Scripts/1804HDTVShop/payment.js"></script>
</body>

</html>