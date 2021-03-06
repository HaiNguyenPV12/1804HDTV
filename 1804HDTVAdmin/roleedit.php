<!-- Trang chỉnh sửa chức vụ -->
<?php
    // Đầu tiên là lấy dữ liệu ra trước để hiển thị trước khi chỉnh sửa
    include '../src/staffdb.php';
    if (isset($_GET["roleid"])) {
        $id = $_GET["roleid"];
        $data = getSql("select * from staff_role where s_role_ID ='$id'")[0];
    }else{
        echo "no";
    }
?>
<!-- Script tùy chỉnh của trang bouquetadd -->
<script src="../Scripts/1804HDTVAdmin/roleedit.js"></script>
<?php
    // Kiểm tra xem chức vụ này có ai nắm chưa
    $existed = getSql("SELECT * FROM staff where s_role_ID = '$id'");
    // Có thì cảnh báo
    if (sizeof($existed)>0) {
        echo "<b><p class='text-warning'>Lưu ý: Đã có người giữ chức vụ này. Nếu mã chức vụ có thay đổi cũng sẽ cập nhật vào bên nhân viên.</p></b>";
    }
?>
<!-- Form -->
<form id="frmEditRole" name="frmEditRole" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdEditRole">
    <input type="hidden" name="roleidold" value="<?php echo $id?>">
    <!-- ID  -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mã chức vụ:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="roleid" id="roleid" autocomplete="off" value="<?php echo $id?>">
    </div>
    
    <!-- Tên -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên chức vụ:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="rolename" id="rolename" autocomplete="off" value="<?php echo $data['s_role_name']?>">
    </div>
    
    <!-- Chi tiết -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Chi tiết:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="roledetail" id="roledetail" autocomplete="off" value="<?php echo $data['s_role_detail']?>">
    </div>

    
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" id="cmdEditRole" name="cmdEditRole">Hoàn tất</button>
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

