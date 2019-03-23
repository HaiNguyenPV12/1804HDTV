<?php

if (isset($_POST["cmdLogin"])) 
    {
        if (isset($_POST["id"]) && isset($_POST["pw"]))
        {
            $id = $_POST["id"];
            $pw = $_POST["pw"];
            include '../src/flowerdb.php';
            $get = getSql("SELECT * from member,customer where mem_uID='$id' and mem_uPW='$pw' and customer.cus_ID = member.cus_ID");           
            // Nếu có dữ liệu thì bắt đầu cho trạng thái đăng nhập
            if (sizeof($get)>0) 
            { 
                session_start();
                $_SESSION["member"]= $get[0]["mem_ID"];
                echo "ok";
            }
            else
            {
                echo "Thông tin đăng nhập sai";
            }
        }
        else
        {
            echo "Thieu du kien";
        }
    }
?>