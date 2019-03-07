<!-- Trang thêm bó hoa mới -->

<!-- Script tùy chỉnh của trang bouquetadd -->
<script src="../Scripts/1804HDTVAdmin/roleadd.js"></script>

<!-- Form -->
<form id="frmAddRole" name="frmAddRole" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdAddRole">
    
    <!-- ID  -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mã chức vụ:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="roleid" id="roleid" autocomplete="off">
    </div>
    
    <!-- Tên -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên chức vụ:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="rolename" id="rolename" autocomplete="off">
    </div>
    
    
    <!-- Chi tiết -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Chi tiết:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="roledetail" id="roledetail" autocomplete="off">
    </div>

    
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2" id="cmdAddRole" name="cmdAddRole">Hoàn tất</button>
        <div class="col-1"></div>
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

