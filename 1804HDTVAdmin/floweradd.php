<!-- Trang thêm hoa -->
<!-- Trang này phức tạp ở chỗ thêm cả thông tin hoa lẫn hình -->
<script src="../Scripts/1804HDTVAdmin/floweradd.js"></script>
<style>
.custom-file-input ~ .custom-file-label::after {
    content: "Tải lên";
}
</style>
<?php
    include '../src/flowerdb.php';
?>
<!-- Bắt đầu form add hình -->
<form id="frmAddFlower" name="frmAddFlower" class="" method="post">
    <!-- input để trang xử lý nhận biết -->
    <input type="hidden" name="cmdAddFlower">
    <!-- Mã hoa: tự động -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="addfid">Mã hoa:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="addfid" id="addfid" autocomplete="off">
    </div>
    <!-- tên hoa -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="addfname">Tên:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="addfname" id="addfname" autocomplete="off">
    </div>
    <!-- Loại hoa -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="addfcate">Loại hoa:</label>
        <select name="addfcate" id="addfcate" class="form-control mb-2 mr-sm-2 col-9">
            <?php
            // Lấy dữ liệu loại hoa có từ database
            $fcatedata = getSql("select * from flower_cate");
            if (sizeof($fcatedata)>0) {
                foreach ($fcatedata as $key => $cateval) {
                    echo '<option value="',$cateval['f_cate_ID'],'">Hoa ',$cateval['f_cate_name'],'</option>';
                }
            }
            ?>
        </select>
    </div>
    <!-- Chi tiết -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="addfdetail">Chi tiết:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="addfdetail" id="addfdetail" autocomplete="off">
    </div>
    <!-- Đường dẫn hình -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Hình:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="addfimg" id="addfimg" autocomplete="off">
    </div>
    <!-- Input file hình -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="addfimgfile">Tập tin hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" required class="custom-file-input " name="addfimgfile" id="addfimgfile" accept=".jpeg,.jpg,.png">
            <label class="custom-file-label" for="addfimgfile" id="addfimgfiletext">Chọn file</label>
        </div>
    </div>
    
    <!-- Hiện hình mẫu -->
    <div class="form-inline">
        <div class="col-3"></div>
        <div id="addimgPreview" class="col-9">
        </div>
    </div>
    <br>
    <!-- Nút submit và reset -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" name="cmdAddFlower" id="cmdAddFlower">Hoàn tất</button>
        <div class="col-1"></div>
        <button type="button" class="btn mb-2 btn-warning col-2" name="cmdAddFlowerReset" id="cmdAddFlowerReset">Làm lại</button>
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

