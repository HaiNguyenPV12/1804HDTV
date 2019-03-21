<html>
<script src="../Scripts/1804HDTVAdmin/staffedit.js"></script>

<?php
// File trung gian kết nối database
include '.././src/staffdb.php';
$data;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    global $data;
    $id = $_GET['id'];
    $data = getSql("SELECT s_ID, s_name, s_u_ID, s_u_PW, s_role_name, s_email, s_phone, s_address, s_employed, staff.s_role_ID FROM staff, staff_role where staff.s_role_ID = staff_role.s_role_ID and s_ID = $id");
}
?>
<button class='btn btn-shop'>
    <a href="#!staff/">
        Về Trang Nhân Viên
    </a>
</button>
<div class='py-1'></div>
<form name='staffEditForm' id='staffEditForm'>
    <table class='table table-hover table-bordered table-sm'>
        <tbody>
            <tr>
                <td>ID</td>
                <td>
                    <input name='staffID' id='staffID' type='text' disabled value='<?php
foreach ($data as $key => $r) {
    echo $r['s_ID'];
}
?>'>
                </td>
            </tr>
            <tr>
                <td>Tên</td>
                <td>
                    <input type='text' required name='staffName' id='staffName' value='<?php
foreach ($data as $key => $r) {
    echo $r['s_name'];
}
?>'>
                </td>
            </tr>
            <tr>
                <td>Chức Vụ</td>
                <td>
                    <select name='staffRole' id='staffRole'>
                        <?php
foreach ($data as $key => $r) {
    echo "
    <option value='" . $r['s_role_ID'] . "'>" . $r['s_role_name'] . "</option>
    ";
}
$roles = getSql("SELECT * FROM staff_role");
foreach ($roles as $key => $r) {
    echo "
    <option value='" . $r['s_role_ID'] . "'>" . $r['s_role_name'] . "</option>
    ";
}
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type='text' required name='staffEmail' id='staffEmail' value='<?php
foreach ($data as $key => $r) {
    echo $r['s_email'];
}
?>'>
                </td>
            </tr>
            <tr>
                <td>UserName</td>
                <td>
                    <input type='text' required name='staffUID' id='staffUID' value='<?php
foreach ($data as $key => $r) {
    echo $r['s_u_ID'];
}
?>'>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type='password' required name='staffPW' id='staffPW' value='<?php
foreach ($data as $key => $r) {
    echo $r['s_u_PW'];
}
?>'>
                </td>
            </tr>
            <tr>
                <td>Số ĐT</td>
                <td>
                    <input type='text' required name='staffPhone' id='staffPhone' value='<?php
foreach ($data as $key => $r) {
    echo $r['s_phone'];
}
?>'>
                </td>
            </tr>
            <tr>
                <td>Địa Chỉ</td>
                <td>
                    <input type='text' required name='staffAdd' id='staffAdd' value='<?php
foreach ($data as $key => $r) {
    echo $r['s_address'];
}
?>'>
                </td>
            </tr>
            <tr>
                <td>Đang Làm Việc</td>
                <td>
                    <select name='staffEmployed' id='staffEmployed'>
                        <?php
function employedText($isEmployed)
{
    if ($isEmployed == 0) {
        return "Không";
    } else if ($isEmployed == 1) {
        return "Có";
    }
}
foreach ($data as $key => $r) {
    echo "
    <option value='" . $r['s_employed'] . "'>" . employedText($r['s_employed']) . "</option>
    ";
}
echo "
    <option value='" . 0 . "'>" . "Không" . "</option>
    <option value='" . 1 . "'>" . "Có" . "</option>
    ";
?>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-shop" name="btnStaffEdit" id="btnStaffEdit" type='submit'>
        Lưu
    </button>
    <a id="btnStaffEditLink" href='' hidden>
        Lưu
    </a>
</form>

</html>