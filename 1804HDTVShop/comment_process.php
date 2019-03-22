<?php
    if (isset($_POST["comment"]) && isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["detail"]) && isset($_POST["email"]) && isset($_POST["bid"])) {
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $detail = $_POST["detail"];
        $email = $_POST["email"];
        $bid = $_POST["bid"];
        if ($name!="" && $phone!="" && $detail!= "" && $email!="" && $bid!="") {
            include "../src/flowerdb.php";
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $date = date("Y-m-d H:i:s",time());
            insertSql("INSERT INTO comment values (null,'$bid','$name','$email','$date','$detail','$phone',0)");
            echo "ok";
        }else{
            echo "Chưa đủ dữ liệu!";
        }
    }else{
        echo "Chưa đủ dữ liệu!";
    }
?>