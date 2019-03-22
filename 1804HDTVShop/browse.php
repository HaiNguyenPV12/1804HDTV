<head>
    <link rel="stylesheet" href="../Content/1804HDTVShop/browse.css">
</head>
<body>
    <?php
include "../src/fconnectadmin.php";
?>
    <div class="container">
        <!-- filter -->
        <div class="col-12 mt-1">
            <div class="row" name="filterGen" id="filterGenForm">
                <form class="form-inline" method="get" id="filterGen">
                    <label class="mr-3" for="">
                        Lọc theo:
                    </label>
                    <!-- occasion dropdown -->
                    <select class="form-control mr-3" name="occaFilter" id="occaFilter">
                        <option value="*">-- Dịp --</option>
                        <?php
$sqlFilterOcca = "SELECT distinct occa_name from v_bouq_gen";
$rs = mysql_query($cn, $sqlFilterOcca);
while ($row = mysql_fetch_assoc($rs)) {
    echo "<option value=\"" . $row['occa_name'] . "\">" . $row['occa_name'] . "</option>";
}
?>
                    </select>
                    <!-- cate dropdown -->
                    <select class="form-control mr-3" name="cateFilter" id="cateFilter">
                        <option value="*">-- Loại hoa --</option>
                        <?php
$sqlFilterCate = "SELECT distinct f_cate_name from v_bouq_gen";
$rs = mysql_query($cn, $sqlFilterCate);
while ($row = mysql_fetch_assoc($rs)) {
    echo "<option value=\"" . $row['f_cate_name'] . "\">" . $row['f_cate_name'] . "</option>";
}
?>
                    </select>
                    <!-- color dropdown -->
                    <select class="form-control mr-3" name="colFilter" id="colFilter">
                        <option value="*">-- Màu có trong bó --</option>
                        <?php
$sqlFilterCol = "SELECT distinct f_color_name from v_bouq_gen where f_color_name is not null";
$rs = mysql_query($cn, $sqlFilterCol);
while ($row = mysql_fetch_assoc($rs)) {
    echo "<option value=\"" . $row['f_color_name'] . "\">" . $row['f_color_name'] . "</option>";
}
?>
                    </select>
                    <!-- flower name dropdown -->
                    <select class="form-control mr-3" name="fnameFilter" id="fnameFilter">
                        <option value="*">-- Hoa có trong bó --</option>
                        <?php
$sqlFilterCol = "SELECT distinct f_name from v_bouq_gen where f_name is not null";
$rs = mysql_query($cn, $sqlFilterCol);
while ($row = mysql_fetch_assoc($rs)) {
    echo "<option value=\"" . $row['f_name'] . "\">" . $row['f_name'] . "</option>";
}
?>
                    </select>
                    <button class="btn btn-shop" name="btnFilterGen" id="btnFilterGen">
                        <a id="filterGenLink" href='#!browse.php/filter/*/*/*/*'>
                            Lọc kết quả
                        </a>
                    </button>
                    <!-- advanced form button -->
                    <!-- <button class="btn btn-shop ml-1" name="btnSwitch" id="btnSwtich">
                        Tìm Kiếm Nâng Cao
                    </button> -->
                </form>
            </div>
            <!-- Advanced form -->
            <!-- start of advanced form -->
            <!-- <div class="row" name="filterAdv" id="filterAdv" style="display: none;">
                <form class="form-inline col-12" action="" method="get">
                    <label class="col-2" for="">
                        Lọc theo:
                    </label>
                    <label class="col-3">
                        <b>Dịp</b>
                    </label>

                    <label class="col-3 form-check-label">
                        <b>Loại Hoa</b>
                    </label>

                    <label class="col-3 form-check-label">
                        <b>Màu Có Trong Bó</b>
                    </label>
                    <div class="row col-12">
                        <div class="col-3"></div>
                        <!-- occasion list -->
                        <!-- <div class="col-3"> -->
                            <!-- <input class="form-check-input" type="checkbox" value="" name="occa_list[]">Option 1 <br> -->
                            <?php
