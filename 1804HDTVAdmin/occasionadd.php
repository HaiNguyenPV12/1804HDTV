<html>
<script src="../Scripts/1804HDTVAdmin/occaadd.js"></script>
<?php
include '../src/flowerdb.php';
include '../src/fconnectadmin.php';
$data = getSql("SELECT * from occasion");
?>
<button class='btn btn-shop'>
    <a href="#!occasion/">
        Về Trang Dịp
    </a>
</button>

<div class='py-1'></div>
<form name='occaAddForm' id='occaAddForm'>
    <table class='table table-hover table-bordered'>
        <tbody>
            <tr>
                <td>ID</td>
                <td>
                    <input name='occaID' required id='occaID' type='text' value=''>
                </td>
            </tr>
            <tr>
                <td>Tên Dịp</td>
                <td>
                    <input type='text' required name='occaName' id='occaName'>
                </td>
            </tr>
            <tr>
                <td>Chi Tiết Dịp</td>
                <td>
                    <textarea required name='occaDetail' id='occaDetail' placeholder='Nhập Thông Tin'>
                        </textarea>
                </td>
            </tr>
            <tr>
                <td>Hiện Trên Trang Chủ</td>
                <td>
                    <select name='occaFP' id='occaFP'>
                        <option value='0' disabled selected='selected'>Không</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-shop" name="btnOccaAdd" id="btnOccaAdd" type='submit'>
        Lưu
    </button>
    <a id="btnOccaAddLink" href='' hidden>
        Lưu
    </a>
</form>

</html>