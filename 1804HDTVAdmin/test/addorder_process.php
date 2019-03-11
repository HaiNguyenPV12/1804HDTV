<a href='index.php'>Quay về</a><br>

<?php
    if (isset($_GET["cmdOrder"])) {
        if (isset($_GET["cid"]) && $_GET["cid"]!="") {
            if (isset($_GET["item"])) {
                //include "../src/flowerdb.php";
                if ($_GET["cid"]=="new") {
                    include "addcustomer.php";
                }else{
                    $cid=$_GET["cid"];
                    include "../../src/flowerdb.php";
                }
                echo "+ Đã tạo dữ liệu khách hàng.<br>";

                $timezone = date_default_timezone_get();
                $date = date("Y-m-d",time());
                include "../../src/fconnectadmin.php";
                $cn->query("insert into `orders` values (null,'$cid',1,'$date','$date')");
                $rs = $cn->query("select LAST_INSERT_ID() as orderid");
                while ($row = $rs->fetch_assoc()) {
                    $rows[] = $row;
                }
                $orderid = $rows[0]['orderid'];
                echo "+ Đã tạo dữ liệu đơn hàng.<br>";
                echo "+ Mã đơn hàng: ".$orderid."<br>";
                $cn->close();
                echo "Mặt hàng:<br>";
                foreach ($_GET["item"] as $key => $idata) {
                    $data = preg_split('/:/',$idata);
                    echo "".$data[0]." | SL:".$data[1]."<br>";
                    $insert = insertSql("INSERT INTO order_detail VALUES (null, '$orderid','".$data[0]."',".$data[1].")");
                }
            }
        }else{
            echo "Hãy chọn khách trước<br>";
            
        }
    }
?>