// $rs = mysql_query($cn, $sqlFilterOcca);
// while ($row = mysql_fetch_assoc($rs)) {
//     echo "<input class=\"form-check-input\" type=\"checkbox\" value=\"" . $row['occa_name'] . "\" name=\"occa_list[]\">" . $row['occa_name'] . " <br>";
// }
?>
                        <!-- </div> -->
                        <!-- category list -->
                        <!-- <div class="col-3"> -->
                            <?php
// $rs = mysql_query($cn, $sqlFilterCate);
// while ($row = mysql_fetch_assoc($rs)) {
//     echo "<input class=\"form-check-input\" type=\"checkbox\" value=\"" . $row['f_cate_name'] . "\" name=\"cate_list[]\">" . $row['f_cate_name'] . " <br>";
// }
?>
                        <!-- </div> -->
                        <!-- color list -->
                        <!-- <div class="col-3"> -->
                            <?php
// $rs = mysql_query($cn, $sqlFilterCol);
// while ($row = mysql_fetch_assoc($rs)) {
//     echo "<input class=\"form-check-input\" type=\"checkbox\" value=\"" . $row['f_color_name'] . "\" name=\"col_list[]\">" . $row['f_color_name'] . " <br>";
// }
?>
                        <!-- </div>
                    </div>
                    <div class="col-12">
                        <div class="col-4 mx-auto">
                            <button class="btn btn-shop" type="submit" name="btnFilterAdv">
                                Lọc kết quả
                            </button>
                            <button class="btn btn-shop ml-1" name="btnSwitch2" id="btnSwtich2">
                                Tìm Kiếm Cơ Bản
                            </button>
                        </div>
                    </div>
                </form>
            </div> -->
            <!-- end of advanced form -->
        </div>
        <!-- end of filter -->

        <?php
$sql = "SELECT DISTINCT b_id,b_name,b_img,b_price from v_bouq_gen";
$set = false;
// $sql = "SELECT DISTINCT b_name,b_img,b_price FROM v_bouq_gen WHERE b_img like '%_PV%'";
if (isset($_GET["cate"]) && !empty($_GET["cate"])) {
    global $sql, $set;
    $cate = $_GET["cate"];
    // $sql = "SELECT DISTINCT b_name from v_bouq_gen where f_cate_name like '%$cate%' and b_img like '%_00%'";
    if ($cate == "*") {
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
    if ($col == "*" && $set == false) {
        $sql .= " where f_color_name like '%%'";
    } else if ($col == "*" && $set == true) {
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
    if ($occa == "*" && $set == false) {
        $sql .= " where occa_name like '%%'";
    } else if ($occa == "*" && $set == true) {
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
    if ($fname == "*" && $set == false) {
        $sql .= " where f_name like '%%'";
    } else if ($fname == "*" && $set == true) {
        $sql .= " and f_name like '%%'";
    } else if ($set == true) {
        $sql .= " and f_name = '$fname'";
    } else {
        $sql .= " where f_name = '$fname'";
        $set = true;
    }
}
if ($set == true) {
    $sql .= " and b_selling = 1 and b_img like '%_00.jpg%' ORDER BY b_name asc";
} else {
    $sql .= " where b_img like '%_00.jpg%' and b_selling = 1 ORDER BY b_name asc";
}
// echo $sql;
?>
        <div class="row mt-3">


            <?php
// setlocale(LC_MONETARY, "en_US");
$rs = mysql_query($cn, $sql);
if (mysql_num_rows($rs) <= 0) {
    echo "
    <div class='col-12 text-center mx-0'>
        <h6 class='text-center'>
            Không tìm thấy bó
        </h6>
    </div>";
}
while ($row = mysql_fetch_assoc($rs)) {
    // echo $row['b_name'] . "<br>";
    echo "<div class='col-lg-3 col-md-5 mb-4'>
            <div class='card card-bouq h-80 border-primary border-shop'>
                <a href='#!product/" . $row['b_ID'] . "'>
                    <img class='card-img-top custom' src='../img/Bouquet/B000/B000_PV.jpg' alt=''>
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