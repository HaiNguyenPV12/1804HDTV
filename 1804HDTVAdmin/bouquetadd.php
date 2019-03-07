<!-- Trang thêm bó hoa mới -->

<!-- Script tùy chỉnh của trang bouquetadd, trái tim của trang này -->
<script src="../Scripts/1804HDTVAdmin/bouquetadd.js"></script> 

<!-- Form -->
<form id="frmAddBouquet" name="frmAddBouquet" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdAddBouquet">

    <!-- ID bó hoa -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mã bó hoa:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="bid" id="bid" autocomplete="off">
    </div>

    <!-- Tên bó hoa -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên bó hoa:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="bname" id="bname"
            autocomplete="off">
    </div>

    <!-- Giá -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Giá:</label>
        <input type="number" required class="form-control mb-2 mr-sm-2 col-8" name="bprice" id="bprice"
            autocomplete="off" min=0>
        VND
    </div>

    <!-- Chi tiết -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Chi tiết:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="bdetail" id="bdetail"
            autocomplete="off">
    </div>

    <!-- Đang bán -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <label class="mr-sm-2 mb-2">
            <input type="checkbox" class="form-check-input" name="bselling" id="bselling" checked><span>Đang bán</span>
        </label>
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2" id="cmdAddBouquet" name="cmdAddBouquet">Hoàn tất</button>
        <div class="mr-sm-2"></div>
        <!-- Nút reset -->
        <button type="button" class="btn mb-2 btn-warning col-2" name="cmdResetBouquet" id="cmdResetBouquet">Làm lại</button>
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