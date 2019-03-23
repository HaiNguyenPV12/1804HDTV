<?php
session_start();
if (isset($_SESSION["member"])) {
    unset($_SESSION["member"]);
    header('location:index');
    die("Đã logout thành viên");
} else {
    $_SESSION["member"] = 1;
    header('location:index');
    die("Đã login thành viên với memberID = 1");
}
