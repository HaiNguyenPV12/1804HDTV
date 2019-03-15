<!-- Trang thêm hình ảnh bó hoa -->

<!-- Script tùy chỉnh của trang thêm hình bó hoa -->
<script src="../Scripts/1804HDTVAdmin/bouquetimgadd.js"></script>
<style>
.custom-file-input ~ .custom-file-label::after {
    content: "Tải lên";
}
</style>

<?php
if (isset($_GET["bid"])) {
    $bid= $_GET["bid"];
}
?>
<!-- Form thêm hình -->
<form id="frmImgAdd" name="frmImgAdd" class="" method="post">
    <!-- Dùng kỹ thuật ajax nên phải thêm cái này để nhận biết bên trang xử lý -->
    <input type="hidden" name="cmdBouquetImgAdd">
    <input type="hidden" name="bid" id="bid" value="<?php echo $bid ?>">
    <!-- Tên hình: tự động -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên hình:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="bimgid" id="bimgid" autocomplete="off" >
    </div>
    <!-- Đường dẫn: tự động -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Đường dẫn:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="bimg" id="bimg" autocomplete="off">
    </div>
    <!-- Tập tin hình -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tập tin hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" required class="custom-file-input " name="bimgfile" id="bimgfile" accept=".jpeg,.jpg,.png">
            <label class="custom-file-label" for="bimgfile" id="bimgfiletext">Chọn file</label>
        </div>
    </div>

    <!-- Chỗ để hiện hình mãu -->
    <div class="form-inline">
        <div class="col-3"></div>
        <div id="imgPreview" class="row col-8">
        </div>
    </div>

    <!-- tạo khoảng trống cho đẹp form -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"><hr></label>
    </div>
    
    <!-- nút để submit -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <input type="submit" class="btn btn-success mb-2 col-2 btn-shop" name="cmdImgAdd" id="cmdImgAdd" value="Hoàn tất">
    </div>
</form>

<!-- Modal hiện các thông báo -->
<div class="modal" id="result">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body text-center" id="txtResult">
            </div>
        </div>
    </div>
</div>
