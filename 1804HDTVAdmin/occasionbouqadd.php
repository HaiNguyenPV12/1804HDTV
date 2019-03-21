<html>
<script src="../Scripts/1804HDTVAdmin/occabadd.js"></script>

<body>
    <?php
include '../src/fconnectadmin.php';
include '../src/flowerdb.php';
$occaID = $_GET['occaID'];
$bid = $_GET['bid'];
// $sql = "INSERT into occasion_detail (oc_d_ID,b_ID,occa_ID,occa_has) values (NULL,'$bid','$occaID',1)";
insertSql("INSERT into occasion_detail (oc_d_ID,b_ID,occa_ID,occa_has) values (NULL,'$bid','$occaID',1)");
// header('location:#!occasion/bouq/');
echo "<a href='#!occasion/bouq/$occaID' id='btnBouqAdd'></a>"
?>

</body>

</html>