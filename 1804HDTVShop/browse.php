<body>
    <div class="container">
        <div class="col-12 pl-5 pr-5 mt-1">
            <div class="row">
                <div class="form-inline" name="filterGen" id="filterGen">
                    <label class="mr-3" for="">
                        Lọc theo:
                    </label>

                    <select class="form-control mr-3" name="" id="">
                        <option value="">-- Dịp --</option>
                    </select>

                    <select class="form-control mr-3" name="" id="">
                        <option value="">-- Loại hoa --</option>
                    </select>

                    <select class="form-control mr-3" name="" id="">
                        <option value="">-- Màu có trong bó --</option>
                    </select>
                    <button class="btn btn-shop" type="submit" name="btnFilterGen">
                        Lọc kết quả
                    </button>
                    <button class="btn btn-shop ml-1" name="btnSwitch" id="btnSwtich">
                        Tìm Kiếm Nâng Cao
                    </button>
                </div>
                <!-- Advanced form -->
                <div class="form-inline" name="filterAdv" id="filterAdv" style="display: none;">
                    <label class="mr-3" for="">
                        Lọc theo:
                    </label>

                    <select class="form-control mr-3" name="" id="">
                        <option value="">-- Dịp 2--</option>
                    </select>

                    <select class="form-control mr-3" name="" id="">
                        <option value="">-- Loại hoa 2--</option>
                    </select>

                    <select class="form-control mr-3" name="" id="">
                        <option value="">-- Màu có trong bó 2--</option>
                    </select>
                    <button class="btn btn-shop" type="submit" name="btnFilterGen">
                        Lọc kết quả
                    </button>
                    <button class="btn btn-shop ml-1" name="btnSwitch2" id="btnSwtich2">
                        Tìm Kiếm Cơ Bản
                    </button>
                </div>
            </div>
            <?php
include "../src/fconnectadmin.php";
$sql = "SELECT DISTINCT b_name from v_bouq_gen";
// $sql = "SELECT DISTINCT b_name,b_img,b_price FROM v_bouq_gen WHERE b_img like '%_PV%'";
if (isset($_GET["cate"]) && !empty($_GET["cate"])) {
    global $sql;
    $cate = $_GET["cate"];
    $sql = "SELECT DISTINCT b_name from v_bouq_gen where f_cate_name like '%$cate%' and b_img like '%_PV%'"; //TODO refractor cate, cols, occa, etc.
} else if (isset($_GET["col"]) && !empty($_GET["col"])) {
    global $sql;
    $col = $_GET["col"];
    $sql = "SELECT DISTINCT b_name from v_bouq_gen where f_color_name like '%$col%'"; //TODO refractor cate, cols, occa, etc.
} else if (isset($_GET["occa"]) && !empty($_GET["occa"])) {
    global $sql;
    $occa = $_GET["occa"];
    $sql = "SELECT DISTINCT b_name from v_bouq_gen where occa_name like '%$occa%'"; //TODO refractor cate, cols, occa, etc.
}
$rs = mysqli_query($cn, $sql);
while ($row = mysqli_fetch_assoc($rs)) {
    echo $row['b_name'] . "<br>";
}
?>
</body>