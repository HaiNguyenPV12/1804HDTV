
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
<body>
    <div class='row'>
        <h2 class="col-9">Xem thống kê doanh thu</h2>        
    </div>
    <br>
    <?php
        include '../src/flowerdb.php';
        $data = getSql("SELECT * FROM orders");
        $odata = getSql("SELECT order_ID, b_name, b_price,quan FROM order_detail, bouquet where order_detail.b_ID = bouquet.b_ID");
        $num = sizeof($data);
        
    ?>
    <br>

    <div class="form-inline">
        <label class="mr-sm-2 col-2">Xem theo:</label>
        <select name="" id="">
            <option value="">Tháng</option>
            <option value="">Năm</option>
        </select>
    </div>
    <br>
    <table id='btable' class='table table-hover table-bordered table-sm text-center'>
        <tr class='table-info table-shop'>
            <th>Tháng</th>
            <th>Tổng doanh thu</th>
        </tr>
        <tr>
            <td>1</td>
            <td>15.250.000 Đ</td>
        </tr>
        <tr>
            <td>2</td>
            <td>17.250.000 Đ</td>
        </tr>
        <tr>
            <td>3</td>
            <td>16.700.000 Đ</td>
        </tr>
    </table>
    <div class="modal fade" id="modal"  ng-controller="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-info bg-shop">
                    <h4 id="modalHeader" class="modal-title text-light">{{modalHText}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div ng-include="temp.url">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                </div>

            </div>
        </div>
    </div>
</body>

