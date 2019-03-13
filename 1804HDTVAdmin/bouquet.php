<!-- Trang quản lý bó hoa -->
<?php
    // Bắt đầu session để lấy dữ liệu từ session ra
    session_start();
    // Kiểm tra xem nếu người đăng nhập hiện tại có quyền quản lý bó hoa (Q01) hoặc quyền admin (Q00) hay không
    if (!in_array("Q01",$_SESSION["sRight"],true) && !in_array("Q00",$_SESSION["sRight"],true)) {
        // Không thì ngăn truy cập bằng cách hiện ra dòng sau
        echo "<h2>Bạn không có quyền truy cập vào trang này!<h2>";
        // Phải có lệnh exit mới dừng việc load những phần bên dưới
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
?>

<style>
img {
    max-width: 20vh;
}
</style>

<body>
    <!-- Tựa đề -->
    <div class='row'>
        <h2 class="col-9">Quản lý Bó Hoa</h2>
        <button type="button" class="btn btn-success btn-lg col-2 ml-5 btn-shop" data-toggle="modal"
            data-target="#modal" ng-click="temp.url = 'bouquetadd2.php';modalHText='Thêm Bó Hoa mới';">
            Thêm Bó Hoa mới
        </button>
    </div>

    <br>

    <!-- Đọc dữ liệu từ database để đưa ra bảng -->
    <?php
        // File trung gian kết nối database
        include '../src/flowerdb.php';
        // Lấy dữ liệu thông tin bó hoa
        $data = getSql("SELECT * FROM bouquet");
        // Lấy dữ liệu thông tin các hoa, loại hoa có trong bó hoa đó (dùng bảng trung gian bouq_detail)
        $fdata = getSql("SELECT b_ID, bouq_detail.f_ID, f_name, f_cate_name FROM bouq_detail,v_flower_gen WHERE bouq_detail.f_ID = v_flower_gen.f_ID");
        // Lấy dữ liệu màu (dùng view v_flower_color: ghép bảng flower_color_detail và flower_color)
        $fcdata = getSql("Select * from v_flower_color");
        // Lấy dữ liệu hình của bó hoa đó (dùng bảng bouq_img)
        $imgdata = getSql("SELECT * from bouq_img order by b_img_ID");
        // Số dòng dữ liệu của $data
        $num = sizeof($data);
        
        // Nếu <= 0 nghĩa là không có dữ liệu
        if ($num<=0) {
            echo "Chưa có dữ liệu hoa";
        }else{
        // Nếu có dữ liệu thì bắt đầu lấy ra
            // Tạo bảng với id là 'btable'
            echo "<table id='btable' class='table table-hover table-bordered table-sm text-center'>";
            // Phần tựa đề cho các cột
            echo "<tr class='table-info table-shop'><th>Mã bó</th><th>Tên</th><th>Giá</th><th>Hình ảnh</th><th>Hoa có trong bó</th><th>Loại hoa</th><th>Màu</th><th>Chi tiết</th><th>Đang bán</th></tr>";
            // Khởi tạo con số này để dùng cho id của switch toggle trạng thái đang bán
            $num=0;
            //Lấy từng dữ liệu của array $data và đưa ra $b
            foreach ($data as $key=> $b) {
                //-----------------------------------------------------------------------------
                // Bắt đầu 1 dòng trong bảng
                // Nếu đang ở trạng thái không bán thì sẽ cho cả dòng màu khác
                if ($b['b_selling']==0) {
                    echo '<tr class="table-danger">';
                }else{
                // Còn không thì bắt đầu dòng mới bình thường
                    echo "<tr>";
                }
                
                //-----------------------------------------------------------------------------
                // ID bó hoa
                echo "<td>",$b['b_ID'],"</td>";

                //-----------------------------------------------------------------------------
                // Tên bó hoa
                echo "<td>",$b['b_name'],"</td>";

                //-----------------------------------------------------------------------------
                // Giá (number_format để định dạng lại có dấu "." ngăn cách dễ đọc)
                echo "<td>",number_format($b['b_price'],0,",",".")," VND</td>";

                //-----------------------------------------------------------------------------
                // Hình mẫu
                // Đặt max-width để đừng bị tràn màn hình khi hình quá lớn
                echo "<td style='max-width:25vh'>";
                // Đặt đường dẫn để bấm vào hình thì đưa ra trang quản lý hình ảnh của bó hoa đó
                echo "<a href='#!bouquet/img/".$b["b_ID"]."'>";
                // Tìm trong dữ liệu hình coi có file *_PV (hình mẫu preview) chưa. 
                foreach ($imgdata as $key2 => $img) {
                    // File preview luôn mặc định là: [mã bó hoa]_PV
                    $bimgpv = $b['b_ID']."_PV";
                    // Nếu tìm thấy ID hình nào của bó hoa này có định dạng *_PV thì đưa ra
                    if ($img['b_ID']==$b["b_ID"]) {
                        $bimg = $img['b_img'];
                        // có rồi thì break vòng lặp
                        break;
                    }else{
                        // Không tìm thấy ID dạng PV thì để trống
                        $bimg="";
                    }
                }
                // Nếu không có dữ liệu hình preview thì cho một hình thay thế và thông báo
                if ($bimg=="") {
                    echo "<img src='../img/undefined.jpg'>(Chưa có dữ liệu hình)";
                }else{
                // Nếu có rồi thì...
                    // Đầu tiên khởi tạo link của site gốc
                    $bimg = "../".$bimg;
                    // Kiểm tra xem file đó có thực ở thư mục đó không
                    if (file_exists($bimg)) {
                        // Nếu có thì đưa ra
                        echo "<img src='".$bimg."'>";
                    }else{
                        // Không thì lại cho hiện hình thay thế và thông báo
                        echo "<img src='../img/undefined.jpg'>(Hình chưa tồn tại)";
                    }
                }
                echo "</a>";
                echo "</td>";

                //-----------------------------------------------------------------------------
                // Các hoa cụ thể có trong bó
                echo "<td>";
                // Lấy dữ liệu từ bảng đã tạo (ghép bảng bouquet và bouq_detail) 
                foreach ($fdata as $key2 => $f) {
                    // Từ mỗi dữ liệu trong bảng trên, nếu trùng b_ID với bó hiện tại sẽ lấy ra
                    if ($f['b_ID']==$b['b_ID']) {
                        // Lấy ra tên của hoa đó
                        echo $f['f_name']."<br>";
                    }
                    // Tương tự cứ tìm hết danh sách, trùng b_ID thì lấy tên hoa ra,
                    // vậy là có tất cả hoa trong bó này
                }
                // Nút chỉnh sửa hoa có trong bó
                echo '<a class="btn btn-info btn-sm text-light btn-shop" data-toggle="modal" data-target="#modal" ';
                echo 'ng-click="temp.url = \'bouquetfedit.php?bid=',$b["b_ID"],'\';modalHText=\'Chỉnh sửa hoa trong bó hoa\';">Sửa</a>';
                echo "</td>";

                //-----------------------------------------------------------------------------
                // Các loại hoa có trong bó
                // nguyên tắc tựa như phần trên
                echo "<td>";
                foreach ($fdata as $key2 => $f) {
                    if ($f['b_ID']==$b['b_ID']) {
                        echo "Hoa ".$f['f_cate_name']."<br>";
                    }
                }
                echo "</td>";

                //-----------------------------------------------------------------------------
                // Các màu có trong bó
                // rắc rối bằt đầu từ đây
                echo "<td>";
                // Tạo mảng để chứa các màu đã hiển thị
                // dùng để kiểm tra tránh bị trùng màu
                $colorarr = array();
                // Trong mỗi hoa
                foreach ($fdata as $key2 => $f) {
                    // Nếu trùng ID với bó hiện tại thì...
                    if ($f['b_ID']==$b['b_ID']) {
                        // Tiếp tục tìm trong mỗi dữ liệu ở bảng trung gian màu hoa
                        foreach ($fcdata as $key3 => $fc) {
                            // Nếu dữ liệu trùng f_ID với hoa đang xét
                            if ($fc['f_ID']==$f['f_ID']) {
                                // Và nếu hoa đó không có trong mảng trên (nghĩa là chưa xuất hiện)
                                if (!in_array($fc['f_color_name'],$colorarr)) {
                                    // Cho nó vào mảng
                                    $colorarr[] = $fc['f_color_name'];
                                    // Cho nó hiện ra
                                    echo $fc['f_color_name']."<br>";
                                }
                                // Nếu có trong mảng trên thì bỏ qua
                            }
                            // Không trùng f_ID thì thôi
                        }
                    }
                    // Không trùng b_ID thì chia tay sớm 
                }
                echo "</td>";

                //-----------------------------------------------------------------------------
                // Chi tiết
                echo "<td>",$b['b_detail'],"</td>";

                //-----------------------------------------------------------------------------
                // Trạng thái đang bán hay không
                // Comment sao cho ngầu :v thực ra cái này hiển thị có hoặc không là được
                // Màu mè làm thêm switch toggle bằng bootstrap 4
                echo "<td>";
                if ($b['b_selling']==0) {
                    echo '<div class="custom-control custom-switch">';
                    echo '<a class="" href="#!bouquet/selling/',$b["b_ID"],'">';
                    echo '<input type="checkbox" class="custom-control-input" id="switch'.$num.'">';
                    echo '<label class="custom-control-label" for="switch'.$num.'">';
                    echo '</label></a></div>';
                    echo "Không";
                }else{
                    echo '<div class="custom-control custom-switch">';
                    echo '<a class="" href="#!bouquet/notselling/',$b["b_ID"],'">';
                    echo '<input type="checkbox" class="custom-control-input" id="switch'.$num.'" checked>';
                    echo '<label class="custom-control-label" for="switch'.$num.'">';
                    echo '</label></a></div>';
                    echo "Có";
                }
                echo "</td>";
                $num++;

                //-----------------------------------------------------------------------------
                // Các nút chức năng
                // Nút chỉnh sửa (hiện modal)
                echo '<td><button class="btn btn-info btn-sm text-light btn-shop" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'bouquetedit.php?bid=',$b["b_ID"],'\';modalHText=\'Chỉnh sửa Bó Hoa\';">Sửa</button></td>';
                // Nút quản lý hình
                echo '<td><a class="btn btn-info btn-sm text-light btn-shop" href="#!bouquet/img/',$b["b_ID"],'">Hình</a></td>';
                // Nút xóa
                // Chỉ admin mới có thể xóa được (tránh nhân viên xóa làm sai dữ liệu)
                if (in_array("Q00",$_SESSION["sRight"],true)) {
                    echo "<td>";
                    // Nếu bảng này không có dữ liệu liên quan nào nằm ở những bản khác
                    if ((sizeof(getSql("SELECT * FROM order_detail where b_ID = '".$b['b_ID']."'"))<=0)) {
                        // Cho nó hiện ra liền
                        echo '<button class="btn btn-danger btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'delete.php?bouquet&&bid=',$b["b_ID"],'&&bname=',$b["b_name"],'\';modalHText=\'Xóa ',$b["b_ID"],'\';">X</button>';
                    }else{
                    // Còn không thì...
                        // Cho nó hiện ra...hình thôi :v
                        echo '<a class="btn btn-secondary btn-sm text-light">X</a>';
                    }
                    echo "</td>";
                }
                // echo '<td><a class="btn btn-danger btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'./Pages/delete.php?bouquet&&bid=',$b["b_ID"],'&&bname=',$b["b_name"],'\';modalHText=\'Xóa ',$b["b_ID"],'\';">Xóa</a></td>';
                //-----------------------------------------------------------------------------
                echo "</tr>";   
            }
            echo "</table>";
        }
    ?>
    <br>

    <!-- Modal chung -->
    <div class="modal fade" id="modal" ng-controller="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-info bg-shop">
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