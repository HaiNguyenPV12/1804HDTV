<html>
<script src="../Scripts/1804HDTVAdmin/staff.js"></script>
<script src="../Scripts/1804HDTVAdmin/controllers/staffcontroller.js"></script>
<!-- Tựa đề -->
<div class='row'>
    <h2 class="col-10">Quản lý Nhân viên</h2>
    <button type="button" class="btn btn-success btn-lg col-2 btn-shop">
        <a href="#!staffadd">Thêm mới</a>
    </button>
</div>

<div class='py-1'></div>

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
        //ID
        echo "<td>", $s['s_ID'], "</td>";
        //Tên
        echo "<td>", $s['s_name'], "</td>";
        //Chức vụ
        echo "<td>", $s['s_role_name'], "</td>";
        //Email
        echo "<td>", $s['s_email'], "</td>";
        //UserName
        echo "<td>", $s['s_u_ID'], "</td>";
        //Password
        echo "<td>", $s['s_u_PW'], "</td>";
        //Phone
        echo "<td>", $s['s_phone'], "</td>";
        //Địa chỉ
        echo "<td>", $s['s_address'], "</td>";
        //Đang Làm Việc
        echo "<td>";
        if ($s['s_employed'] == 0) {
            echo "
            <button class='btn btn-outline-danger' disabled>
                Không
            </button>";
        } else {
            echo "
            <button class='btn btn-outline-success' disabled>
                Có
            </button>";
        }
        echo "</td>";
        $num++;
        //Sửa
        echo "
        <td>
            <button class='btn btn-info btn-sm text-light btn-shop'>
                <a href='#!staff/edit/" . $s["s_ID"] . "'>Sửa</a>
            </button>
        </td>";
        //End of Row
        echo "</tr>";
    }
    echo "</table>";
}
?>
<div class='py-1'></div>

</body>

</html>