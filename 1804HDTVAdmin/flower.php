<!-- Trang quản lý hoa -->
<?php
    session_start();
    if (!in_array("Q02",$_SESSION["sRight"],true) && !in_array("Q00",$_SESSION["sRight"],true)) {
        echo "<h2>Không tìm thấy trang!<h2>";
        exit;
    }
    //xóa file tạm trên server'
    $files = glob('tmp/*'); // get all file names
    if (sizeOf($files)>0) {
        foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
        }
    }
?>
<style>
img{
    max-width:25vh;
}
</style>
<script src="../Scripts/1804HDTVAdmin/flower.js"></script>
<body>
    <div class='row'>
        <h2 class="col-7">Quản lý Hoa</h2>
        <?php
            // Kiểm tra xem user có quyền chỉnh sửa Loại hoa hay không
            if (in_array("Q03",$_SESSION["sRight"],true) || in_array("Q00",$_SESSION["sRight"],true)) {
                // Nếu có thì cho hiện
                echo '<a class="btn btn-info btn-lg col-2 pr-sm-2 pl-sm-2 btn-shop" href="#!flower/category">';
                echo 'Quản lý Loại Hoa';
                echo '</a>';
            }
            ?>
        <button type="button" class="btn btn-success btn-lg col-2 pr-sm-2 pl-sm-2 ml-5 btn-shop" 
                data-toggle="modal" data-target="#modal" 
                onclick="showModal('large','Thêm Hoa mới','floweradd.php');">
                Thêm Hoa mới
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
