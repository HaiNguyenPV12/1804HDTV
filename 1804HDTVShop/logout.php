<?php
session_start();
if (isset($_SESSION["member"])) {
    unset($_SESSION["member"]);
    header('location:http://localhost:8080/1804HDTV/1804HDTVShop/');
    die("Đã logout thành viên");
} else {
    $_SESSION["member"] = 1;
    header('location:http://localhost:8080/1804HDTV/1804HDTVShop/');
    die("Đã login thành viên với memberID = 1");
}
