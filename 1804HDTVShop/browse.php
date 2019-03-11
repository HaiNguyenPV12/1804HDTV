<body>
    <div class="container">
        <?php
include "../src/fconnectadmin.php";
if (isset($_GET["cate"]) && !empty($_GET["cate"])) {
    $cate = $_GET["cate"];
    $sql = "SELECT DISTINCT b_name from v_bouq_gen where f_cate_name like '%$cate%'"; //TODO select from bouq view
    $rs = mysqli_query($cn, $sql);
    while ($row = mysqli_fetch_assoc($rs)) {
        echo $row['b_name'] . "<br>";
    }
} else if (isset($_GET["col"]) && !empty($_GET["col"])) {
    echo "getting colors";
} else if (isset($_GET["occa"]) && !empty($_GET["occa"])) {
    echo "getting occas";
}
?>
    </div>
    <br>
    test
</body>