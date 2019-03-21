<head>
    <link rel="stylesheet" href="../Content/1804HDTVShop/about.css">
</head>

<body>
    <div class='container'>
        <!-- general text -->
        <div class="about-us-container mb-1 mt-1">
            <div class="row col-8 mx-auto">
                <div class="about-us-text text-center mt-5 mb-5">
                    <h2>
                        Về chúng tôi
                    </h2>
                    <h6>
                        Shop <b>Hoa HDTV</b> bao gồm đội ngũ nhân viên chuyên về các loại hoa trong mọi lĩnh vực, có
                        kinh
                        nghiệm
                        hơn 10 năm trong việc kinh doanh các loại hoa.<br>
                        Ngoài việc kinh doanh, chúng tôi còn tư vấn cho khách hàng mọi thứ về hoa như nên tặng hoa
                        nào
                        vào
                        dịp
                        nào, ý nghĩa của hoa đó là gì, nên chọn màu ra sao,v.v...
                    </h6>
                </div>
            </div>
        </div>
        <!-- end of gen text -->

        <!-- staff cards -->
        <!-- template -->
        <!-- <div class="staff-card">
            <div class="row staff-details h-100">
                <div class='col-7 staff-text text-left'>
                    <div class='row'>
                        <div class='col'>
                            <h5 class='pt-2'>
                                test
                            </h5>
                            <p class='my-0'>
                                email <br>
                                phone <br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
                <div class="col-2">
                    <button class="btn btn-shop btn-shop-email">
                        <a href="">
                            <h5>
                                Gửi Email
                            </h5>
                        </a>
                    </button>
                </div>
            </div>
        </div> -->
        <!-- end of template -->
        <?php
include "../src/sconnectadmin.php";
$sql = "SELECT s_name,s_phone,s_email FROM staff WHERE s_role_ID = 'fullstaff' and s_employed = 1";
$rs = mysqli_query($cn, $sql);
$numResults = mysqli_num_rows($rs);
// echo $numResults;
if ($numResults > 0) {
    echo "<div class='col-4 mx-auto text-center mt-2 mb-1'>
            <h3>
                Nhân Viên Hỗ Trợ
            </h3>
        </div>";
    while ($row = mysqli_fetch_assoc($rs)) {
        echo "
        <div class='staff-card'>
                <div class='row staff-details h-100'>
                    <div class='col-7 staff-text text-left'>
                        <div class='row'>
                            <div class='col'>
                                <h5 class='pt-2'>
                                    " . $row['s_name'] . "
                                </h5>
                                <p class='my-0'>
                                    Email: " . $row['s_email'] . " <br>
                                    Điện Thoại: " . $row['s_phone'] . " <br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class='col-3'></div>
                    <div class='col-2'>
                        <button class='btn btn-shop btn-shop-email'>
                            <a href='mailto:" . $row['s_email'] . "'>
                                <h5>
                                    Gửi Email
                                </h5>
                            </a>
                        </button>
                    </div>
                </div>
        </div>
        ";
    }
}
?>
    </div>
</body>