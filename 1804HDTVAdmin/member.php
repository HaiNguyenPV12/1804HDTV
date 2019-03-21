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
        <h2 class="col-9">Quản lý Thành viên</h2>
    </div>
    <br>
    <?php
        include '../src/flowerdb.php';
        $data = getSql("SELECT * FROM member,customer where customer.cus_ID = member.cus_ID");
        $num = sizeof($data);
        if ($num<=0) 
        {
            echo "Chưa có dữ liệu khách hàng";
        }
        else
        {
            echo "<table id='btable' class='table table-hover table-bordered table-sm text-center'>";
            echo "<tr class='table-info table-shop'>
                    <th>Mã TV</th>
                    <th>Mã KH</th>
                    <th>Tên TV</th>
                    <th>Email TV</th>
                    <th>SĐT TV</th>
                    <th>Địa chỉ TV</th>
                    <th>Tên đăng nhập</th>
                    <th>MK đăng nhập</th></tr>";
            foreach ($data as $key=> $mem) 
            {
                echo "<tr>";
                echo "<td>",$mem['mem_ID'],"</td>";
                echo "<td>",$mem['cus_ID'],"</td>";
                echo "<td>",$mem['cus_name'],"</td>";
                echo "<td>",$mem['cus_email'],"</td>";
                echo "<td>",$mem['cus_phone'],"</td>";
                echo "<td>",$mem['cus_address'],"</td>";
                echo "<td>",$mem['mem_uID'],"</td>";
                echo "<td>",$mem['mem_uPW'],"</td>";
                echo '<td>
                        <button class="btn btn-info btn-sm text-light btn-shop" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'delete.php?member&&cusid=',$mem["cus_ID"],'\';modalHText=\'Xóa\';">
                        Xóa
                        </button>
                    </td>';
                echo '<td>
                        <button class="btn btn-info btn-sm text-light btn-shop" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'memberedit.php?memid=',$mem["mem_ID"],'\';modalHText=\'Sửa\';">
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
    <div class="modal fade" id="modal"  ng-controller="myModal">s
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-info bg-shop">
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

