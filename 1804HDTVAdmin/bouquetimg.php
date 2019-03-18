<!-- Trang quản lý hình ảnh của bó -->

<style>
.pvimg{
    max-width:20vw;
}
</style>
<?php
    session_start();
    if (!in_array("Q01",$_SESSION["sRight"],true) && !in_array("Q00",$_SESSION["sRight"],true)) {
        echo "<h2>Không tìm thấy trang!<h2>";
        exit;
    }
    
    //xóa file tạm trên server'
    $files = glob('tmp/*'); // get all file names
    if (sizeOf($files)>0) {
        foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
        }
    }
    include '../src/flowerdb.php';
    if (isset($_GET["bid"])) {
        $bid = $_GET["bid"];
        if (sizeof(getSql("SELECT * from bouquet where b_ID='$bid'"))<=0) {
            $bid="";
        }
    }else{
        exit;
    }
?>
<script src="../Scripts/1804HDTVAdmin/bouquetimg.js"></script>
<body>
<div class='row'>
    <h2 class="col-9">Quản lý Bó Hoa > Quản lý hình: <?php 
    if ($bid!="") {
        echo $bid;
    }else{
        echo "Sai ID!";
    }
    echo '  <a href="#!bouquet" class="btn btn-warning btn-md">Quay về</a>';
    ?>
    </h2>

    <?php
    echo '<button id="cmdAddImg" class="btn btn-success btn-lg col-2 ml-5 btn-shop" ';
    echo 'data-toggle="modal" data-target="#imgModal" onclick="showModal(\'large\',\'Thêm hình mới\',\'bouquetimgadd.php?bid='.$bid.'\');">Thêm hình</button>';
    ?>
    <!--
    <button type="button" class="btn btn-success btn-lg col-2" data-toggle="modal" data-target="#modal" ng-click="temp.imgurl = './Pages/productadd.php';modalHText='Thêm mới';">Thêm mới</button>
    -->
    <input type="hidden" id="imgbid" value="<?php echo $bid?>">
</div>

<div id="main">

</div>


<!-- Modal chung -->
<div class="modal fade" id="imgModal" ng-controller="myImgModal">
    <div id="modalSetting" class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-info bg-shop">
                <h4 id="modalHeader" class="modal-title text-light">{{imgModalHText}}</h4>
                <button name="cmdHide" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="modalBody" class="modal-body">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button name="cmdHide" type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
            </div>

        </div>
    </div>
</div>
</body>