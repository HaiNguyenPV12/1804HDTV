<?php
session_start();
if (isset($_SESSION["member"])) {
    unset($_SESSION["member"]);
    die("Đã logout thành viên");
    header('location:http://localhost:8080/1804HDTV/1804HDTVShop/');
} else {
    $_SESSION["member"] = 1;
    die("Đã login thành viên với memberID = 1");
    header('location:http://localhost:8080/1804HDTV/1804HDTVShop/');
}
