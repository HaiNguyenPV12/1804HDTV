<b>Thêm khách hàng mới</b><br>
<a href='index.php'>Back to Tester homepage</a><br>
<?php
    include "../../src/flowerdb.php";
    $numarr = array();
    $cdata = getSql("select cus_ID from customer");
    //echo intval("000");
    if (sizeof($cdata)>0) {
        foreach ($cdata as $key => $value) {
            $numarr[] = substr($value["cus_ID"],2,3);
        }
        $numid = max($numarr) +1;
        if ($numid<10) {
            $sufid = "00$numid";
        }elseif ($numid<100) {
            $sufid= "0$numid";
        }
        $cid= "KH$sufid";
        echo "Số ID của khách mới: $cid<br>";
        insertSql("insert into customer values(null,'000$numid','Khách hàng $numid','Địa chỉ $numid','Email $numid')");
    }else{
        echo "Chưa có dữ liệu khách hàng....Thêm mới...<br>";
        insertSql("insert into customer values(null,'0000','Khách hàng 0','Địa chỉ 0','Email 0')");
        echo "Số ID của khách mới: KH000<br>";
        $cid= "KH000";
    }
?>

