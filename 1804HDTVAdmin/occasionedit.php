<!-- Trang thêm hoa -->
<!-- Trang này phức tạp ở chỗ thêm cả thông tin hoa lẫn hình -->
<script src="../Scripts/1804HDTVAdmin/floweradd.js"></script>
<style>
.custom-file-input ~ .custom-file-label::after {
    content: "Tải lên";
}
</style>
<?php
    include '../src/flowerdb.php';
?>
<!-- Bắt đầu form add hình -->
<form id="frmAddFlower" name="frmAddFlower" class="" method="post">
    <!-- input để trang xử lý nhận biết -->
    <input type="hidden" name="cmdAddFlower">
    <!-- Mã hoa: tự động -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mã dịp:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="occaid" id="occaid" autocomplete="off">
    </div>
    <!-- tên hoa -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên dịp:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="occaname" id="occaname" autocomplete="off">
    </div>
    <!-- Loại hoa -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Bó hoa có trong dịp:</label>
        <select name="fcate" id="fcate" class="form-control mb-2 mr-sm-2 col-7">
            <?php
            // Lấy dữ liệu loại hoa có từ database
            $bdata = getSql("select * from bouquet");
            if (sizeof($bdata)>0) {
                foreach ($bdata as $key => $b) {
                    echo '<option value="',$b['b_ID'],'">',$b['b_name'],'</option>';
                }
            }
            ?>
        </select>
        <button class="btn btn-shop col-2">Thêm vào</button>
    </div>
    <div class="form-inline">
        <div class="col-2"></div>
        <ul>
            <li>Cảm ơn 1</li>
            <li>Sự lãng mạn</li>
            <li>Bó quý phái</li>
        </ul>
    </div>
    <!-- Đường dẫn hình -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Hình:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="fimg" id="fimg" autocomplete="off">
    </div>
    <!-- Input file hình -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tập tin hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" required class="custom-file-input " name="fimgfile" id="fimgfile" accept=".jpeg,.jpg,.png">
            <label class="custom-file-label" for="fimgfile" id="fimgfiletext">Chọn file</label>
        </div>
    </div>
    
    <!-- Hiện hình mẫu -->
    <div class="form-inline">
        <div class="col-2"></div>
        <div id="imgPreview" class="col-9">
        <img src="../img/B000/B000_PV.jpg" alt="">
        </div>
    </div>
    <!-- Nút submit và reset -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" name="cmdAddFlower" id="cmdAddFlower">Hoàn tất</button>
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

