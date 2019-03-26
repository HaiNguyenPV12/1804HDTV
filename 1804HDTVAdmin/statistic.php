
<?php
    session_start();
    if (!in_array("Q06",$_SESSION["sRight"],true) && !in_array("Q00",$_SESSION["sRight"],true)) {
        echo "<h2>Bạn không có quyền truy cập vào trang này!<h2>";
        exit;
    }
?>

<style>
img{
    max-width:20vh;
}
</style>
<script src="../Scripts/1804HDTVAdmin/statistic.js"></script>
<body>
    <div class='row'>
        <h2 class="col-9">Xem thống kê doanh thu</h2>        
    </div>
    <br>
    <?php
        include '../src/flowerdb.php';
        $ydata = getSql("select DISTINCT year(orders.order_date) as year from orders");
        foreach ($ydata as $key => $y) {
            $mdata[$y["year"]] = getSql("select distinct month(orders.order_date) as month from orders where year(orders.order_date) ='".$y["year"]."' and orders.order_status=2");
        }
        /*
        foreach ($mdata as $year => $month) {
            $odata[$year][$month]
        }
        */
        //$mdata = "select year(orders.order_date) as year, month(orders.order_date) as month from orders";
        if (isset($_GET["year"])) {
            $year = $_GET["year"];
            if ($year=="") {
                $year="*";
            }else {
                if (!in_array($year,array_column($ydata, 'year'),true)) {
                    $year="*";
                }
            }
        }else{
            $year="*";
        }
        
    ?>
    <br>

    <div class="form-inline">
        <label class="mr-sm-2 col-2">Xem theo:</label>
        <select name="year" id="year">
            <?php
                if ($year=="*") {
                    echo '<option value="*" selected>Tất cả các năm</option>';
                }else{
                    echo '<option value="*">Tất cả các năm</option>';
                }
                foreach ($ydata as $key => $y) {
                    if ($year==$y["year"]) {
                        echo '<option value="'.$y["year"].'" selected>Năm '.$y["year"].'</option>';
                    }else{
                        echo '<option value="'.$y["year"].'">Năm '.$y["year"].'</option>';
                    }
                }
            ?>
        </select>
    </div>
    <br>
    <table id='btable' class='table table-hover table-bordered table-sm text-center'>
    <?php
        echo '<tr class="table-info table-shop">';
        if ($year=="*") {
            echo '<tr class="table-info table-shop">
                    <th>Năm</th>
                    <th>Tổng doanh thu</th>
                </tr>';
            foreach ($ydata as $key => $y) {
                echo '<tr>
                        <td>'.$y["year"].'</td>';
                $data = getSql("SELECT SUM(order_detail.quan * b_price) as sum FROM order_detail, bouquet, orders where orders.order_ID = order_detail.order_ID and order_detail.b_ID = bouquet.b_ID and orders.order_status='2' and year(orders.order_date)='".$y["year"]."'");
                echo '<td>'.number_format($data[0]["sum"],0,",",".").' Đ</td>';
                echo '</tr>';
            }
            $data = getSql("SELECT SUM(order_detail.quan * b_price) as sum FROM order_detail, bouquet, orders where orders.order_ID = order_detail.order_ID and order_detail.b_ID = bouquet.b_ID and orders.order_status='2'");
            echo '<tr class="table-secondary"><td>Tổng</td><td>'.number_format($data[0]["sum"],0,",",".").' Đ</td>';
        }else{
            echo '<tr class="table-info table-shop">
                    <th>Tháng</th>
                    <th>Tổng doanh thu</th>
                </tr>';
            for ($i=1; $i <= 12; $i++) { 
                echo '<tr>
                        <td>'.$i.'</td>';
                $data = getSql("SELECT SUM(order_detail.quan * b_price) as sum FROM order_detail, bouquet, orders where orders.order_ID = order_detail.order_ID and order_detail.b_ID = bouquet.b_ID and orders.order_status='2' and year(orders.order_date)=".$year." and month(orders.order_date)='".$i."'");
                if ($data[0]["sum"]=="") {
                    echo '<td>0 Đ</td>';
                }else{
                    echo '<td>'.number_format($data[0]["sum"],0,",",".").' Đ</td>';
                }
                
                echo '</tr>';
            }
            $data = getSql("SELECT SUM(order_detail.quan * b_price) as sum FROM order_detail, bouquet, orders where orders.order_ID = order_detail.order_ID and order_detail.b_ID = bouquet.b_ID and orders.order_status='2' and year(orders.order_date)='".$year."'");
            echo '<tr class="table-secondary"><td>Tổng cả năm</td><td>'.number_format($data[0]["sum"],0,",",".").' Đ</td>';
        }

      
        ?>
    </table>
    
</body>

