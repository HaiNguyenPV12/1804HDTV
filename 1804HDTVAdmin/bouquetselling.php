<!-- Trang xử lý đổi trạng thái đang bán -->

<?php
    if (isset($_GET['selling']) && isset($_GET['bid'])) {
        $bid =$_GET['bid'];
        include '.././src/flowerdb.php';
        updateSql("update bouquet set b_selling=1 where b_ID='$bid'");
    }else if(isset($_GET['notselling']) && isset($_GET['bid'])){
        $bid =$_GET['bid'];
        include '.././src/flowerdb.php';
        updateSql("update bouquet set b_selling=0 where b_ID='$bid'");
    }else{
        echo "Không đủ dữ liệu thực thi lệnh";
    }
?>
<script src="./Scripts/custom/bouquetselling.js"></script>
<a id="back" href="#!bouquet">Back</a>