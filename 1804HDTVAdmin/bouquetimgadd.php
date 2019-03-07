<!-- Trang thêm hình ảnh bó hoa -->

<script src="./Scripts/custom/bouquetimgadd.js"></script>
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

<form id="frmImgAdd" name="frmImgAdd" class="" method="post">
    <input type="hidden" name="cmdImgAdd">
    <input type="hidden" id="bid" value="<?php echo $bid ?>">
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên hình:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="bimgid" id="bimgid" autocomplete="off" >
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2">Đường dẫn:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="bimg" id="bimg" autocomplete="off">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tập tin hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" required class="custom-file-input " name="bimgfile" id="bimgfile" accept=".jpeg,.jpg,.png">
            <label class="custom-file-label" for="bimgfile" id="bimgfiletext">Chọn file</label>
        </div>
        <!--
        <input type="button" class="btn btn-primary mb-2 mr-sm-2 col-2" name="cmdUploadImg" id="cmdUploadImg" value="Tải lên">
        -->
    </div>

    <div class="form-inline">
        <div class="col-2"></div>
        <div id="imgPreview" class="col-9">
        </div>
    </div>

    <!-- tạo khoảng trống cho đẹp form -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"><hr></label>
    </div>
    
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <input type="button" class="btn btn-success mb-2 col-2" name="cmdImgAdd" id="cmdImgAdd" value="Hoàn tất">
    </div>
</form>

<div class="modal" id="result">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body text-center" id="txtResult">
            </div>
        </div>
    </div>
</div>
