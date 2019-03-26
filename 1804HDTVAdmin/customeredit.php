<?php
    // File trung gian kết nối database
    include '.././src/flowerdb.php';
    $data = getSql("SELECT * from customer");
?>

<!-- Form -->
<form id="frmEditStaff" name="frmEditStaff" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdEditStaff">

    <!-- ID  -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mã KH:</label>
        <input type="text" readonly required class="form-control mb-2 mr-sm-2 col-9" name="cusid" id="cusid" autocomplete="off" value="1">
    </div>

    <!-- SĐT -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">SĐT KH:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="cusphone" id="cusphone" autocomplete="off">
    </div>

    <!-- Tên -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên KH:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="cusname" id="cusname" autocomplete="off">
    </div>

    <!-- Adress -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Địa chỉ KH:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="cusaddress" id="cusaddress" autocomplete="off">
    </div>

    <!-- Email -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Email KH:</label>
        <input type="email" required class="form-control mb-2 mr-sm-2 col-9" name="cusemail" id="cusemail" autocomplete="off">
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" id="cmdEditCus" name="cmdEditCus">Hoàn tất</button>
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