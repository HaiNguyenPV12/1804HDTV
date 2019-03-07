<?php
    session_start();
    // Kiểm tra quyền truy cập trang này
    if (!in_array("Q00",$_SESSION["sRight"],true)) {
        echo "<h2>Không tìm thấy trang!<h2>";
        exit;
    }
    
?>
<!-- Tựa đề -->
<div class='row'>
    <h2 class="col-10">Quản lý Chức vụ</h2>
    <button type="button" class="btn btn-success btn-lg col-2" data-toggle="modal" data-target="#modal" ng-click="temp.url = 'roleadd.php';modalHText='Thêm mới';">Thêm mới</button>
</div>

<br>

<!-- Đọc dữ liệu từ database để đưa ra bảng -->
<?php
    // File trung gian kết nối database
    include '../src/staffdb.php';
    // Lấy dữ liệu thông tin về quyền hạn và chức vụ nhân viên
    $right = getSql("SELECT s_role_ID , right_name FROM rights, right_detail where rights.right_ID = right_detail.right_ID");
    $role = getSql("SELECT staff_role.*,count(right_detail.s_role_ID) as num FROM `staff_role` left join right_detail on (staff_role.s_role_ID = right_detail.s_role_ID) group by s_role_ID, s_role_name, s_role_detail order by case when staff_role.s_role_ID='admin' then 0 ELSE 1 end, num desc");

    if (sizeof($role)<=0) {
        echo "Không có dữ liệu";
    }else{
        // Tạo bảng với id là 'rtable'
        echo "<table id='rtable' class='table table-hover table-bordered table-sm'>";
        // Phần tựa đề cho các cột
        echo "<tr class='table-info'><th>Mã chức vụ</th><th>Tên chức vụ</th><th>Quyền hạn</th><th>Chi tiết</th></tr>";
        foreach ($role as $key => $roledata) {
            //-----------------------------------------------------------------------------
            // Bắt đầu 1 dòng trong bảng
            echo "<tr>";

            //-----------------------------------------------------------------------------
            // Mã chức vụ
            echo "<td>",$roledata['s_role_ID'],"</td>";

            //-----------------------------------------------------------------------------
            // Tên chức vụ
            echo "<td>",$roledata['s_role_name'],"</td>";

            //-----------------------------------------------------------------------------
            // Các quyền cụ thể
            echo "<td>";
            $rcount=0;
            foreach ($right as $key2 => $rdata) {
                if ($rdata['s_role_ID']==$roledata['s_role_ID']) {
                    echo $rdata['right_name']."<br>";
                    $rcount++;
                }
            }
            if ($roledata['s_role_ID']!="admin") {
                echo '(Có '.$rcount.' quyền) <a class="btn btn-info btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'roleredit.php?roleid=',$roledata["s_role_ID"],'\';modalHText=\'Chỉnh sửa quyền của '.$roledata["s_role_name"].'\';">Sửa quyền hạn</a>';
            }
            echo "</td>";

            //-----------------------------------------------------------------------------
            // Chi tiết
            echo "<td style='max-width:30vh'>",$roledata['s_role_detail'],"</td>";

            //-----------------------------------------------------------------------------
            //Chức năng
            if ($roledata['s_role_ID']!="admin") {
                echo '<td><a class="btn btn-info btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'roleedit.php?roleid=',$roledata["s_role_ID"],'\';modalHText=\'Chỉnh sửa\';">Sửa</a></td>';
                if (sizeof(getSql("SELECT * from staff where s_role_ID ='".$roledata['s_role_ID']."'"))>0) {
                    echo '<td><a class="btn btn-secondary btn-sm text-light">Xóa</a></td>';
                }else{
                    echo '<td><a class="btn btn-danger btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'delete.php?role&&roleid=',$roledata["s_role_ID"],'&&rolename=',$roledata["s_role_name"],'\';modalHText=\'Xóa ',$roledata["s_role_name"],'\';">Xóa</a></td>';
                }
                
            }
        }
    }
    
?>

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