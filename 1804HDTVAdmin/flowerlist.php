<?php
    include '../src/flowerdb.php';
    $data = getSql("SELECT * FROM v_flower_gen");
    $cdata = getSql("SELECT * FROM v_flower_color");
    $num = sizeof($data);
    
    if ($num<=0) {
        echo "Chưa có dữ liệu hoa";
    }else{
        echo "<table id='ftable' class='table table-hover table-bordered table-sm text-center'>";
        echo "<tr class='table-info table-shop'><th>Mã hoa</th><th>Tên hoa</th><th>Loại</th><th>Màu</th><th>Hình mẫu</th><th>Chi tiết</th></tr>";
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
            echo '<a class="btn btn-info btn-sm text-light btn-shop" 
                data-toggle="modal" data-target="#modal" 
                onclick="showModal(\'large\',\'Chỉnh sửa màu\',\'flowercolor.php?fid='.$f['f_ID'].'\');" 
                >Sửa</a>';
            echo "</td>";

            //-----------------------------------------------------------------------------
            // Hình
            echo "<td>";
            $fimg = "../".$f['f_img'];
            if (file_exists($fimg)) {
                echo '<img src="'.$fimg."?".date("dmyHis").'">';
            }else{
                echo '<img src="../img/undefined.jpg">';
            }
            echo "</td>";

            //-----------------------------------------------------------------------------
            //Chi tiết
            echo "<td><textarea disabled class='form-control' rows='5' style='resize: none;background-color:white'>".$f['f_detail']."</textarea></td>";

            //-----------------------------------------------------------------------------
            //Chức năng
            echo '<td><button class="btn btn-info btn-sm text-light btn-shop" 
                data-toggle="modal" data-target="#modal" 
                onclick="showModal(\'large\',\'Chỉnh sửa Hoa\',\'floweredit.php?fid='.$f['f_ID'].'\');" 
                >Sửa</button></td>';
            echo '<td><button class="btn btn-danger btn-sm text-light" 
            data-toggle="modal" data-target="#modal" 
            onclick="showModal(\'large\',\'Xóa hoa: '.$f["f_name"].'\',\'delete.php?flower&&fid='.$f['f_ID'].'&&fname='.$f["f_name"].'\');" 
            >Xóa</button></td>';
            
            //-----------------------------------------------------------------------------
            echo "</tr>";   
        }
        echo "</table>";
    }
?>