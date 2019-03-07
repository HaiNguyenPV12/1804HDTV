<!-- Trang thêm hoa -->
<script src="./Scripts/custom/floweradd.js"></script>
<style>
.custom-file-input ~ .custom-file-label::after {
    content: "Tải lên";
}
</style>
<?php
include '.././src/flowerdb.php';

?>
<form id="frmAddFlower" name="frmAddFlower" class="" method="post">
    <input type="hidden" name="cmdAddFlower">
    
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mã hoa:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="fid" id="fid" autocomplete="off">
    </div>
    
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="fname" id="fname" autocomplete="off">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Loại hoa:</label>
        <select name="fcate" id="fcate" class="form-control mb-2 mr-sm-2 col-9">
            <?php
            //include '.././src/flowerdb.php';
            $fcatedata = getSql("select * from flower_cate");
            if (sizeof($fcatedata)>0) {
                foreach ($fcatedata as $key => $cateval) {
                    echo '<option value="',$cateval['f_cate_ID'],'">Hoa ',$cateval['f_cate_name'],'</option>';
                }
            }
            ?>
        </select>
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2">Chi tiết:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="fdetail" id="fdetail" autocomplete="off">
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2">Hình:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="fimg" id="fimg" autocomplete="off">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tập tin hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" required class="custom-file-input " name="fimgfile" id="fimgfile" accept=".jpeg,.jpg,.png">
            <label class="custom-file-label" for="fimgfile" id="fimgfiletext">Chọn file</label>
        </div>
    </div>

    <div class="form-inline">
        <div class="col-2"></div>
        <div id="imgPreview" class="col-9">
        </div>
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <button type="submit" class="btn btn-primary mb-2 col-2" name="cmdAddFlower" id="cmdAddFlower">Hoàn tất</button>
        <div class="col-1"></div>
        <button type="button" class="btn mb-2 btn-warning col-2" name="cmdReset" id="cmdReset">Làm lại</button>
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

