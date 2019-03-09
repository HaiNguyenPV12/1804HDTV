<script src="../Scripts/1804HDTVAdmin/delete.js"></script>
<form name="frmDelete" id="frmDelete" method="post">
<?php
    if (isset($_GET['bouquet'])) {
        if (isset($_GET["bid"])&&$_GET["bid"]!="") {
            $id = $_GET["bid"];
            $name = $_GET["bname"];
            include '../src/flowerdb.php';
            $img = getSql("SELECT * FROM bouq_img where b_ID = '$id'");
            $order = getSql("SELECT * FROM order_detail where b_ID ='$id'");
            if (sizeof($order)>0) {
                echo "<h4 class='text-danger'>Không thể xóa vì đã có trong đơn hàng!<br>Hãy đặt lại trạng thái bán thay vì xóa.</h4>";
                exit;
            }
            echo '<input name="bid" id="bid" type="hidden" value="',$id,'">';
            echo '<input name="cmdDelete" type="hidden">';
            echo "<h2>Bạn có muốn xóa bó \"$name\" ?</h2>";
            
            if (sizeof($img)>0) {
                echo "<b><p class='text-danger'>Lưu ý: Các hình của bó hoa này cũng bị xóa theo! Hãy lưu hình lại nếu cần thiết.</p></b>";
            }
            
            echo "<input type='button' name='cmdDelete' id='cmdDelete' class='btn mb-2 btn-success btn-shop' value='Có'></button>";
            echo "<button id='cmdCancel' class='btn mb-2 btn-danger'>Không</button>";
        }else{
            echo "Không thấy ID";
        }
    }else if (isset($_GET['bouquetimg'])){
        if (isset($_GET["bimgid"])&&$_GET["bimgid"]!="") {
            $id = $_GET["bimgid"];
            echo '<input name="bimgid" id="bimgid" type="hidden" value="',$id,'">';
            echo '<input name="cmdDelete" type="hidden">';
            echo "<h2>Bạn có muốn xóa \"$id\" ?</h2>";
            echo "<input type='button' name='cmdDelete' id='cmdDelete' class='btn mb-2 btn-success btn-shop' value='Có'></button>";
            echo "<button id='cmdCancel' class='btn mb-2 btn-danger'>Không</button>";
        }else{
            echo "Không thấy ID";
        }
    }else if (isset($_GET['flower'])) {
        if (isset($_GET["fid"])&&$_GET["fid"]!="") {
            $id = $_GET["fid"];
            $name = $_GET["fname"];
            include '../src/flowerdb.php';
            $existed = getSql("SELECT * FROM bouq_detail where f_ID = '$id'");
            echo '<input name="fid" id="fid" type="hidden" value="',$id,'">';
            echo '<input name="cmdDelete" type="hidden">';
            echo "<h2>Bạn có muốn xóa \"$name\" ?</h2>";
            if (sizeof($existed)>0) {
                echo "<b><p class='text-danger'>Lưu ý: Hoa này đã có dữ liệu trong bó hoa. Nếu xóa thì dữ liệu hoa này trong bó hoa đó cũng sẽ mất.</p></b>";
            }
            echo "<input type='button' name='cmdDelete' id='cmdDelete' class='btn mb-2 btn-success btn-shop' value='Có'></button>";
            echo "<button id='cmdCancel' class='btn mb-2 btn-danger'>Không</button>";
        }else{
            echo "Không thấy ID";
        }
    }else if (isset($_GET['role'])) {
        if (isset($_GET["roleid"])&&$_GET["roleid"]!="") {
            $id = $_GET["roleid"];
            $name = $_GET["rolename"];
            include '../src/staffdb.php';
            $existed = getSql("select * from staff where s_role_ID = '$id'");
            if (sizeof($existed)>0) {
                echo "<h4 class='text-danger'>Vẫn còn người giữ chức vụ này nên không thể xóa được!<br>Hãy chắc chắn rằng không còn ai còn giữ chức vụ này nữa.</h4>";
            }else{
                echo '<input name="roleid" id="roleid" type="hidden" value="',$id,'">';
                echo '<input name="cmdDelete" type="hidden">';
                echo "<h2>Bạn có muốn xóa \"$name\" ?</h2>";
                echo "<input type='button' name='cmdDelete' id='cmdDelete' class='btn mb-2 btn-success btn-shop' value='Có'></button>";
                echo "<button id='cmdCancel' class='btn mb-2 btn-danger'>Không</button>";
            }
        }else{
            echo "Không thấy ID";
        }
    }else{
        echo "Không thấy trang muốn đến!";
    }
?>
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