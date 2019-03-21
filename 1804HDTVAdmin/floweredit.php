<?php
    include '../src/flowerdb.php';
    if (isset($_GET["fid"])) {
        $id = $_GET["fid"];
        $data = getSql("select * from flower where f_ID ='$id'")[0];
    }else{
        echo "no";
    }
    $sitedir="../";
?>
<style>
.custom-file-input ~ .custom-file-label::after {
    content: "Tải lên";
}
</style>
<script src="../Scripts/1804HDTVAdmin/floweredit.js"></script>
<?php
    // Kiểm tra xem hoa này đã có trong bó nào chưa
    $existed = getSql("SELECT * FROM bouq_detail where f_ID = '$id'");
    // Có thì cảnh báo
    if (sizeof($existed)>0) {
        echo "<b><p class='text-warning'>Lưu ý: Hoa này đã có dữ liệu trong bó hoa. Nếu mã hoa có thay đổi cũng sẽ cập nhật vào bên bó hoa.</p></b>";
    }
?>
<form id="frmEditFlower" name="frmEditFlower" method="post">
    <input type="hidden" name="cmdEditFlower">
    <input type="hidden" id="editfid_old" name="editfid_old" value="<?php echo $id?>">
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="editfid">Mã hoa:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="editfid" id="editfid" autocomplete="off" value="<?php echo $id?>">
    </div>
    
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="editfname">Tên:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="editfname" id="editfname" autocomplete="off" value="<?php echo $data['f_name']?>">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="editfcate">Loại hoa:</label>
        <select name="editfcate" id="editfcate" class="form-control mb-2 mr-sm-2 col-9">
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
        <label class="mr-sm-2 col-2" for="editfdetail">Chi tiết:</label>
        <textarea class="form-control mb-2 mr-sm-2 col-9" name="editfdetail" id="editfdetail" cols="30" rows="3" required
            style="resize: none;"><?php echo $data['f_detail']?></textarea>
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2">Hình:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="editfimg" id="editfimg" value="<?php echo $data['f_img']?>">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2" for="editfimgfile">Tập tin hình:</label>
        <div class="custom-file mb-2 mr-sm-2 col-9">
            <input type="file" class="custom-file-input " name="editfimgfile" id="editfimgfile" accept=".jpeg,.jpg,.png">
            <label class="custom-file-label" for="editfimgfile" id="editfimgfiletext">(Hãy để trống nếu không muốn thay đổi)</label>
        </div>
    </div>

    <div class="form-inline">
        <div class="col-3"></div>
        <div id="editimgPreview" class="col-9">
            <?php 
                if (file_exists($sitedir.$data['f_img'])) {
                    echo "<img src='".$sitedir.$data['f_img']."' style='max-width:50vh'>";
                }else{
                    echo "<img src='".$sitedir."img/undefined.jpg' style='max-width:50vh'>";
                }           
            ?>
        </div>
        <?php
        echo "<input type='hidden' name='editfimgold' id='editfimgold' value='".$data['f_img']."'>";
        ?>
    </div>
    <br>
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" name="cmdEditFlower">Hoàn tất</button>
        <div class="mr-sm-2"></div>
        <input type="button" class="btn mb-2 btn-warning col-2" name="cmdEditFlowerReset" id="cmdEditFlowerReset" value="Làm lại">
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