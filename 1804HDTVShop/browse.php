<body>
<?php
include "../src/fconnectadmin.php";
if (isset($_GET["cate"]) && !empty($_GET["cate"])) {
    $cate = $_GET["cate"];
    $sql = "SELECT * from v_flower_gen where f_cate_name like '%$cate%'"; //TODO select from bouq view
    $rs = mysqli_query($cn, $sql);
    while ($row = mysqli_fetch_assoc($rs)) {
        echo $row['f_ID'] . "<br>";
    }
}
if (isset($_GET["col"]) && !empty($_GET["col"])) {
    $col = $_GET["col"];
    $sql = "SELECT * from v_flower_gen where f_color_name like '%$col%'"; //TODO select from bouq view
    $rs = mysqli_query($cn, $sql);
    while ($row = mysqli_fetch_assoc($rs)) {
        echo $row['f_ID'] . "<br>";
    }
}
?>
test
</body>