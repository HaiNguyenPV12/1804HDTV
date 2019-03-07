<!-- Trang chỉnh sửa hoa có trong bó hoa -->

<?php
    // Đầu tiên là lấy dữ liệu ra trước để hiển thị trước khi chỉnh sửa
    include '../src/flowerdb.php';
    if (isset($_GET["bid"])) {
        $bid = $_GET["bid"];
        // Đây là bảng ghép (bouq_detail, flower) để lấy dữ liệu hoa trong các bó
        $data = getSql("SELECT b_ID, `v_flower_gen`.f_ID, f_name, f_cate_name, quan FROM bouq_detail,v_flower_gen WHERE bouq_detail.f_ID = v_flower_gen.f_ID and b_ID='$bid'");
        // Dữ liệu để lấy ra danh sách hoa
        $fdata = getSql("SELECT * FROM flower");
    }else{
        echo "no";
    }
?>
<!-- Script tùy chỉnh của trang bouquetfedit -->
<script src="../Scripts/1804HDTVAdmin/bouquetfedit.js"></script>
<!-- Form -->
<form id="frmEditFBouquet" name="frmEditFBouquet">
    <!-- Vì dùng kỹ thuật ajax để chuyển dữ liệu qua form xử lý nên tạo cái này để nhận biết -->
    <input type="hidden" name="cmdEditFBouquet">
    <input type="hidden" name="bid" value="<?php echo $bid ?>">

    <!-- Tạo danh sách chọn hoa và nút để thêm vào -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Thêm vào: </label>
        <!-- Danh sách hoa -->
        <select name="finsert" id="finsert" class="form-control mb-2 mr-sm-2 col-5">
            <?php
            // Nếu dữ liệu từ bảng flower có
            if (sizeof($fdata)>0) {
                // thì lấy trong từng dữ liệu đó ra
                foreach ($fdata as $key => $f) {
                    // Id làm value của option, còn tên để hiển thị trong danh sách
                    echo '<option value="',$f['f_ID'],'">',$f['f_name'],'</option>';
                }
            }
            ?>
        </select>
        <!-- Ô nhập số lượng -->
        <input type="number" class="form-control mb-2 mr-sm-2 col-2" name="finsertquan" id="finsertquan" autocomplete="off" min=1 value=1>
        <!-- Nút thêm hoa -->
        <button type="button" class="btn btn-info mb-2 col-2" name="cmdAddFBouquet" id="cmdAddFBouquet">Thêm vào</button>
    </div>

    <!-- Tạo danh sách hoa đã có trong bó -->
    <div id="flower_list" name="flower_list" class="list-group container">
        <?php
            if (sizeof($data)>0) {
                foreach ($data as $key => $fvalue) {
                    echo "<button name='flower_item' class='list-group-item list-group-item-info d-flex justify-content-between align-items-center'>".$fvalue['f_name'];
                    echo "  <span name='fquan' class='badge badge-info badge-pill'>".$fvalue['quan']."</span>";
                    echo "<input name='fdata[]' type='hidden' value='".$fvalue['f_ID'].":".$fvalue['quan']."'>";

                    echo "</button>";
                }
            }else{
                echo "Chưa có dữ liệu hoa trong bó này.";
            }
        ?>
    </div>
    <!-- tạo khoảng trống cho đẹp form -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"><hr></label>
    </div>

    
    <!-- tạo khoảng trống cho đẹp form -->
    <div class="form-inline">
        <label class="mr-sm-2 col-2"><hr></label>
    </div>
    
    <!-- Nút hoàn tất -->
    <div class="form-inline">
        <div class="col-1"></div>
        <button type="submit" class="btn btn-primary mb-2 col-2" name="cmdEditFBouquet" id="cmdEditFBouquet">Lưu</button>
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