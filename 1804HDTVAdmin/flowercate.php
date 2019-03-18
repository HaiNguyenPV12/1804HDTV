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
<script src="../Scripts/1804HDTVAdmin/flowercate.js"></script>
<body>
    <div class='row'>
        <h2 class="col-9">Quản lý Hoa > Quản lý Loại Hoa <a href="#!flower" class="btn btn-warning btn-md"> Quay về</a></h2>
        <button type="button" 
            class="btn btn-success btn-lg col-2 pr-sm-2 pl-sm-2 ml-5 btn-shop" 
            data-toggle="modal" data-target="#modal" 
            onclick="showModal('large','Thêm Loại Hoa mới','flowercateadd.php');">
            Thêm Loại Hoa mới
        </button>
        
    </div>
    <br>
    <div id="main">
    
    </div>
    <br>
    <!-- Modal chung -->
    <div class="modal fade" id="modal"  ng-controller="myModal">
        <div id="modalSetting" class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-info bg-shop">
                    <h4 id="modalHeader" class="modal-title text-light"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div id="modalBody" class="modal-body">
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
