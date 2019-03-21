<html>
<script src="../Scripts/1804HDTVAdmin/occabdel.js"></script>

<body>
    <?php
include '../src/fconnectadmin.php';
include '../src/flowerdb.php';
$occaID = $_GET['occaID'];
$bid = $_GET['bid'];
// $sql = "INSERT into occasion_detail (oc_d_ID,b_ID,occa_ID,occa_has) values (NULL,'$bid','$occaID',1)";
deleteSql("DELETE FROM occasion_detail where b_ID = '$bid' and occa_ID = '$occaID'");
// header('location:#!occasion/bouq/');
echo "<a href='#!occasion/bouq/$occaID' id='btnBouqDel'></a>"
?>

</body>

</html>