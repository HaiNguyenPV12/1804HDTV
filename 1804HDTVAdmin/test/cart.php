<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xem giỏ hàng</title>
</head>
<body>
    <h2>Xem giỏ hàng</h2>
    <a href='index'>Back to Tester homepage</a><br>
    <?php
    session_start();
        if (isset($_SESSION["cart"])) {
            //print_r($_SESSION["cart"]);
            include "../../src/flowerdb.php";
            $bdata = getSql("SELECT * FROM bouquet");
            foreach ($_SESSION["cart"] as $key => $cart) {
                foreach ($bdata as $key2 => $b) {
                    if ($b["b_ID"]==$cart["bid"]) {
                        echo $b["b_name"]." : ".$cart["quan"]."<br>";
                        break;
                    }
                }
            }
        }else{
            echo "Chưa có dữ liệu giỏ hàng";
        }
    ?>
    <script src="../../Scripts/jquery-3.3.1.min.js"></script>
</body>
</html>