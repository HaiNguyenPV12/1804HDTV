<!-- Trang chỉnh sửa loại hoa -->

<?php
    include "../src/flowerdb.php";
    if (isset($_GET["fcateid"])) {
        $cateid = $_GET["fcateid"];
        $data = getSql("select * from flower_cate where f_cate_ID ='$cateid'")[0];
    }else{
        echo "Không thấy dữ liệu ID của loại hoa!";
        exit;
    }
?>
<!-- Script tùy chỉnh của trang flowercateedit -->
<script src="../Scripts/1804HDTVAdmin/flowercateedit.js"></script> 

<!-- Form -->
<form id="frmEditFlowerCate" name="frmEditFlowerCate" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdEditFlowerCate">

    <!-- ID loại hoa -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2">Mã loại hoa:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="fcateid" id="fcateid" autocomplete="off" maxlength="2" value="<?php echo $data['f_cate_ID'] ?>">
    </div>

    <!-- Tên loại hoa -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2">Tên loại hoa:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="fcatename" id="fcatename" autocomplete="off" value="<?php echo $data['f_cate_name'] ?>">
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" id="cmdEditFlowerCate" name="cmdEditFlowerCate">Hoàn tất</button>
        <div class="mr-sm-2"></div>
        <!-- Nút reset -->
        <button type="reset" class="btn mb-2 btn-warning col-2" name="cmdReset" id="cmdReset">Làm lại</button>
    </div>
</form>


<!-- Modal kết quả -->
<div class="modal" id="result">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body text-center" id="txtResult">
            </div>
        </div>
    </div>
</div>