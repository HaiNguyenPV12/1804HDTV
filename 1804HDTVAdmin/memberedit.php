<?php
    include '../src/flowerdb.php';
    if (isset($_GET["memid"])) {
        $id = $_GET["memid"];
        $data = getSql("select * from member,customer where customer.cus_ID = member.cus_ID AND member.mem_ID = '$id'");
        if(sizeof($data)<=0)
        {
            die("khong tim thay ma KH");
        }
        else
        {
            $data= $data[0];
        }
    }else{
        echo "no";
    }
    $sitedir="../";
?>
<script src="../Scripts/1804HDTVAdmin/memberedit.js"></script>

<form id="frmEditMember" name="frmEditMember" method="post">
    <input type="hidden" name="cmdEditMember">
    <input type="hidden" id="memid_old" name="memid_old" value="<?php echo $id?>">
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mã TV:</label>
        <input type="text" readonly class="form-control mb-2 mr-sm-2 col-9" name="memID" id="memID" autocomplete="off" value="<?php echo $data['mem_ID']?>" readonly="true">
    </div>
    
    <div class="form-inline">
        <input type="hidden" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="cusID" id="cusID" autocomplete="off" value="<?php echo $id?>" readonly="true">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên TV:</label>
        <input type="text" autofocus required class="form-control mb-2 mr-sm-2 col-9" name="memName" id="memName" autocomplete="off" value="<?php echo $data['cus_name']?>">
    </div>
    
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Email TV:</label>
        <input type="text" required class="form-control mb-2 mr-sm-2 col-9" name="memEmail" id="memEmail" autocomplete="off" value="<?php echo $data['cus_email']?>">
    </div>

    <div class="form-inline">
        <label class="mr-sm-2 col-2">SĐT TV:</label>
        <input type="text"  class="form-control mb-2 mr-sm-2 col-9" name="memPhone" id="memPhone" value="<?php echo $data['cus_phone']?>">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Địa chỉ TV:</label>
        <input type="text"  class="form-control mb-2 mr-sm-2 col-9" name="memAddress" id="memAddress" value="<?php echo $data['cus_address']?>">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Tên Login:</label>
        <input type="text"  class="form-control mb-2 mr-sm-2 col-9" name="memUID" id="memUID" value="<?php echo $data['mem_uID']?>">
    </div>
    <div class="form-inline">
        <label class="mr-sm-2 col-2">Mật khẩu Login:</label>
        <input type="text"  class="form-control mb-2 mr-sm-2 col-9" name="memUPW" id="memUPW" value="<?php echo $data['mem_uPW']?>">
    </div>    
    <div class="form-inline">
        <label class="mr-sm-2 col-2"></label>
        <button type="submit" class="btn btn-primary mb-2 col-2 btn-shop" name="cmdEditMember">Hoàn tất</button>
        
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