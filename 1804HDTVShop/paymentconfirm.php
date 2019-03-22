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

    <?php
    include "../src/flowerdb.php";
    if (isset($_GET["cmdPayment"])&& isset($_GET["cusName"]) && isset($_GET["cusEmail"]) && isset($_GET["cusPhone"])&& isset($_GET["cusAddress"])&& isset($_GET["dateVal"])) 
    {
        $cName = $_GET["cusName"];
        $cEmail = $_GET["cusEmail"];
        $cAddress =$_GET["cusAddress"];
        $cPhone = $_GET["cusPhone"];    
        $dVal = $_GET["dateVal"];     
        $timezone = date_default_timezone_get();
        $date = date("Y-m-d",time());
        $csql = insertSql("insert into customer values(null,'$cPhone','$cName','$cAddress','$cEmail')");
        $data = getSql("select cus_ID from customer where cus_phone = '$cPhone'");
        $cusID = $data[0]['cus_ID'];
        $osql = insertSql("insert into orders values(null,'$cusID',1,'$date','$dVal')");
    }
        
    else
    {
        echo "Thiếu dữ kiện";
        exit();
    }          

    if (isset($_SESSION["cart"])) {
        //print_r($_SESSION["cart"]);
        $bdata = getSql("SELECT * FROM bouquet");                                 
        foreach ($_SESSION["cart"] as $key => $cart) {
                foreach ($bdata as $key2 => $b) {
                    if ($b["b_ID"]==$cart["bid"]) {
                        $sum = 0;
                        $cdata = getSql("select cus_ID from customer where cus_phone = '$cPhone'");
                        $cID = $cdata[0]['cus_ID'];
                        $odata = getSql("select order_ID from orders where cus_ID = '$cID'");
                        $ordID = $odata[0]['order_ID'];
                        $odsql = insertSql("insert into order_detail values(null,'$ordID','".$cart["bid"]."','".$cart["quan"]."')");
                        $aprice = $b["b_price"]*$cart["quan"];
                        $sum = $sum + $aprice;
                    }
                }
            } 
        }   

    else
    {
        echo "Thiếu dữ kiện cart";
    }
    echo "<p align='center'>THANH TOÁN THÀNH CÔNG</p>";
    echo "<table id='btable' class='table table-hover table-bordered table-sm text-center' style='width: auto' align='center'>";    
    echo "<tr class='table-info table-shop'>";    
    echo "<td>Tên Khách hàng</td>";                    
    echo "<td>",$cName,"</td>";
    echo "</tr>";
    echo "<tr class='table-info table-shop'>";    
    echo "<td>SĐT khách hàng</td>";                    
    echo "<td>",$cPhone,"</td>";
    echo "</tr>";
    echo "<tr class='table-info table-shop'>";    
    echo "<td>Email Khách hàng</td>";                    
    echo "<td>",$cEmail,"</td>";
    echo "</tr>";
    echo "<tr class='table-info table-shop'>";    
    echo "<td>Địa chỉ Khách hàng</td>";                    
    echo "<td>",$cAddress,"</td>";
    echo "</tr>";
    echo "<tr class='table-info table-shop'>";    
    echo "<td>Tổng số tiền thanh toán</td>";                    
    echo "<td>",$sum,"</td>";
    echo "</tr>";
    echo "</table>";

?>
    <div style="text-align: center">
    <a href='index.php' style="justify-content: center">TRỞ VỀ TRANG CHỦ</a><br>
    </div>
            
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