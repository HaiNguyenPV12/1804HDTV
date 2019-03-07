<!DOCTYPE html>
<html ng-app="1804HDTVShop">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>1804HDTV Flower Shop</title>
    <link rel="stylesheet" href="../Content/bootstrap.min.css">
    <link rel="stylesheet" href="../Content/font-awesome.min.css">
    <link rel="stylesheet" href="../Content/bootstrap-social.css">
    <link rel="stylesheet" href="../Content/1804HDTVShop/custom.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!--LOGO-->
    <a href="index.php">
        <div class="abovenavbar">
        </div>
    </a>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm bg-light navbar-light justify-content-start sticky-top shadow">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Trang Chủ</a>
                </li>
                <!-- Flower Type Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">Loại Hoa</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#!test">test</a>
                        <!-- <a class="dropdown-item" href="#!mathematic">Mathematics</a>
                        <a class="dropdown-item" href="#!language">Languages</a> -->
                    </div>
                </li>
            </ul>
        </nav>

    <!-- content -->
    <div ng-view></div>

    <div class='container'>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
        <h1>text for scrolling</h1>
    </div>

    <!-- Footer -->
    <div class="footer">
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
                <div class="col-2">
                    1804 HDTV Co.
                </div>
                <div class="col-2">
                    test
                </div>
            </div>
        </div>
        <hr class="py-1">
        <div class="container-fluid text-center">
            <h4>&copy; COPYRIGHT 2019, 1804 HDTV COMPANY</h4>
        </div>
    </div>

    <!-- Scroll to top button -->
    <a href="#" class="ScrollToTop" title="Back to top">▲</a>

    <!--Scripts placed at end of document to make pages load faster-->
    <script src="../Scripts/angular.min.js"></script>
    <script src="../Scripts/angular-route.js"></script>
    <script src="../Scripts/jquery-3.3.1.min.js"></script>
    <script src="../Scripts/umd/popper.min.js"></script>
    <script src="../Scripts/bootstrap.min.js"></script>
    <script src="../Scripts/1804HDTVShop/shopScripts.js"></script>
    <!--Angular Controllers-->
</body>

</html>