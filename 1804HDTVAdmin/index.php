<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("Location: login");
}
//include './src/staffdb.php';
//$rights = getSql("SELECT * from `right` where s_cate_ID = '".$_SESSION['sCate']."'");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quản lý Shop bán hoa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="../Content/bootstrap.min.css" rel="stylesheet">
    <link href="../Content/1804HDTVAdmin/custom-color.css" rel="stylesheet">
    <link rel="shortcut icon" href="#">
</head>
    <!-- jQuery -->
    <script src="../Scripts/jquery-3.3.1.js"></script>
    <!-- Angular -->
    <script src="../Scripts/angular.min.js"></script>
    <script src="../Scripts/angular-route.js"></script>
    <!-- Bootstrap -->
    <script src="../Scripts/bootstrap.min.js"></script>
    <!-- Script tùy chỉnh -->
    <script src="../Scripts/1804HDTVAdmin/spa.js"></script>
    <style>
        body {
            padding-top: 2%;
            margin-left: 2%;
            margin-right: 2%;
        }
        .sticky-offset {
            top: 56px;
        }
        .main{
            top: 56px;
        }
        @media only screen and (max-width: 1200px) {
            .sticky-offset {
                position:relative;
                z-index: 0;
                top:3vh;
            }
            .main{
                left: auto;
            }
        }
    </style>

<body ng-app="myApp" >
    <!-- Thanh tựa đề -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top bg-shop">
        <div class="container">
            <a class="navbar-brand text-light" href="#"><h3>Quản lý Shop bán hoa</h3></a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <div class="nav-link">Xin chào <span class='font-weight-bold'><?php echo $_SESSION["uName"] ?></span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Đăng xuất</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <!-- Phần bên dưới -->
    <div class="container-fluid" >
        <div class="row col-12">
            <!-- Menu trái -->
            <div class="col-lg-2 sticky-offset">
                <h3 class="my-3 text-center">Trang quản trị</h3>
                <h2 class="my-3 text-center">Shop HDTV</h2>
                <div class="list-group">
                    <?php

                        $rightsdata = $_SESSION["sRight"];
                        if (in_array("Q01",$rightsdata,true) || in_array("Q00",$rightsdata,true)) {
                            echo '<a href="#!bouquet" class="list-group-item list-group-item-shop">Quản lý Bó Hoa</a>';
                        }
                        if (in_array("Q02",$rightsdata,true) || in_array("Q00",$rightsdata,true)) {
                            echo '<a href="#!flower" class="list-group-item list-group-item-shop">Quản lý Hoa</a>';
                        }
                        if (in_array("Q04",$rightsdata,true) || in_array("Q00",$rightsdata,true)) {
                            echo '<a href="#!occasion" class="list-group-item list-group-item-shop">Quản lý Dịp</a>';
                        }
                        if (in_array("Q05",$rightsdata,true) || in_array("Q00",$rightsdata,true)) {
                            echo '<a href="#!staff" class="list-group-item list-group-item-shop">Quản lý Nhân Viên</a>';
                            echo '<a href="#!role" class="list-group-item list-group-item-shop">Quản lý Chức Vụ</a>';
                            
                        }
                        if (in_array("Q06",$rightsdata,true) || in_array("Q00",$rightsdata,true)) {
                            echo '<a href="#!order" class="list-group-item list-group-item-shop">Quản lý Đơn Hàng</a>';
                            echo '<a href="#!statistic" class="list-group-item list-group-item-shop">Xem thống kê doanh thu</a>';
                        }
                        if (in_array("Q10",$rightsdata,true) || in_array("Q00",$rightsdata,true)) {
                            echo '<a href="#!customer" class="list-group-item list-group-item-shop">Quản lý Khách Hàng</a>';
                            echo '<a href="#!member" class="list-group-item list-group-item-shop">Quản lý Thành viên</a>';
                        }
                        if (in_array("Q07",$rightsdata,true) || in_array("Q00",$rightsdata,true)) {
                            echo '<a href="#!comment" class="list-group-item list-group-item-shop">Quản lý Bình Luận</a>';
                        }
                        if (in_array("Q08",$rightsdata,true) || in_array("Q00",$rightsdata,true)) {
                            echo '<a href="#!feedback" class="list-group-item list-group-item-shop">Quản lý Đánh Giá</a>';
                        }
                    ?>

                    <!--
                    <a href="#!bouquet" class="list-group-item">Quản lý bó hoa</a>
                    <a href="#!flower" class="list-group-item">Quản lý hoa</a>
                    <a href="#!category" class="list-group-item">Quản lý loại hoa</a>
                    <a href="#!color" class="list-group-item">Quản lý màu</a>
                    <a href="#!staff" class="list-group-item">Quản lý nhân viên</a>
                    <a href="#!right" class="list-group-item">Quản lý quyền</a>
                    <a href="#!order" class="list-group-item">Quản lý đơn hàng</a>
                    <a href="#!customer" class="list-group-item">Quản lý khách hàng</a>
                    <a href="#!comment" class="list-group-item">Quản lý bình luận</a>
                    <a href="#!feedback" class="list-group-item">Quản lý đánh giá</a>
                    <a href="#!statistic" class="list-group-item">Xem thống kê doanh thu</a>
                    -->
                </div>
            </div>

            <!-- Phần nội dung chính -->
            <div ng-controller="myMain" id="myMain" class="my-3 col-lg-10 main">
                <div name="content"  ng-view>

                </div>
            </div>


        </div>
    </div>
</body>
</html>