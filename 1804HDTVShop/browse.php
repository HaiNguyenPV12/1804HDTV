<head>
    <link rel="stylesheet" href="../Content/1804HDTVShop/browse.css">
</head>

<body>
    <?php
include "../src/fconnectadmin.php";
?>
    <div class='container-fluid'>
        <!-- filter -->
        <div class="col-12 mt-1">
            <div class="row justify-content-center" name="filterGen" id="filterGenForm">
                <form class="form-inline" method="get" id="filterGen">
                    <label class="mr-3" for="">
                        Lọc theo:
                    </label>
                    <!-- occasion dropdown -->
                    <select class="form-control mr-3" name="occaFilter" id="occaFilter">
                        <option value="unset">-- Dịp --</option>
                        <?php
$sqlFilterOcca = "SELECT distinct occa_name from v_bouq_gen where occa_name is not null";
$rs = mysqli_query($cn, $sqlFilterOcca);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<option value=\"" . $row['occa_name'] . "\">" . $row['occa_name'] . "</option>";
}
?>
                    </select>
                    <!-- cate dropdown -->
                    <select class="form-control mr-3" name="cateFilter" id="cateFilter">
                        <option value="unset">-- Loại hoa --</option>
                        <?php
$sqlFilterCate = "SELECT distinct f_cate_name from v_bouq_gen";
$rs = mysqli_query($cn, $sqlFilterCate);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<option value=\"" . $row['f_cate_name'] . "\">" . $row['f_cate_name'] . "</option>";
}
?>
                    </select>
                    <!-- color dropdown -->
                    <select class="form-control mr-3" name="colFilter" id="colFilter">
                        <option value="unset">-- Màu có trong bó --</option>
                        <?php
$sqlFilterCol = "SELECT distinct f_color_name from v_bouq_gen where f_color_name is not null";
$rs = mysqli_query($cn, $sqlFilterCol);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<option value=\"" . $row['f_color_name'] . "\">" . $row['f_color_name'] . "</option>";
}
?>
                    </select>
                    <!-- flower name dropdown -->
                    <select class="form-control mr-3" name="fnameFilter" id="fnameFilter">
                        <option value="unset">-- Hoa có trong bó --</option>
                        <?php
$sqlFilterCol = "SELECT distinct f_name from v_bouq_gen where f_name is not null";
$rs = mysqli_query($cn, $sqlFilterCol);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<option value=\"" . $row['f_name'] . "\">" . $row['f_name'] . "</option>";
}
?>
                    </select>
                    <!-- flower price dropdown -->
                    <select class="form-control mr-3" name="priceFilter" id="priceFilter">
                        <option value="unset">-- Giá bó --</option>
                        <option value="asc">-- Tăng dần --</option>
                        <option value="desc">-- Giảm dần --</option>
                    </select>
                    <button class="btn btn-shop" name="btnFilterGen" id="btnFilterGen">
                        <a id="filterGenLink" href='#!browse.php/filter/unset/unset/unset/unset/unset'>
                            Lọc kết quả
                        </a>
                    </button>
            </div>
            <!-- end of filter -->
        </div>
        <div class="container">
            <?php
$sql = "SELECT DISTINCT b_id,b_name,b_img,b_price from v_bouq_gen";
$set = false;
// $sql = "SELECT DISTINCT b_name,b_img,b_price FROM v_bouq_gen WHERE b_img like '%_PV%'";
if (isset($_GET["cate"]) && !empty($_GET["cate"])) {
    global $sql, $set;
    $cate = $_GET["cate"];
    // $sql = "SELECT DISTINCT b_name from v_bouq_gen where f_cate_name like '%$cate%' and b_img like '%_00%'";
    if ($cate == "unset") {
        $sql .= " WHERE f_cate_name like '%%'";
        $set = true;
    } else {
        $sql .= " WHERE f_cate_name like '%$cate%'";
        $set = true;
    }
}
if (isset($_GET["col"]) && !empty($_GET["col"])) {
    global $sql, $set;
    $col = $_GET["col"];
    if ($col == "unset" && $set == false) {
        $sql .= " where f_color_name like '%%'";
    } else if ($col == "unset" && $set == true) {
        $sql .= " and f_color_name like '%%'";
    } else if ($set == true) {
        $sql .= " and f_color_name like '%$col%'";
    } else {
        $sql .= " where f_color_name like '%$col%'";
        $set = true;
    }
}
if (isset($_GET["occa"]) && !empty($_GET["occa"])) {
    global $sql, $set;
    $occa = $_GET["occa"];
    //TODO refractor ifs
    if ($occa == "unset" && $set == false) {
        $sql .= " where occa_name like '%%'";
    } else if ($occa == "unset" && $set == true) {
        $sql .= " and occa_name like '%%'";
    } else if ($set == true) {
        $sql .= " and occa_name like '%$occa%'";
    } else {
        $sql .= " where occa_name like '%$occa%'";
        $set = true;
    }
}
if (isset($_GET["fname"]) && !empty($_GET["fname"])) {
    global $sql, $set;
    $fname = $_GET["fname"];
    if ($fname == "unset" && $set == false) {
        $sql .= " where f_name like '%%'";
    } else if ($fname == "unset" && $set == true) {
        $sql .= " and f_name like '%%'";
    } else if ($set == true) {
        $sql .= " and f_name = '$fname'";
    } else {
        $sql .= " where f_name = '$fname'";
        $set = true;
    }
}
if ($set == true) {
    $sql .= " and b_selling = 1 and b_img like '%_00.%'";
} else {
    $sql .= " where b_img like '%_00.%' and b_selling = 1";
}
if (isset($_GET["price"]) && !empty($_GET["price"])) {
    global $sql, $set;
    $price = $_GET["price"];
    if ($price == "unset") {
        $sql .= " ORDER BY b_name asc";
    } else if ($price == "asc") {
        $sql .= " ORDER BY b_price asc";
        $set = true;
    } else if ($price == "desc") {
        $sql .= " ORDER BY b_price desc";
        $set = true;
    }
}
// echo $sql;
?>
            <div class="row mt-3">
                <?php
// setlocale(LC_MONETARY, "en_US");
$rs = mysqli_query($cn, $sql);
if (mysqli_num_rows($rs) <= 0) {
    echo "
    <div class='col-12 text-center mx-0'>
        <h6 class='text-center'>
            Không tìm thấy bó
        </h6>
    </div>";
}
while ($row = mysqli_fetch_assoc($rs)) {
    // echo $row['b_name'] . "<br>";
    echo "<div class='col-lg-3 col-md-5 mb-4'>
            <div class='card card-bouq h-80 border-primary border-shop'>
                <a href='#!product/" . $row['b_ID'] . "'>
                    <img class='card-img-top custom' src='../" . $row['b_img'] . "' alt=''>
                </a>
                <div class='card-body'>
                    <h5 class='card-title'>
                        <a href='#!product/" . $row['b_ID'] . "'>" . $row['b_name'] . "</a>
                    </h5>
                    <h6>" . number_format($row['b_price'], 0, '.', ',') . " Đ</h6>
                </div>

                <button class='btn card-footer btn-shop'>
                    <a href='#!product/" . $row['b_ID'] . "'>
                        Xem chi tiết
                    </a>
                </button>

            </div>
        </div>";
}
?>
            </div>
        </div>
</body>