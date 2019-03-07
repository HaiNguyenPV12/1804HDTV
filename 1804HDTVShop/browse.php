<body>
<?php
include "../src/fconnectadmin.php";
if (isset($_GET["cate"]) && !empty($_GET["cate"])) {
    $cate = $_GET["cate"];
    $sql = "SELECT * from v_flower_gen where f_cate_name like '%$cate%'";
    $rs = mysqli_query($cn, $sql);
    while ($row = mysqli_fetch_assoc($rs)) {
        echo $row['f_ID'] . "<br>";
    }
}
else {
    echo "not set <br>";
}
?>
test
</body>