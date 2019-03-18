<!-- Trang chỉnh sửa bó hoa -->

<?php
    // Đầu tiên là lấy dữ liệu ra trước để hiển thị trước khi chỉnh sửa
    include '../src/flowerdb.php';
    if (isset($_GET["bid"])) {
        $id = $_GET["bid"];
        $data = getSql("select * from bouquet where b_ID ='$id'")[0];
        $imgdata = getSql("select * from bouq_img where b_ID='$id'");
    }else{
        echo "Không thấy dữ liệu ID của bó!";
        exit;
    }
?>
<!-- Script tùy chỉnh của trang bouquetedit -->
<script src="../Scripts/1804HDTVAdmin/bouquetedit.js"></script>
<!-- Form -->
<form id="frmEditBouquet" name="frmEditBouquet" class="" method="post">
    <!-- Vì submit dùng kỹ thuật ajax nên tạo thêm cái này để bên trang xử lý nhận biết -->
    <input type="hidden" name="cmdEditBouquet">

    <!-- Tên bó hoa và ID -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2" for="editbname">Tên bó hoa:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-2" name="editbid" id="editbid" value="<?php echo $id?>"
            tabindex="-1">
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-6" name="editbname" id="editbname"
            autocomplete="off" value="<?php echo $data['b_name']?>">
    </div>

    <!-- Giá -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2" for="editbprice">Giá:</label>
        <input type="number" required class="form-control mb-2 mr-sm-2 col-8" name="editbprice" id="editbprice"
            autocomplete="off" min=0 value="<?php echo $data['b_price']?>">
        VND
    </div>

    <!-- Hình -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 mb-2 col-2">Hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" class="custom-file-input " name="editimgfile" id="editimgfile" accept=".jpeg,.jpg,.png"
                multiple="multiple">
            <label class="custom-file-label" for="editimgfile" id="imgfiletext">Chọn file</label>
        </div>
    </div>
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 mb-2 col-2"></label>
        <small class="text-muted mr-sm-2 mb-2 col-9">Tối đa 5 hình. Có thể chọn nhiều hình cùng lúc. Bấm vào hình để
            loại bỏ hình đó.</small>
    </div>

    <div class="form-inline">
        <label class="mb-2 mr-sm-2 mb-2 col-2"></label>
        <div class="row col-10" id="editimgPreview">
            <?php
                $site="../";
                for ($i=0; $i < sizeof($imgdata); $i++) { 
                    $url = $site.$imgdata[$i]["b_img"];
                    if (!file_exists($url)) {
                        $url = $site."img/undefined.jpg";
                    }
                    $imgext = strtolower(pathinfo($imgdata[$i]["b_img"],PATHINFO_EXTENSION));
                    $filename = $imgdata[$i]["b_img_ID"].".".$imgext;
                    $num = intval(substr($imgdata[$i]["b_img_ID"],-1,2));
                    echo '<div class="mb-2 col-2" name="imgold[]">';
                    echo '<div class="card border-primary border-shop">';
                    echo '<img class="card-img-top custom" src="'.$url.'" style="width: 100%;height: 5rem;object-fit: cover;">';
                    echo '<small class="card-title text-center">'.$filename.'</small>';
                    echo '<input type="hidden" id="imgnum" value="'.$num.'">';
                    echo '<input type="hidden" id="imgid" value="'.$imgdata[$i]["b_img_ID"].':'.$imgdata[$i]["b_img"].'">';
                    echo '</div></div>';
                }
            ?>
        </div>
    </div>

    <!-- Chi tiết -->
    <div class="form-inline">
        <label class="mb-2 mr-sm-2 col-2">Chi tiết:</label>
        <textarea class="form-control mb-2 mr-sm-2 col-9" name="editbdetail" id="editbdetail" cols="30" rows="3" required
        style="resize: none;"><?php echo $data['b_detail']?></textarea>
    </div>

    <!-- Đang bán -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <label class="mr-sm-2 mb-2">
            <input type="checkbox" class="form-check-input" name="editbselling" id="editbselling"
                <?php if ($data['b_selling']==1) {echo "checked";}?>><span>Đang bán</span></input>
        </label>
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <!-- Nút hoàn tất -->
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" name="cmdEditBouquet" id="cmdEditBouquet">Hoàn
            tất</button>
        <div class="mr-sm-2"></div>
        <!-- Nút reset -->
        <button type="reset" class="btn mb-2 btn-warning col-2" name="cmdResetEditBouquet" id="cmdResetEditBouquet">Làm lại</button>
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