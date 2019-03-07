<?php
    include '.././src/flowerdb.php';
    if (isset($_GET["fid"])) {
        $id = $_GET["fid"];
        $data = getSql("select * from flower where f_ID ='$id'")[0];
    }else{
        echo "no";
    }
    $sitedir="./../../1804HDTV/";
?>
<style>
.custom-file-input ~ .custom-file-label::after {
    content: "Tải lên";
}
</style>
<script src="./Scripts/custom/floweredit.js"></script>
<?php
    $existed = getSql("SELECT * FROM bouq_detail where f_ID = '$id'");
    if (sizeof($existed)>0) {
        echo "<b><p class='text-warning'>Lưu ý: Hoa này đã có dữ liệu trong bó hoa. Nếu mã hoa có thay đổi cũng sẽ cập nhật vào bên bó hoa.</p></b>";
    }
?>
<form id="frmEditFlower" name="frmEditFlower" class="" method="post">
    <input type="hidden" name="cmdEditFlower">
    <input type="hidden" id="fid_old" name="fid_old" value="<?php echo $id?>">
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mã hoa:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="fid" id="fid" autocomplete="off" value="<?php echo $id?>">
    </div>
    
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="fname" id="fname" autocomplete="off" value="<?php echo $data['f_name']?>">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Loại hoa:</label>
        <select name="fcate" id="fcate" class="form-control mb-2 mr-sm-2 col-9">
            <?php
            $fcatedata = getSql("select * from flower_cate");
            if (sizeof($fcatedata)>0) {
                foreach ($fcatedata as $key => $cateval) {
                    if ($cateval['f_cate_ID']==$data['f_cate_ID']) {
                        echo '<option value="',$cateval['f_cate_ID'],'" selected>Hoa ',$cateval['f_cate_name'],'</option>';
                    }else{
                        echo '<option value="',$cateval['f_cate_ID'],'">Hoa ',$cateval['f_cate_name'],'</option>';
                    }     
                }
            }
            ?>
        </select>
    </div>
    
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Chi tiết:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="fdetail" id="fdetail" autocomplete="off" value="<?php echo $data['f_detail']?>">
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2">Hình:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="fimg" id="fimg" value="<?php echo $data['f_img']?>">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tập tin hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" class="custom-file-input " name="fimgfile" id="fimgfile" accept=".jpeg,.jpg,.png">
            <label class="custom-file-label" for="fimgfile" id="fimgfiletext">(Hãy để trống nếu không muốn thay đổi)</label>
        </div>
    </div>

    <div class="form-inline">
        <div class="col-2"></div>
        <div id="imgPreview" class="col-9">
            <?php 
                if (file_exists($sitedir.$data['f_img'])) {
                    echo "<img src='".$sitedir.$data['f_img']."' style='max-width:50vh'>";
                }else{
                    echo "<img src='".$sitedir."img/undefined.jpg' style='max-width:50vh'>";
                }           
            ?>
        </div>
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <button type="submit" class="btn btn-primary mb-2 col-2" name="cmdEditFlower">Hoàn tất</button>
        <div class="mr-sm-2"></div>
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