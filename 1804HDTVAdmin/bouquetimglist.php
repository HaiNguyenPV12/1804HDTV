<?php
    if(isset($_GET["bid"])){
        $bid=$_GET["bid"];
    }
    include '../src/flowerdb.php';
    if ($bid!="") {
        $data = getSql("select * from bouq_img where b_ID ='$bid'");
        if (sizeof($data)>0) {
            // Nút thêm hình
            echo "<table id='bimgtable' class='table table-hover table-bordered table-sm text-center'>";
            echo "<tr class='table-info table-shop'><th>Mã hình</th><th>Đường dẫn</th><th>Hình mẫu</th></tr>";
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
                echo '<td><button class="btn btn-info btn-sm text-light btn-shop" 
                    data-toggle="modal" data-target="#imgModal" 
                    onclick="showModal(\'large\',\'Cập nhật hình\',\'bouquetimgedit.php?bimgid='.$imgdata["b_img_ID"].'\');" 
                    >Cập nhật</button></td>';
                // Nút Xóa
                if (sizeof($data)!=1) {
                    echo '<td><button class="btn btn-danger btn-sm text-light"
                    data-toggle="modal" data-target="#imgModal" 
                    onclick="showModal(\'large\',\'Xóa hình\',\'delete.php?bouquetimg&&bimgid='.$imgdata["b_img_ID"].'\');"
                    >Xóa</button></td>';
                }else{
                    echo '<td><a class="btn btn-secondary btn-sm text-light">Xóa</a></td>';
                }
                echo "</tr>";
            }
            
            echo "</table>";
        }else{
            echo "Chưa có dữ liệu hình!<br>";
        }
    }
?>