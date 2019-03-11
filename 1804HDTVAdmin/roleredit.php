<!-- Trang chỉnh sửa các quyền của chức vụ -->

<?php
    // Đầu tiên
    include '../src/staffdb.php';
    if (isset($_GET["roleid"])) {
        $roleid = $_GET["roleid"];
        $data = getSql("SELECT s_role_ID, rights.right_ID, right_name FROM rights, right_detail where rights.right_ID = right_detail.right_ID and s_role_ID='$roleid'");
        $rdata = getSql("SELECT * from rights order by right_ID");
    }else{
        echo "Không thấy dữ liệu ID";
        exit;
    }
?>
<!-- Script tùy chỉnh của trang positionredit -->
<script src="../Scripts/1804HDTVAdmin/roleredit.js"></script>
<!-- Form -->
<form id="frmEditRoleR" name="frmEditRoleR">
    <!-- Vì dùng kỹ thuật ajax để chuyển dữ liệu qua form xử lý nên tạo cái này để nhận biết -->
    <input type="hidden" name="cmdEditRoleR">
    <input type="hidden" name="roleid" value="<?php echo $roleid ?>">

    <div class="form-inline d-flex justify-content-center">

        <!-- Tạo danh sách quyền đã có-->
        <div id="right_list" name="right_list" class="list-group col-5 d-flex justify-content-begin">
            <label class="mr-sm-2 font-weight-bold">Các quyền đang có:(bấm để loại bỏ)</label>
            <?php
                $rnot = array();
                if (sizeof($data)>0) {
                    foreach ($data as $key => $rvalue) {
                        echo "<button type='button' name='r_item' class='list-group-item list-group-item-info d-flex justify-content-between align-items-center py-2 list-group-item-shop'>".$rvalue['right_name'];
                        echo "<input name='rname' type='hidden' value='".$rvalue['right_name']."'>";
                        echo "<input name='rid' type='hidden' value='".$rvalue['right_ID']."'>";
                        echo "<input name='rdata[]' type='hidden' value='".$rvalue['right_ID']."'>";
                        echo "</button>";
                        array_push($rnot,$rvalue['right_ID']);
                    }
                }
            ?>
        </div>
        <div class="list-group col-1 d-flex justify-content-center">
        <h1><</h1>
        </div>
        <!-- Tạo danh sách chọn hoa để thêm vào -->
        <div id="right_list_not" name="right_list_not" class="list-group col-5 d-flex justify-content-end">
            <label class="mr-sm-2">Bấm để thêm</label>
            <?php
                if (sizeof($rdata)>0) {
                    foreach ($rdata as $key => $r) {
                        if ($r['right_ID']!="Q00") {
                            if (!in_array($r['right_ID'], $rnot)) {
                                echo "<button type='button' name='r_item_not' class='list-group-item list-group-item-info d-flex justify-content-between align-items-center py-2 list-group-item-shop'>".$r['right_name'];
                                echo "<input name='rinsertid' type='hidden' value='".$r['right_ID']."'>";
                                echo "<input name='rinsertname' type='hidden' value='".$r['right_name']."'>";
                                echo "</button>";
                            }
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
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" name="cmdEditRoleR" id="cmdEditRoleR">Lưu</button>
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