<!-- Trang chỉnh sửa hình ảnh bó hoa -->

<script src="../Scripts/1804HDTVAdmin/bouquetimgedit.js"></script>
<?php
if (isset($_GET["bimgid"])) {
    $bimgid= $_GET["bimgid"];
    include '../src/flowerdb.php';
    $imgdata = (getSql("SELECT * from bouq_img where b_img_ID='$bimgid'"))[0];
    $bid =$imgdata['b_ID'];
    $bimg=$imgdata['b_img'];
    $sitedir="../"; // http://localhost:8080/1804HDTV
    $imgext = strtolower(pathinfo($bimg,PATHINFO_EXTENSION));
    $filename= $bimgid.".".$imgext;
}
?>
<!-- Form sửa hình -->
<form id="frmImgEdit" name="frmImgEdit" class="" method="post">
    <!-- Dùng kỹ thuật ajax nên phải thêm cái này để nhận biết bên trang xử lý -->
    <input type="hidden" name="cmdBouquetImgEdit">
    <input type="hidden" name="bid" id="bid" value="<?php echo $bid ?>">
    <input type="hidden" id="imgext" value="<?php echo $imgext ?>">
    <!-- Tên hình: tự động -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên hình:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="bimgid" id="bimgid" value="<?php echo $bimgid ?>">
    </div>
    <!-- Đường dẫn: tự động -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Đường dẫn:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="bimg" id="bimg" value="<?php echo $bimg ?>">
    </div>
    <!-- Tập tin hình -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tập tin hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" class="custom-file-input " name="bimgfile" id="bimgfile" accept=".jpeg,.jpg,.png">
            <label class="custom-file-label" for="bimgfile" id="bimgfiletext"><?php echo $filename ?></label>
        </div>
    </div>

    <!-- Chỗ để hiện hình mãu -->
    <div class="form-inline">
        <div class="col-3"></div>
        <div id="imgPreview" class="row col-8">
            <?php 
                $url =$sitedir.$bimg;
                if (!file_exists($url)) {
                    $url = $sitedir."img/undefined.jpg";
                }
                echo '<div class="mb-2 col-10" name="imgold">';
                echo '<div class="card border-primary border-shop">';
                echo '<img class="card-img-top custom" src="'.$url.'" style="width: 100%;height: 15rem;object-fit: cover;">';
                echo '<small class="card-title text-center">'.$filename.'</small>';
                echo '<input type="hidden" id="imgid" value="'.$bimgid.':'.$bimg.'">';
                echo '</div></div>';
            ?>
        </div>
    </div>
    
    <!-- tạo khoảng trống cho đẹp form -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"><hr></label>
    </div>
    
    <!-- nút để submit -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <input type="submit" class="btn btn-success mb-2 col-2 btn-shop" name="cmdImgEdit" id="cmdImgEdit" value="Hoàn tất">
    </div>
</form>

<!-- Modal hiện các thông báo -->
<div class="modal" id="result">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body text-center" id="txtResult">
            </div>
        </div>
    </div>
</div>
