<body>
    <div class="container col-12 pl-5 pr-5">
        <div class="row">
            <div class="form-inline">
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
                <button class="btn btn-shop">
                    Lọc kết quả
                </button>
            </div>
        </div>
    </div>
    <?php
include "../src/fconnectadmin.php";
if (isset($_GET["cate"]) && !empty($_GET["cate"])) {
    $cate = $_GET["cate"];
    $sql = "SELECT * from v_flower_gen where f_cate_name like '%$cate%'"; //TODO select from bouq view
    $rs = mysql_query($cn, $sql);
    while ($row = mysql_fetch_assoc($rs)) {
        echo $row['f_ID'] . "<br>";
    }
}
if (isset($_GET["col"]) && !empty($_GET["col"])) {
    $col = $_GET["col"];
    $sql = "SELECT * from v_flower_gen where f_color_name like '%$col%'"; //TODO select from bouq view
    $rs = mysql_query($cn, $sql);
    while ($row = mysql_fetch_assoc($rs)) {
        echo $row['f_ID'] . "<br>";
    }
}
?>
    test
</body>