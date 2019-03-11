<?php
    session_start();
    if (!in_array("Q10",$_SESSION["sRight"],true) && !in_array("Q00",$_SESSION["sRight"],true)) 
    {
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
        <h2 class="col-9">Quản lý Khách hàng</h2>
    </div>
    <br>
    <?php
        include '../src/flowerdb.php';
        $data = getSql("SELECT * FROM customer");
        $num = sizeof($data);
        if ($num<=0) 
        {
            echo "Chưa có dữ liệu khách hàng";
        }
        else
        {
            echo "<table id='btable' class='table table-hover table-bordered table-sm text-center'>";
            echo "<tr class='table-info'>
                    <th>Mã KH</th>
                    <th>SĐT KH</th>
                    <th>Tên KH</th>
                    <th>Địa chỉ KH</th>
                    <th>Email KH</th></tr>";
            foreach ($data as $key=> $cus) 
            {
                echo "<tr>";
                echo "<td>",$cus['cus_ID'],"</td>";
                echo "<td>",$cus['cus_phone'],"</td>";
                echo "<td>",$cus['cus_name'],"</td>";
                echo "<td>",$cus['cus_address'],"</td>";
                echo "<td>",$cus['cus_email'],"</td>";
                echo '<td>
                        <button class="btn btn-info btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'customeredit.php?cusid=',$cus["cus_ID"],'\';modalHText=\'Chỉnh sửa\';">
                        Sửa
                        </button>
                    </td>';
            }
            echo "</tr>";   
            echo "</table>";
        }
       
        
    ?>
    <br>

    <!-- Modal chung -->
    <div class="modal fade" id="modal"  ng-controller="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-info">
                    <h4 id="modalHeader" class="modal-title text-light">{{modalHText}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div ng-include="temp.url">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                </div>

            </div>
        </div>
    </div>
</body>

