
<?php
    if (isset($_GET['delivered']) && isset($_GET['oid'])) {
        $oid =$_GET['oid'];
        include '../src/flowerdb.php';
        updateSql("update orders set order_status=2 where order_ID='$oid'");
    }else if(isset($_GET['aborted']) && isset($_GET['oid'])){
        $oid =$_GET['oid'];
        include '../src/flowerdb.php';
        updateSql("update orders set order_status=0 where order_ID='$oid'");
    }else{
        echo "Không đủ dữ liệu thực thi lệnh";
    }
?>
<script src="../Scripts/1804HDTVAdmin/orderprocess.js"></script>
<a id="back" href="#!order">Back</a>