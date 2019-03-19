<!-- Trang thêm hoa -->
<!-- Trang này phức tạp ở chỗ thêm cả thông tin hoa lẫn hình -->
<html>
<script src="../Scripts/1804HDTVAdmin/occaedit.js"></script>
<?php
include '../src/flowerdb.php';
$data;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    global $data;
    $id = $_GET['id'];
    $data = getSql("SELECT * from occasion where occa_ID = '$id'");
}
?>
<button class='btn btn-shop'>
    <a href="#!occasion/">
        Về Trang Bó
    </a>
</button>

<div class='py-1'></div>
<form name='staffEditForm' id='staffEditForm'>
    <table class='table table-hover table-bordered'>
        <tbody>
            <tr>
                <td>ID</td>
                <td>
                    <input name='occaID' id='occaID' type='text' value='<?php
foreach ($data as $key => $r) {
    echo $r['occa_ID'];
}
?>'>
                </td>
            </tr>
            <tr>
                <td>Tên Dịp</td>
                <td>
                    <input type='text' name='occaName' id='occaName' value='<?php
foreach ($data as $key => $r) {
    echo $r['occa_name'];
}
?>'>
                </td>
            </tr>
            <tr>
                <td>Chi Tiết Dịp</td>
                <td>
                    <textarea name='occaDetail' id='occaDetail'>
                    <?php
foreach ($data as $key => $r) {
    echo $r['occa_detail'];
}
?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <td>Hiện Trên Trang Chủ</td>
                <td>
                    <select name='occaFP' id='occaFP'>
                        <?php
function frontpageText($isFP)
{
    if ($isFP == 0) {
        return "Không";
    } else if ($isFP == 1) {
        return "Có";
    }
}
foreach ($data as $key => $r) {
    echo "
    <option value='" . $r['occa_fp'] . "'>" . frontpageText($r['occa_fp']) . "</option>
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
    <button class="btn btn-shop" name="btnOccaEdit" id="btnOccaEdit" type='submit'>
        Lưu
    </button>
    <a id="btnOccaEditLink" href='' hidden>
        Lưu
    </a>
</form>

</html>