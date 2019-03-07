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
    include '../src/flowerdb.php';
    //xóa file tạm trên server'
    $files = glob('tmp/*'); // get all file names
    if (sizeOf($files)>0) {
        foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
        }
    }
    if (isset($_GET["bid"])) {
        $bid = $_GET["bid"];
        if (sizeof(getSql("SELECT * from bouquet where b_ID='$bid'"))<=0) {
            $bid="";
        }
    }else{
        exit;
    }
?>
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
    echo '<button id="cmdAddImg" class="btn btn-success btn-lg col-2 ml-5" ';
    echo 'data-toggle="modal" data-target="#imgModal" ng-click="temp.imgurl =\'bouquetimgadd.php?bid=',$bid,'\';imgModalHText=\'Thêm hình\'">Thêm hình</button>';
    ?>
    <!--
    <button type="button" class="btn btn-success btn-lg col-2" data-toggle="modal" data-target="#modal" ng-click="temp.imgurl = './Pages/productadd.php';modalHText='Thêm mới';">Thêm mới</button>
    -->
</div>

<?php
    if ($bid!="") {
        $data = getSql("select * from bouq_img where b_ID ='$bid'");
        if (sizeof($data)>0) {
            // Nút thêm hình
            echo "<table id='bimgtable' class='table table-hover table-bordered table-sm text-center'>";
            echo "<tr class='table-info'><th>Mã hình</th><th>Đường dẫn</th><th>Hình mẫu</th></tr>";
            foreach ($data as $key => $imgdata) {
                echo "<tr>";
                echo "<td>",$imgdata['b_img_ID'],"</td>";
                echo "<td>",$imgdata['b_img'],"</td>";
                if (file_exists("../".$imgdata['b_img'])) {
                    echo "<td><img class='pvimg' src='../",$imgdata['b_img'],"'></img></td>";
                }else{
                    echo "<td><img class='pvimg' src='../img/undefined.jpg'></img></td>";
                }
                // Nút chỉnh sửa
                echo '<td><a class="btn btn-info btn-sm text-light" ';
                echo 'data-toggle="modal" data-target="#imgModal" ng-click="temp.imgurl = \'bouquetimgedit.php?bimgid=',$imgdata["b_img_ID"],'\';imgModalHText=\'Chỉnh sửa\';">Sửa</a></td>';
                // Nút Xóa
                echo '<td><a class="btn btn-danger btn-sm text-light" ';
                echo 'data-toggle="modal" data-target="#imgModal" ng-click="temp.imgurl = \'delete.php?bouquetimg&&bimgid=',$imgdata["b_img_ID"],'\';imgModalHText=\'Xóa\';">Xóa</a></td>';
                echo "</tr>";
            }
            
            echo "</table>";
        }else{
            echo "Chưa có dữ liệu hình!<br>";
        }
    }

    
?>


<!-- Modal chung -->
<div class="modal fade" id="imgModal" ng-controller="myImgModal">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-info">
                <h4 id="modalHeader" class="modal-title text-light">{{imgModalHText}}</h4>
                <button name="cmdHide" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div ng-include="temp.imgurl">
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button name="cmdHide" type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
            </div>

        </div>
    </div>
</div>
</body>