<!-- Trang chỉnh sửa các màu của hoa -->
<?php
    if (isset($_GET["fid"])) {
        $fid = $_GET["fid"];
        include '../src/flowerdb.php';
        $data = getSql("SELECT * FROM v_flower_color");
        $cdata = getSql("SELECT * FROM flower_color");
    }else{
        echo "Không thấy dữ liệu ID của hoa";
        exit;
    }
?>
<link href="../Content/1804HDTVAdmin/flowercolor.css" rel="stylesheet">
<!-- Script tùy chỉnh của trang positionredit -->
<script src="../Scripts/1804HDTVAdmin/flowercolor.js"></script>

<!-- Form -->
<form id="frmFlowerColor" name="frmFlowerColor">
    <!-- Vì dùng kỹ thuật ajax để chuyển dữ liệu qua form xử lý nên tạo cái này để nhận biết -->
    <input type="hidden" name="cmdFlowerColor">
    <input type="hidden" name="fid" value="<?php echo $fid ?>">

    <div class="form-inline d-flex justify-content-center">

        <!-- Tạo danh sách màu đã có-->
        <div id="color_list" name="color_list" class="list-group col-5 d-flex justify-content-begin">
            <label class="mr-sm-2 font-weight-bold">Các màu đang có:(bấm để loại bỏ)</label>
            <?php
                $cnot = array();
                if (sizeof($data)>0) {
                    foreach ($data as $key => $c) {
                        if ($c['f_ID']==$fid) {
                            echo "<button type='button' name='c_item'";
                            echo "class='list-group-item d-flex justify-content-between align-items-center py-2 c-".$c['f_color_ID']."'>";
                            echo $c['f_color_name'];
                            echo "<input name='cname' type='hidden' value='".$c['f_color_name']."'>";
                            echo "<input name='cid' type='hidden' value='".$c['f_color_ID']."'>";
                            echo "<input name='cdata[]' type='hidden' value='".$c['f_color_ID']."'>";
                            echo "</button>";
                            array_push($cnot,$c['f_color_ID']);
                        }
                    }
                }
            ?>
        </div>
        <div class="list-group col-1 d-flex justify-content-center">
        <h1><</h1>
        </div>
        <!-- Tạo danh sách chọn màu để thêm vào -->
        <div id="color_list_not" name="color_list_not" class="list-group col-5 d-flex justify-content-end">
            <label class="mr-sm-2">Bấm để thêm</label>
            <?php
                if (sizeof($cdata)>0) {
                    foreach ($cdata as $key => $c) {
                        if (!in_array($c['f_color_ID'], $cnot)) {
                            echo "<button type='button' name='c_item_not'";
                            echo "class='list-group-item d-flex justify-content-between align-items-center py-2 c-".$c['f_color_ID']."'>";
                            echo $c['f_color_name'];
                            echo "<input name='cinsertid' type='hidden' value='".$c['f_color_ID']."'>";
                            echo "<input name='cinsertname' type='hidden' value='".$c['f_color_name']."'>";
                            echo "</button>";
                        }
                    }
                }
            ?>
        </div>
    </div>

    <!-- tạo khoảng trống cho đẹp form -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"><hr></label>
    </div>

    <!-- Nút hoàn tất -->
    <div class="form-inline">
        <div class="col-1"></div>
        <button type="submit" class="btn btn-primary mb-2 col-2" name="cmdFlowerColor" id="cmdFlowerColor">Lưu</button>
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