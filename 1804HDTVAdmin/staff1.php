<html>
    <!-- Tựa đề -->
    <div class='row'>
        <h2 class="col-10">Quản lý Nhân viên</h2>
        <button type="button" class="btn btn-success btn-lg col-2 btn-shop">
            <a href="#!staffadd">Thêm mới</a>
        </button>
    </div>

    <br>

    <!-- Đọc dữ liệu từ database để đưa ra bảng -->
    <?php
// File trung gian kết nối database
include '.././src/staffdb.php';
// Lấy dữ liệu thông tin nhân viên
$data = getSql("SELECT s_ID, s_name, s_u_ID, s_u_PW, s_role_name, s_email, s_phone, s_address, s_employed FROM staff, staff_role where staff.s_role_ID = staff_role.s_role_ID");
$size = sizeof($data);
$num = 0;
if ($size <= 0) {
    echo "Chưa có dữ liệu nhân viên";
} else {
    echo "<table id='stafftable' class='table table-hover table-bordered table-sm text-center'>";
    echo "<tr class='table-info table-shop'><th>Mã NV</th><th>Tên nhân viên</th><th>Chức vụ</th><th>Email</th><th>Tên đăng nhập</th><th>Mật khẩu</th><th>Số điện thoại</th><th>Địa chỉ</th><th>Đang làm việc</th></tr>";
    foreach ($data as $key => $s) {
        //-----------------------------------------------------------------------------
        echo "<tr>";

        //-----------------------------------------------------------------------------
        //ID
        echo "<td>", $s['s_ID'], "</td>";

        //-----------------------------------------------------------------------------
        //Tên
        echo "<td>", $s['s_name'], "</td>";

        //-----------------------------------------------------------------------------
        //Chức vụ
        echo "<td>", $s['s_role_name'], "</td>";

        //-----------------------------------------------------------------------------
        //Email
        echo "<td>", $s['s_email'], "</td>";

        //-----------------------------------------------------------------------------
        //UserName
        echo "<td>", $s['s_u_ID'], "</td>";

        //-----------------------------------------------------------------------------
        //Password
        echo "<td>", $s['s_u_PW'], "</td>";

        //-----------------------------------------------------------------------------
        //Phone
        echo "<td>", $s['s_phone'], "</td>";

        //-----------------------------------------------------------------------------
        //Địa chỉ
        echo "<td>", $s['s_address'], "</td>";

        echo "<td>";
        if ($s['s_employed'] == 0) {
            echo '<div class="custom-control custom-switch">';
            echo '<a class="" href="#!bouquet/employed/', $s["s_ID"], '">';
            echo '<input type="checkbox" class="custom-control-input" id="switch' . $num . '">';
            echo '<label class="custom-control-label" for="switch' . $num . '">';
            echo '</label></a></div>';
            echo "Không";
        } else {
            echo '<div class="custom-control custom-switch">';
            echo '<a class="" href="#!staff/notemployed/', $s["s_ID"], '">';
            echo '<input type="checkbox" class="custom-control-input" id="switch' . $num . '" checked>';
            echo '<label class="custom-control-label" for="switch' . $num . '">';
            echo '</label></a></div>';
            echo "Có";
        }
        echo "</td>";
        $num++;

        //-----------------------------------------------------------------------------
        //Chức năng
        echo '<td><button class="btn btn-info btn-sm text-light btn-shop" data-toggle="modal" data-target="#modal" ng-click="temp.url=\'\'; temp.url = \'staffedit.php?fid=', $s["s_ID"], '\';modalHText=\'Chỉnh sửa\';">Sửa</button></td>';
        echo '<td><button class="btn btn-danger btn-sm text-light" data-toggle="modal" data-target="#modal" ng-click="temp.url = \'delete.php?staff&&sid=', $s["s_ID"], '&&fname=', $s["s_name"], '\';modalHText=\'Xóa ', $s["s_ID"], '\';">Xóa</button></td>';

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

</html>