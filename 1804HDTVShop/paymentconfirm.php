<?php
include "../src/fconnectadmin.php";
session_start();
?>

    <!-- content -->

<?php
    include "../src/flowerdb.php";
    if (isset($_POST["cmdPayment"])&& isset($_POST["cusName"]) && isset($_POST["cusEmail"]) && isset($_POST["cusPhone"])&& isset($_POST["cusAddress"])&& isset($_POST["dateVal"])) 
    {
        $cName = $_POST["cusName"];
        $cEmail = $_POST["cusEmail"];
        $cAddress =$_POST["cusAddress"];
        $cPhone = $_POST["cusPhone"];    
        $dVal = $_POST["dateVal"];     
        $timezone = date_default_timezone_get();
        $date = date("Y-m-d",time());
        $existed = getSql("SELECT * FROM customer WHERE cus_phone = '$cPhone'");
        if (sizeof($existed)>0) {
            updateSql("UPDATE customer SET cus_name='$cName', cus_email ='$cEmail', cus_address='$cAddress' WHERE cus_phone = '$cPhone'");
        }else{
            $csql = insertSql("insert into customer values(null,'$cPhone','$cName','$cAddress','$cEmail')");
        }
        
        $data = getSql("select cus_ID from customer where cus_phone = '$cPhone'");
        $cusID = $data[0]['cus_ID'];
        $osql = insertSql("insert into orders values(null,'$cusID',1,'$date','$dVal')");
    }
        
    else
    {
        echo "Thiếu dữ kiện";
        exit();
    }          

    if (isset($_SESSION["cart"])) {
        //print_r($_SESSION["cart"]);
        $bdata = getSql("SELECT * FROM bouquet");                                 
        foreach ($_SESSION["cart"] as $key => $cart) {
                foreach ($bdata as $key2 => $b) {
                    if ($b["b_ID"]==$cart["bid"]) {
                        $sum = 0;
                        $cdata = getSql("SELECT cus_ID from customer where cus_phone = '$cPhone'");
                        $cID = $cdata[0]['cus_ID'];
                        $odata = getSql("SELECT order_ID from orders where cus_ID = '$cID' order by order_ID desc");
                        $ordID = $odata[0]['order_ID'];
                        $odsql = insertSql("insert into order_detail values(null,'$ordID','".$cart["bid"]."','".$cart["quan"]."')");
                        $aprice = $b["b_price"]*$cart["quan"];
                        $sum = $sum + $aprice;
                    }
                }
            } 
        }   

    else
    {
        echo "Thiếu dữ kiện cart";
    }
    echo "<p align='center'>THANH TOÁN THÀNH CÔNG</p>";
    echo "<table id='btable' class='table table-hover table-bordered table-sm text-center' style='width: auto' align='center'>";    
    echo "<tr class='table-info table-shop'>";    
    echo "<td>Tên Khách hàng</td>";                    
    echo "<td>",$cName,"</td>";
    echo "</tr>";
    echo "<tr class='table-info table-shop'>";    
    echo "<td>SĐT khách hàng</td>";                    
    echo "<td>",$cPhone,"</td>";
    echo "</tr>";
    echo "<tr class='table-info table-shop'>";    
    echo "<td>Email Khách hàng</td>";                    
    echo "<td>",$cEmail,"</td>";
    echo "</tr>";
    echo "<tr class='table-info table-shop'>";    
    echo "<td>Địa chỉ Khách hàng</td>";                    
    echo "<td>",$cAddress,"</td>";
    echo "</tr>";
    echo "<tr class='table-info table-shop'>";    
    echo "<td>Tổng số tiền thanh toán</td>";                    
    echo "<td>",$sum,"</td>";
    echo "</tr>";
    echo "</table>";
    unset($_SESSION["cart"]);
?>

            
    