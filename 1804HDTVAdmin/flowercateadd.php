<!-- Trang thêm loại hoa mới -->

<!-- Script tùy chỉnh của trang flowercateadd -->
<script src="../Scripts/1804HDTVAdmin/flowercateadd.js"></script> 

<!-- Form -->
<form id="frmAddFlowerCate" name="frmAddFlowerCate" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdAddFlowerCate">

    <!-- ID loại hoa -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2">Mã loại hoa:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="fcateid" id="fcateid" autocomplete="off" maxlength="2">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <small class="text-danger" id="#validatetext">Hãy nhập ID</small>
    </div>

    <!-- Tên loại hoa -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2">Tên loại hoa:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="fcatename" id="fcatename"
            autocomplete="off">
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" id="cmdAddBouquet" name="cmdAddBouquet">Hoàn tất</button>
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