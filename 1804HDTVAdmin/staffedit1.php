<!-- Trang thêm bó hoa mới -->
<?php
    // File trung gian kết nối database
    include '.././src/staffdb.php';
    $data = getSql("SELECT * from staff");
    $rdata = getSql("SELECT * from staff_role");
?>
<!-- Script tùy chỉnh của trang bouquetadd -->
<script src="../Scripts/1804HDTVAdmin/staffedit.js"></script>

<!-- Form -->
<form id="frmEditStaff" name="frmEditStaff" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdEditStaff">
    
    <!-- ID  -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mã NV:</label>
        <input type="text" readonly required class="form-control mb-2 mr-sm-2 col-9" name="staffid" id="staffid" autocomplete="off" value="1">
    </div>
    
    <!-- Tên -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên NV:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="staffname" id="staffname" autocomplete="off">
    </div>

    <!-- Chức vụ -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Chức vụ:</label>
        <select name="staffrole" id="staffrole" class="form-control mb-2 mr-sm-2 col-9">
            <?php
            if (sizeof($rdata)>0) {
                foreach ($rdata as $key => $r) {
                    echo '<option value="',$r['s_role_ID'],'">',$r['s_role_name'],'</option>';
                }
            }
            ?>
        </select>
    </div>
    
    <!-- Email -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Email:</label>
        <input type="email" required class="form-control mb-2 mr-sm-2 col-9" name="staffemail" id="staffemail" autocomplete="off">
    </div>

    <!-- UserName -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên đăng nhập:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="staffuid" id="staffuid" autocomplete="off">
    </div>

    <!-- Password -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mật khẩu:</label>
        <input type="password" required class="form-control mb-2 mr-sm-2 col-9" name="staffpw" id="staffpw" autocomplete="off">
    </div>

    <!-- SĐT -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Số ĐT:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="staffphone" id="staffphone" autocomplete="off">
    </div>

    <!-- Địa Chỉ -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Địa chỉ:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="staffaddress" id="staffaddress" autocomplete="off">
    </div>

    <!-- Đang Làm Việc -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Đang Làm Việc:</label>
        <select name="staffemployed" id="staffemployed" class="form-control mb-2 mr-sm-2 col-9">
            <?php
            // if (sizeof($data)>0) {
            //     foreach ($data as $key => $r) {
            //         echo '<option value="',$r['s_role_ID'],'">',$r['s_role_name'],'</option>';
            //     }
            // }
            ?>
            <option value="0">Không</option>
        </select>
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" id="cmdEditStaff" name="cmdEditStaff">Hoàn tất</button>
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

