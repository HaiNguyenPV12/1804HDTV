<!-- Trang thêm bó hoa mới -->

<!-- Script tùy chỉnh của trang bouquetadd, trái tim của trang này -->
<script src="../Scripts/1804HDTVAdmin/bouquetadd.js"></script>

<!-- Form -->
<form id="frmAddBouquet" name="frmAddBouquet" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdAddBouquet">

    <!-- Tên bó hoa và ID -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2" for="addbname"><span class="text-right">Tên bó hoa:</span></label>
        <input type="text" readonly class="form-control mb-2 col-2" name="addbid" id="addbid" tabindex="-1">
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-6" name="addbname" id="addbname"
            autocomplete="off" pattern="[\p{L}\s\d]{2,30}" title="2-30 chữ. Không bao gồm kí tự đặc biệt như @#$%^&* ">

    </div>

    <!-- Giá -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2" for="addbprice">Giá:</label>
        <input type="number" required class="form-control mb-2 mr-sm-2 col-8" name="addbprice" id="addbprice"
            autocomplete="off" min=0 step="500" value="0" max="100000000" title="Giá từ 0-10 triệu. Tiền lẻ nhất là 500 đ">
        <label class="mb-2 mr-sm-2 col-1">VND</label>

    </div>

    <!-- Hình -->
    <div class="form-inline">
        <label class="mr-sm-2 mb-2 col-2">Hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" class="custom-file-input " name="addimgfile" id="addimgfile" accept=".jpeg,.jpg,.png"
                multiple="multiple">
            <label class="custom-file-label" for="addimgfile" id="addimgfiletext">Chọn file</label>
        </div>
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 mb-2 col-2"></label>
        <small class="text-muted mr-sm-2 mb-2 col-9">Tối đa 5 hình. Có thể chọn nhiều hình cùng lúc. Bấm vào hình để loại bỏ hình đó.</small>
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 mb-2 col-2"></label>
        <div class="row col-10" id="addimgPreview">

        </div>
    </div>

    <!-- Chi tiết -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2" for="bdetail">Chi tiết:</label>
        <textarea class="form-control mb-2 mr-sm-2 col-9" name="addbdetail" id="addbdetail" cols="30" rows="3" required
            style="resize: none;"></textarea>
    </div>

    <!-- Đang bán -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2 mb-2" for="addbselling">Trạng thái:</label>
        <label class="mr-sm-2 mb-2">
            <input type="checkbox" class="form-check-input" name="addbselling" id="addbselling" checked><span>Đang bán</span>
        </label>
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" id="cmdAddBouquet" name="cmdAddBouquet">Hoàn
            tất</button>
        <div class="mr-sm-2"></div>
        <!-- Nút reset -->
        <button type="button" class="btn mb-2 btn-warning col-2" name="cmdResetAddBouquet" id="cmdResetAddBouquet">Làm
            lại</button>
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