<body>
    <div class="container">
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
    </div>
    <!-- <br>
    test -->
</body>