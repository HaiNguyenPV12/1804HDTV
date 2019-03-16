<head>
    <link rel="stylesheet" href="../Content/1804HDTVShop/home.css">
</head>

<body>
    <div class='container-fluid'>
        <!-- individual occasion cards on front page -->
        <!-- TODO complete rework, link backgrounds with php, get contents from database, etc -->
        <?php
include "../src/fconnectadmin.php";
$sql = "SELECT * FROM occasion WHERE occa_fp = 1";
$rs = mysqli_query($cn, $sql);
$cardindex = 1;
while ($row = mysqli_fetch_assoc($rs)) {

    if ($cardindex % 2 == 0) {
        $class = '2';
    } else {
        $class = '1';
    }
    echo "<div style=\"background: url(../" . $row['occa_img'] . "); background-size: cover;\" class='event-card'>
        <div class='row event-details h-100'>
            <div class='col-5 pull-left event-text-" . $class . " text-center'>
                <div class='row h-75'>
                    <div class='col my-auto'>
                        <h2>Hoa " . $row['occa_name'] . "</h2>
                        <pre class='event-text-content'>
                            " . $row['occa_detail'] . "
                        </pre>
                    </div>
                </div>
                <a href='#!browse.php/occa/" . $row['occa_name'] . "' class='btn btn-primary btn-shop'>Xem Chi Tiết</a>
            </div>
        </div>
    </div>";
    $cardindex++;
}
?>
        <!-- Event Cards template -->
        <!-- <div style="background: url(../img/1804HDTVShop/Occasions/occa-camon-test.png); background-size: cover;" class="event-card">
            <div class="row event-details h-100">
                <div class="col-5 pull-left event-text-1 text-center">
                    <div class="row h-75">
                        <div class="col my-auto">
                            <h2>Hoa Cảm Ơn</h2>
                            <p>
                                khi bạn nói “cảm ơn” bằng bó hoa tươi thắm để thể hiện lòng biết ơn sâu sắc của bạn đến
                                những người yêu thương. <br>
                                Hãy làm một ai đó cười hạnh phúc với những bó hoa trang trí hiện đại, hoa hồng cổ điển
                                hoặc hoa sơn trà
                            </p>
                        </div>
                    </div>
                    <a href="" class=" btn btn-primary btn-shop">Xem Chi Tiết</a>
                </div>
            </div>
        </div> -->

        <!-- location -->
        <div style="background: url(../img/1804HDTVShop/home/location.png); background-size: cover;"
            class="location-card">
            <div class="row event-details h-100">
                <div class="col-4 location-text text-center">
                    <div class="row h-75">
                        <div class="col my-auto">
                            <h3>Mua Tại Nơi</h3>
                            <p>
                                HDTV shop luôn sẵn sàng phục vụ quý khách <br>
                                Thứ 2 đến Thứ 7: 08:00-16:00 <br>
                                Chủ Nhật: 08:00-12:00
                            </p>
                        </div>
                    </div>
                    <!-- Button to Open the Modal -->
                    <a class="btn btn-primary btn-shop" href="" data-toggle="modal" data-target="#locationModal">Địa Chỉ
                        Shop</a>
                </div>
            </div>
        </div>
        <!-- feedback -->
        <div style="background: url(../img/1804HDTVShop/home/feedback.png); background-size: cover;"
            class="feedback-card">
            <div class="row event-details h-100">
                <div class="col-4 location-text text-center">
                    <div class="row h-75">
                        <div class="col my-auto">
                            <h3>Khách Hàng Là Trên Hết</h3>
                            <p>
                                HDTV Shop luôn phấn đấu cải thiện trải nghiệm của khách hàng. <br>
                                Đóng góp ý kiến để giúp chúng tôi giúp bạn.
                            </p>
                        </div>
                    </div>
                    <a href="" class=" btn btn-primary btn-shop">Đóng Góp Ý Kiến</a>
                </div>
            </div>
        </div>

        <!-- about us -->
        <div style="background: url(../img/1804HDTVShop/home/feedback.png); background-size: cover;"
            class="feedback-card">
            <div class="row event-details h-100">
                <div class="col-4 location-text text-center">
                    <div class="row h-75">
                        <div class="col my-auto">
                            <h3>Tìm Hiểu Shop 1804 HDTV</h3>
                            <p>
                                Tìm hiểu thêm về cửa hàng bán hoa <br>
                                và xem đội ngũ hỗ trợ.
                            </p>
                        </div>
                    </div>
                    <a href="#!about.php" class=" btn btn-primary btn-shop">Về Chúng Tôi</a>
                </div>
            </div>
        </div>

        <!-- modal for map/location -->
        <div class="modal fade" id="locationModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">1804 HDTV Flower Shop</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>
                                Địa Chỉ: 590 Cách Mạng Tháng 8, Phường 11, Quận 3, Hồ Chí Minh <br>
                                Giờ Làm Việc: <br>
                                Thứ 2 đến Thứ 7: 08:00-16:00 <br>
                                Chủ Nhật: 08:00-12:00
                            </p>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.321038152839!2d106.66424331527466!3d10.786705261952378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ed2392c44df%3A0xd2ecb62e0d050fe9!2sFPT-Aptech+Computer+Education+HCM!5e0!3m2!1sen!2sus!4v1533999304150"
                                width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a class="btn btn-primary btn-shop" role="button" href="https://goo.gl/maps/CoS2YfedVe82"
                            target="_blank">Xem trong Google Maps</a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>