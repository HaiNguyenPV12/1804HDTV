<head>
    <meta charset="utf-8">
    <title>Trang Tester</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../Content/bootstrap.min.css" rel="stylesheet">
</head>

<style>
a:visited{
    color: blue;
}
body{
    font-size: 20px;
}
</style>

<html>
    <h1>Dành cho Tester</h1>
    <hr>
    <h3>Giả lập</h3>
    <ul>
        <li><a href="addcustomer.php">Thêm khách hàng mới</a></li>
        <li><a href="addorder.php">Tạo hóa đơn</a></li>
        <li><a href="cart.php">Xem giỏ hàng</a></li>
    </ul>

    <?php
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $timezone = date_default_timezone_get();
    $date = date("Y-m-d",time());

    $fdate = preg_split("/-/",$date);
    echo "Ngày (chưa format): " . $date;
    echo "<br>Ngày (đã format): Ngày $fdate[2] tháng $fdate[1] năm $fdate[0]";
    
    ?>
</html>