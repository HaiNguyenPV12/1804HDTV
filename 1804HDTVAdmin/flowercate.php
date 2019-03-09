<!-- Trang quản lý loại hoa -->
<?php
session_start();
if (!in_array("Q03",$_SESSION["sRight"],true) && !in_array("Q00",$_SESSION["sRight"],true)) {
    echo "<h2>Không tìm thấy trang!<h2>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
    <div class='row'>
        <h2 class="col-9">Quản lý Hoa > Quản lý Loại Hoa <a href="#!flower" class="btn btn-warning btn-md"> Quay về</a></h2>
        <button type="button" class="btn btn-success btn-lg col-2 pr-sm-2 pl-sm-2 ml-5 btn-shop" data-toggle="modal" data-target="#modal" ng-click="temp.url = 'flowercateadd.php';modalHText='Thêm mới';">
            Thêm mới
        </button>
        
    </div>
    <br>
    <?php
        // Đầu tiên là lấy dữ liệu của loại hoa và dữ liệu của hoa (để kiểm tra xem loại hoa đó có chứa trong danh sách hoa chưa)
        include '../src/flowerdb.php';
        $fcdata = getSql("SELECT * FROM flower_cate");
        $fdata = getSql("SELECT f_ID, f_cate_ID FROM flower");
        $fd = array_column($fdata, "f_cate_ID");
        $num = sizeof($fcdata);
        
        if ($num<=0) {
            echo "Chưa có dữ liệu loại hoa";
        }else{
            echo "<table id='ftable' class='table table-hover table-bordered table-sm text-center'>";
            echo "<tr class='table-info table-shop'><th>Mã loại hoa</th><th>Tên loại hoa</th></tr>";
            foreach ($fcdata as $key=> $fc) {
                //-----------------------------------------------------------------------------
                echo "<tr>";

                //-----------------------------------------------------------------------------
                //ID
                echo "<td>",$fc['f_cate_ID'],"</td>";

                //-----------------------------------------------------------------------------
                //Tên loại hoa
                echo "<td>",$fc['f_cate_name'],"</td>";

                //-----------------------------------------------------------------------------
                //Chức năng
                echo '<td><button class="btn btn-info btn-sm text-light btn-shop" data-toggle="modal" data-target="#modal" ng-click="temp.url=\'\'; temp.url = \'flowercateedit.php?fcateid=',$fc["f_cate_ID"],'\';modalHText=\'Chỉnh sửa\';">Sửa</button></td>';
                if (!in_array($fc['f_cate_ID'],$fd,true)) {
                    echo '<td><button class="btn btn-danger btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'delete.php?flowercate&&fcateid=',$fc["f_cate_ID"],'&&fcatename=',$fc["f_cate_name"],'\';modalHText=\'Xóa ',$fc["f_cate_ID"],'\';">Xóa</button></td>';
                }else{
                    echo '<td><button class="btn btn-secondary btn-sm text-light">Xóa</button></td>';
                }
                
                
                //-----------------------------------------------------------------------------
                echo "</tr>";   
            }
            echo "</table>";
        }
    ?>

    <!-- Modal chung -->
    <div class="modal fade" id="modal"  ng-controller="myModal">
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
</html>
