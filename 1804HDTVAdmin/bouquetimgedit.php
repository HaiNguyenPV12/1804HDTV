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
}
?>

<form id="frmImgEdit" name="frmImgEdit" class="" method="post">
    <input type="hidden" name="cmdImgEdit">
    <input type="hidden" id="bid" value="<?php echo $bid ?>">

    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên hình:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="bimgid" id="bimgid" value="<?php echo $bimgid ?>">
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2">Đường dẫn:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="bimg" id="bimg" value="<?php echo $bimg ?>">
    </div>


    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tập tin hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" required class="custom-file-input " name="bimgfile" id="bimgfile" accept=".jpeg,.jpg,.png">
            <label class="custom-file-label" for="bimgfile" id="bimgfiletext">Chọn file</label>
        </div>
    </div>

    <div class="form-inline">
        <div class="col-2"></div>
        <div id="imgPreview" class="col-9">
            <?php 
                if (file_exists($sitedir.$bimg)) {
                    echo "<img src='".$sitedir.$bimg."' style='max-width:70vh'>";
                }else{
                    echo "<img src='".$sitedir."img/undefined.jpg' style='max-width:70vh'>";
                }           
            ?>
        </div>
    </div>
    
    <!-- tạo khoảng trống cho đẹp form -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"><hr></label>
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <input type="button" class="btn btn-success mb-2 col-2" name="cmdImgEdit" id="cmdImgEdit" value="Hoàn tất">
    </div>
</form>

<div class="modal" id="result">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body text-center" id="txtResult">
            </div>
        </div>
    </div>
</div>
