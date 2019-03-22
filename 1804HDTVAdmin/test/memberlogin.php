<?php
session_start();
if (isset($_SESSION["member"])) {
    unset($_SESSION["member"]);
    die ("Đã logout thành viên");
}else{
    $_SESSION["member"] = 1;
    die("Đã login thành viên với memberID = 1");
}


?>