<?php
session_start();
if (!in_array("Q03",$_SESSION["sRight"],true) && !in_array("Q00",$_SESSION["sRight"],true)) {
    echo "<h2>Không tìm thấy trang!<h2>";
    exit;
}
?>
