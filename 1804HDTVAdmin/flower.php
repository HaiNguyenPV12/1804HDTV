<!-- Trang quản lý hoa -->
<?php
    session_start();
    if (!in_array("Q02",$_SESSION["sRight"],true) && !in_array("Q00",$_SESSION["sRight"],true)) {
        echo "<h2>Không tìm thấy trang!<h2>";
        exit;
    }
    //xóa file tạm trên server'
    $files = glob('../tmp/*'); // get all file names
    if (sizeOf($files)>0) {
        foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
        }
    }
?>
<style>
img{
    max-width:25vh;
}
</style>
<body>
    <div class='row'>
        <h2 class="col-7">Quản lý Hoa</h2>
        <?php
        if (in_array("Q03",$_SESSION["sRight"],true) || in_array("Q00",$_SESSION["sRight"],true)) {
            echo '<a class="btn btn-info btn-lg col-2 pr-sm-2 pl-sm-2" href="#!flower/category">';
            echo 'Quản lý loại hoa';
            echo '</a>';
        }
        ?>
        <button type="button" class="btn btn-success btn-lg col-2 pr-sm-2 pl-sm-2 ml-5" data-toggle="modal" data-target="#modal" ng-click="temp.url = './Pages/floweradd.php';modalHText='Thêm mới';">
            Thêm mới
        </button>
    </div>
    <br>
    <?php
        include '.././src/flowerdb.php';
        $data = getSql("SELECT * FROM v_flower_gen");
        $cdata = getSql("SELECT * FROM v_flower_color");
        $num = sizeof($data);
        
        if ($num<=0) {
            echo "Chưa có dữ liệu hoa";
        }else{
            echo "<table id='ftable' class='table table-hover table-bordered table-sm text-center'>";
            echo "<tr class='table-info'><th>Mã hoa</th><th>Tên hoa</th><th>Loại</th><th>Màu</th><th>Hình mẫu</th><th>Chi tiết</th></tr>";
            foreach ($data as $key=> $f) {
                //-----------------------------------------------------------------------------
                echo "<tr>";

                //-----------------------------------------------------------------------------
                //ID
                echo "<td>",$f['f_ID'],"</td>";

                //-----------------------------------------------------------------------------
                //Tên hoa
                echo "<td>",$f['f_name'],"</td>";

                //-----------------------------------------------------------------------------
                //Loại hoa
                echo "<td>",$f['f_cate_name'],"</td>";

                //-----------------------------------------------------------------------------
                //Màu
                echo "<td>";
                foreach ($cdata as $key2 => $c) {
                    if ($c['f_ID']==$f['f_ID']) {
                        echo $c['f_color_name']."<br>";
                    }
                }
                // Nút sửa màu
                echo '<a class="btn btn-info btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'./Pages/flowercolor.php?fid=',$f['f_ID'],'\';modalHText=\'Chỉnh sửa màu trong hoa\';">Sửa</a>';
                echo "</td>";

                //-----------------------------------------------------------------------------
                // Hình
                echo "<td>";
                $fimg = "./../../1804HDTV/".$f['f_img'];
                if (file_exists($fimg)) {
                    echo '<img src="'.$fimg.'">';
                }else{
                    echo '<img src="./../../1804HDTV/img/undefined.jpg">';
                }
                echo "</td>";

                //-----------------------------------------------------------------------------
                //Chi tiết
                echo "<td>",$f['f_detail'],"</td>";

                //-----------------------------------------------------------------------------
                //Chức năng
                echo '<td><button class="btn btn-info btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url=\'\'; temp.url = \'./Pages/floweredit.php?fid=',$f["f_ID"],'\';modalHText=\'Chỉnh sửa\';">Sửa</button></td>';
                echo '<td><button class="btn btn-danger btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'./Pages/delete.php?flower&&fid=',$f["f_ID"],'&&fname=',$f["f_name"],'\';modalHText=\'Xóa ',$f["f_ID"],'\';">Xóa</button></td>';
                
                //-----------------------------------------------------------------------------
                echo "</tr>";   
            }
            echo "</table>";
        }
    ?>
    <br>
    <!-- Modal chung -->
    <div class="modal fade" id="modal"  ng-controller="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-info">
                    <h4 id="modalHeader" class="modal-title text-light">{{modalHText}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div ng-include="temp.url">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                </div>

            </div>
        </div>
    </div>
</body>
