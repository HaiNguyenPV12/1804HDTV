<!-- Trang thêm loại hoa mới -->

<!-- Script tùy chỉnh của trang flowercateadd -->
<script src="../Scripts/1804HDTVAdmin/flowercateadd.js"></script> 
<style>
.custom-file-input ~ .custom-file-label::after {
    content: "Tải lên";
}
</style>
<!-- Form -->
<form id="frmAddFlowerCate" name="frmAddFlowerCate" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdAddFlowerCate">

    <!-- ID loại hoa -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2" for="addfcateid">Mã loại hoa:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="addfcateid" id="addfcateid" autocomplete="off" 
        maxlength="3" pattern="\w{2,3}" title="Chỉ gồm 2-3 kí tự, không được trùng với mã đã có">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <small class="text-danger" id="validatetext"></small>
    </div>

    <!-- Tên loại hoa -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2" for="addfcatename">Tên loại hoa:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="addfcatename" id="addfcatename"
            autocomplete="off" pattern="[\p{L}\s\d]{2,40}" title="2-40 chữ. Không bao gồm kí tự đặc biệt như @#$%^&* ">
    </div>

    <!-- Chi tiết -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="addfcatedetail">Chi tiết:</label>
        <textarea class="form-control mb-2 mr-sm-2 col-9" name="addfcatedetail" id="addfcatedetail" cols="30" rows="3" required
            style="resize: none;"></textarea>
    </div>

    <!-- Input file hình -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="addfcateimgfile">Tập tin hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" required class="custom-file-input " name="addfcateimgfile" id="addfcateimgfile" accept=".jpeg,.jpg,.png">
            <label class="custom-file-label" for="addfcateimgfile" id="addfcateimgfiletext">Chọn file</label>
        </div>
    </div>

    <!-- Hiện hình mẫu -->
    <div class="form-inline">
        <div class="col-2"></div>
        <div id="addimgPreview" class="col-9">
        </div>
    </div>
    <br>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" id="cmdAddFlowerCate" name="cmdAddFlowerCate">Hoàn tất</button>
        <div class="mr-sm-2"></div>
        <!-- Nút reset -->
        <button type="button" class="btn mb-2 btn-warning col-2" name="cmdResetAddFlowerCate" id="cmdResetAddFlowerCate">Làm lại</button>
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