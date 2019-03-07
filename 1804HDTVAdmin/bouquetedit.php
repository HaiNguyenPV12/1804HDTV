<!-- Trang chỉnh sửa bó hoa -->

<?php
    // Đầu tiên là lấy dữ liệu ra trước để hiển thị trước khi chỉnh sửa
    include '.././src/flowerdb.php';
    if (isset($_GET["bid"])) {
        $id = $_GET["bid"];
        $data = getSql("select * from bouquet where b_ID ='$id'")[0];
    }else{
        echo "Không thấy dữ liệu ID của bó!";
        exit;
    }
?>
<!-- Script tùy chỉnh của trang bouquetedit -->
<script src="./Scripts/custom/bouquetedit.js"></script>
<!-- Form -->
<form id="frmEditBouquet" name="frmEditBouquet" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdEditBouquet">

    <!-- ID bó hoa -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mã bó hoa:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="bid" id="bid" autocomplete="off" value="<?php echo $id?>">
    </div>
    
    <!-- Tên bó hoa -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên bó hoa:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="bname" id="bname" autocomplete="off" value="<?php echo $data['b_name']?>">
    </div>

    <!-- Giá -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Giá:</label>
        <input type="number" required class="form-control mb-2 mr-sm-2 col-8" name="bprice" id="bprice" autocomplete="off" min=0 value="<?php echo $data['b_price']?>">
        VND
    </div>

    <!-- Chi tiết -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Chi tiết:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="bdetail" id="bdetail" autocomplete="off" value="<?php echo $data['b_detail']?>"> 
    </div>

    <!-- Đang bán -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <label class="mr-sm-2 mb-2">
            <input type="checkbox" class="form-check-input" name="bselling" id="bselling" <?php if ($data['b_selling']==1) {echo "checked";}?>><span>Đang bán</span></input>
        </label>
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2" name="cmdEditBouquet" id="cmdEditBouquet">Hoàn tất</button>
        <div class="mr-sm-2"></div>
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