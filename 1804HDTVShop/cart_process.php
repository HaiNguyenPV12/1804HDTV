<?php
    session_start();
    if (isset($_POST["add"])) {
        if (isset($_POST["bid"]) && isset($_POST["quan"])) {
            // Nếu chưa có session cart thì tạo mới
            if (!isset($_SESSION["cart"])) {
                // Khởi tạo array
                $_SESSION["cart"]=[];
                // Gắn dữ liệu mới vào
                array_push($_SESSION["cart"],array(
                    "bid" => $_POST["bid"],
                    "quan" => $_POST["quan"]
                ));
                echo "ok";
            }else{
            // Nếu có session cart rồi
                // tạo 1 biến để kiểm tra có dữ liệu bid trong đó hay chưa
                $chk = false;
                // bắt đầu tìm trong từng phần tử của array
                foreach ($_SESSION["cart"] as $key => &$cartdata) {
                    // Nếu trùng bid thì cộng dồn quantity vào và cho check = true
                    if ($cartdata["bid"]==$_POST["bid"]) {
                        $chk=true;
                        $cartdata["quan"] += $_POST["quan"];
                        break;
                    }
                }
                // Nếu check == false (nghĩa là chưa có bid này ở trong array)
                if (!$chk) {
                    // Thì đưa dữ liệu mới vào
                    array_push($_SESSION["cart"],array(
                        "bid" => $_POST["bid"],
                        "quan" => $_POST["quan"]
                    ));
                }
                echo "ok";
            }
        }else{
            echo "Thiếu dữ liệu";
        }
        
    }else{
        echo "Thiếu dữ kiện";
    }

?>