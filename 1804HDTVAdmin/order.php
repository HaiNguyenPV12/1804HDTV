
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
        <h2 class="col-9">Quản lý Order</h2>        
    </div>
    <br>
    <?php
        include '../src/flowerdb.php';
        $data = getSql("SELECT * FROM orders");
        $odata = getSql("SELECT order_ID, b_name,quan FROM order_detail, bouquet where order_detail.b_ID = bouquet.b_ID");
        $num = sizeof($data);
        if ($num<=0) 
        {
            echo "Chưa có dữ liệu hóa đơn";
        }
        else
        {
            echo "<table id='btable' class='table table-hover table-bordered table-sm text-center'>";
            echo "<tr class='table-info table-shop'>
                    <th>Mã Order</th>
                    <th>Mã KH</th>
                    <th>Trạng thái Order</th>
                    <th>Chi tiết Order</th>
                    <th>Ngày nhận Order</th>
                    <th>Ngày giao hàng</th>
                    </tr>";
            foreach ($data as $key=> $o)
            {
                echo "<tr>";
                echo "<td>",$o['order_ID'],"</td>";
                echo "<td>",$o['cus_ID'],"</td>";
                echo "<td>";
                if ($o['order_status']==0) {
                    echo "Đã hủy";
                }elseif ($o['order_status']==1) {
                    echo "Đã nhận (chờ giao)";
                }elseif ($o['order_status']==2) {
                    echo "Đã giao";
                }
                echo "</td>";
                echo "<td>";
                foreach ($odata as $key => $od) {
                    if ($od["order_ID"]==$o["order_ID"]) {
                        echo $od["quan"]." x  \"".$od["b_name"]."\"<br>";
                    }
                }
                echo "</td>";
                echo "<td>",$o['order_date'],"</td>";
                echo "<td>",$o['delivery_date'],"</td>";
                echo '<td>
                        <a class="btn btn-info btn-sm text-light btn-shop" href="#!order/delivered/'.$o['order_ID'].'">
                        Đã giao
                        </a>
                        </td>';
                echo '<td>
                        <a class="btn btn-danger btn-sm text-light" href="#!order/aborted/'.$o['order_ID'].'">
                        Hủy
                        </a>
                        </td>';
            }
            echo "</tr>";   
            echo "</table>";
        }
       
        
    ?>
    <br>
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

