<?php
    // Đầu tiên là lấy dữ liệu của loại hoa và dữ liệu của hoa (để kiểm tra xem loại hoa đó có chứa trong danh sách hoa chưa)
    include '../src/flowerdb.php';
    $sitedir = "../";
    $fcdata = getSql("SELECT * FROM flower_cate");
    $fdata = getSql("SELECT f_ID, f_cate_ID FROM flower");
    $fd = array_column($fdata, "f_cate_ID");
    $num = sizeof($fcdata);
    
    if ($num<=0) {
        echo "Chưa có dữ liệu loại hoa";
    }else{
        echo "<table id='fcatetable' class='table table-hover table-bordered table-sm text-center'>";
        echo "<tr class='table-info table-shop'>
                <th>Mã loại hoa</th>
                <th>Tên loại hoa</th>
                <th>Hình</th>
                <th>Chi tiết</th>
            </tr>";
        foreach ($fcdata as $key=> $fc) {
            //-----------------------------------------------------------------------------
            echo "<tr>";

            //-----------------------------------------------------------------------------
            //ID
            echo "<td>",$fc['f_cate_ID'],"</td>";

            //-----------------------------------------------------------------------------
            //Tên loại hoa
            echo "<td>",$fc['f_cate_name'],"</td>";

            //-----------------------------------------------------------------------------
            //Hình
            echo "<td style='max-width:15vw'>";
            if (file_exists($sitedir.$fc["f_cate_img"])) {
                echo "<img style='max-width:10vw' src='".$sitedir.$fc["f_cate_img"]."?".date("dmyHis")."'>";
            }else{
                echo "<img style='max-width:10vw' src='../img/undefined.jpg'>";
            }
            echo "</td>";

            //-----------------------------------------------------------------------------
            //Chi tiết
            echo "<td>
                <textarea disabled class='form-control' rows='5' style='resize: none;background-color:white'>".$fc['f_cate_detail']."
                </textarea>
                </td>";

            //-----------------------------------------------------------------------------
            //Chức năng
            echo '<td>
                <button class="btn btn-info btn-sm text-light btn-shop" 
                data-toggle="modal" data-target="#modal" 
                onclick="showModal(\'large\',\'Chỉnh sửa Loại Hoa\',\'flowercateedit.php?fcateid='.$fc["f_cate_ID"].'\');"
                >Sửa</button>
                </td>';
           
            if (!in_array($fc['f_cate_ID'],$fd,true)) {
                echo '<td>
                    <button class="btn btn-danger btn-sm text-light" 
                    data-toggle="modal" data-target="#modal" 
                    onclick="showModal(\'large\',\'Xóa Loại Hoa: '.$fc["f_cate_name"].'\',\'delete.php?flowercate&&fcateid='.$fc["f_cate_ID"].'&&fcatename='.$fc["f_cate_name"].'\');"
                    >Xóa</button>
                    </td>';
            }else{
                echo '<td><button class="btn btn-secondary btn-sm text-light">Xóa</button></td>';
            }
            
            
            //-----------------------------------------------------------------------------
            echo "</tr>";   
        }
        echo "</table>";
    }
?>