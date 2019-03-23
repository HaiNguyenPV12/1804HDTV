<!-- Trang chỉnh sửa loại hoa -->

<?php
    include "../src/flowerdb.php";
    if (isset($_GET["fcateid"])) {
        $cateid = $_GET["fcateid"];
        $data = getSql("select * from flower_cate where f_cate_ID ='$cateid'")[0];
    }else{
        echo "Không thấy dữ liệu ID của loại hoa!";
        exit;
    }
    $sitedir = "../";
    $imgext = strtolower(pathinfo($data["f_cate_img"],PATHINFO_EXTENSION));
?>
<!-- Script tùy chỉnh của trang flowercateedit -->
<script src="../Scripts/1804HDTVAdmin/flowercateedit.js"></script> 

<!-- Form -->
<form id="frmEditFlowerCate" name="frmEditFlowerCate" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdEditFlowerCate">
    <input type="hidden" name="editoldfcateid" value="<?php echo $data["f_cate_ID"] ?>">

    <!-- ID loại hoa -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2" for="editfcateid">Mã loại hoa:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="editfcateid" id="editfcateid" autocomplete="off" maxlength="3" pattern="\w{2,3}"" value="<?php echo $data['f_cate_ID'] ?>">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2 mb-2"></label>
        <small class="text-danger" id="validatetext"></small>
    </div>
    <!-- Tên loại hoa -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2">Tên loại hoa:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="editfcatename" id="editfcatename" autocomplete="off" value="<?php echo $data['f_cate_name'] ?>">
    </div>

    <!-- Chi tiết -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="editfcatedetail">Chi tiết:</label>
        <textarea class="form-control mb-2 mr-sm-2 col-9" name="editfcatedetail" id="editfcatedetail" cols="30" rows="3" required
            style="resize: none;"><?php echo $data["f_cate_detail"] ?></textarea>
    </div>

    <!-- Input file hình -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="editfcateimgfile">Tập tin hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" class="custom-file-input " name="editfcateimgfile" id="editfcateimgfile" accept=".jpeg,.jpg,.png">
            <label class="custom-file-label" for="editfcateimgfile" id="editfcateimgfiletext">Chọn file</label>
        </div>
    </div>

    <!-- Hiện hình mẫu -->
    <div class="form-inline">
        <div class="col-2"></div>
        <div id="editimgPreview" class="col-9">
            <?php
                if (file_exists($sitedir.$data["f_cate_img"])) {
                    echo '<div class="mb-2 col-12" id="imgold">
                        <div class="card border-primary border-shop">
                            <img class="card-img-top custom" src="'.$sitedir.$data["f_cate_img"].'" 
                                style="width: 100%;height: 15rem;object-fit: cover;">
                            <small id="imgfilename" class="card-title text-center">'.$data["f_cate_ID"].'.'.$imgext.'</small>
                            <input type="hidden" id="editfcateimg" name="editfcateimg" value="'.$data["f_cate_img"].'"> 
                            <input type="hidden" id="imgext" value="'.$imgext.'"> 
                        </div>
                    </div>';
                }
            ?>
        </div>
    </div>
    <br>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" id="cmdEditFlowerCate" name="cmdEditFlowerCate">Hoàn tất</button>
        <div class="mr-sm-2"></div>
        <!-- Nút reset -->
        <button type="button" class="btn mb-2 btn-warning col-2" name="cmdResetEditFlowerCate" id="cmdResetEditFlowerCate">Làm lại</button>
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