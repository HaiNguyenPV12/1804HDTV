<?php
$host = 'localhost';
$user = 'root';
$pw = '';
$db = 'staffdb';
$cn = new mysql_connect($host, $user, $pw, $db);

if (mysql_connect_error()) {
    echo ("Lỗi kết nối: "+$cn->error);
    exit;
}

// Chuyển encode để đọc và hiển thị được tiếng Việt (phải giống collation với database), lưu ý uft8bm4 mới là định dạng hoàn chỉnh
$cn->query("set character_set_client='utf8mb4'");
$cn->query("set character_set_results='utf8mb4'");
$cn->query("set collation_connection='utf8mb4_unicode_ci'");
