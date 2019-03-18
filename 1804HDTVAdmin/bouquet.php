<!-- Trang quản lý bó hoa -->
<?php
    // Bắt đầu session để lấy dữ liệu từ session ra
    session_start();
    // Kiểm tra xem nếu người đăng nhập hiện tại có quyền quản lý bó hoa (Q01) hoặc quyền admin (Q00) hay không
    if (!in_array("Q01",$_SESSION["sRight"],true) && !in_array("Q00",$_SESSION["sRight"],true)) {
        // Không thì ngăn truy cập bằng cách hiện ra dòng sau
        echo "<h2>Bạn không có quyền truy cập vào trang này!<h2>";
        // Phải có lệnh exit mới dừng việc load những phần bên dưới
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
img {
    /*max-width: 20vh;*/
    width: 100%;
    height: 8rem;
    object-fit: cover;
}
</style>
<script src="../Scripts/1804HDTVAdmin/bouquet.js"></script>
<body>
    <!-- Tựa đề -->
    <div class='row'>
        <h2 class="col-9">Quản lý Bó Hoa</h2>
        <button type="button" class="btn btn-success btn-lg col-2 ml-5 btn-shop" data-toggle="modal"
            data-target="#modal" onclick="showModal('large','Thêm Bó Hoa mới','bouquetadd.php');">
            Thêm Bó Hoa mới
        </button>
    </div>

    <br>
    <div id="main">
    <!-- Đọc dữ liệu từ database để đưa ra bảng -->
    <?php
        
    ?>
    <br>
    </div>

    <!-- Modal chung -->
    <div class="modal fade" id="modal" ng-controller="myModal">
        <div id="modalSetting" class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-info bg-shop">
                    <h4 id="modalHeader" class="modal-title text-light"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div id="modalBody" class="modal-body">
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