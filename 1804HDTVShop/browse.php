<body>
    <?php
include "../src/fconnectadmin.php";
?>
    <div class="container">
        <!-- filter -->
        <div class="col-12 mt-1">
            <div class="row" name="filterGen" id="filterGen">
                <form class="form-inline" action="" method="get">
                    <label class="mr-3" for="">
                        Lọc theo:
                    </label>
                    <!-- occasion dropdown -->
                    <select class="form-control mr-3" name="" id="">
                        <option value="">-- Dịp --</option>
                        <?php
$sqlFilterOcca = "SELECT distinct occa_name from v_bouq_gen";
$rs = mysqli_query($cn, $sqlFilterOcca);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<option value=\"" . $row['occa_name'] . "\">" . $row['occa_name'] . "</option>";
}
?>
                    </select>
                    <!-- cate dropdown -->
                    <select class="form-control mr-3" name="" id="">
                        <option value="">-- Loại hoa --</option>
                        <?php
$sqlFilterCate = "SELECT distinct f_cate_name from v_bouq_gen";
$rs = mysqli_query($cn, $sqlFilterCate);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<option value=\"" . $row['f_cate_name'] . "\">" . $row['f_cate_name'] . "</option>";
}
?>
                    </select>
                    <!-- color dropdown -->
                    <select class="form-control mr-3" name="" id="">
                        <option value="">-- Màu có trong bó --</option>
                        <?php
$sqlFilterCol = "SELECT distinct f_color_name from v_bouq_gen where f_color_name is not null";
$rs = mysqli_query($cn, $sqlFilterCol);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<option value=\"" . $row['f_color_name'] . "\">" . $row['f_color_name'] . "</option>";
}
?>
                    </select>
                    <button class="btn btn-shop" type="submit" name="btnFilterGen">
                        Lọc kết quả
                    </button>
                    <button class="btn btn-shop ml-1" name="btnSwitch" id="btnSwtich">
                        Tìm Kiếm Nâng Cao
                    </button>
                </form>
            </div>
            <!-- Advanced form -->
            <div class="row" name="filterAdv" id="filterAdv" style="display: none;">
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
                        <div class="col-3">
                            <!-- <input class="form-check-input" type="checkbox" value="" name="occa_list[]">Option 1 <br> -->
                            <?php
$rs = mysqli_query($cn, $sqlFilterOcca);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<input class=\"form-check-input\" type=\"checkbox\" value=\"" . $row['occa_name'] . "\" name=\"occa_list[]\">" . $row['occa_name'] . " <br>";
}
?>
                        </div>
                        <!-- category list -->
                        <div class="col-3">
                            <?php
$rs = mysqli_query($cn, $sqlFilterCate);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<input class=\"form-check-input\" type=\"checkbox\" value=\"" . $row['f_cate_name'] . "\" name=\"cate_list[]\">" . $row['f_cate_name'] . " <br>";
}
?>
                        </div>
                        <!-- color list -->
                        <div class="col-3">
                            <?php
$rs = mysqli_query($cn, $sqlFilterCol);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "<input class=\"form-check-input\" type=\"checkbox\" value=\"" . $row['f_color_name'] . "\" name=\"col_list[]\">" . $row['f_color_name'] . " <br>";
}
?>
                        </div>
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
            </div>
        </div>
        <!-- end of filter -->

        <?php
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
    </div>
</body>