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
<html>
<?php
include '../src/flowerdb.php';
$id = $_GET['bid'];
$data = getSql("SELECT * from occasion where occa_ID = '$id'");
?>

<body>
    <button class='btn btn-shop'>
        <a href="#!occasion/">
            Về Trang Bó
        </a>
    </button>
    <div class='py-4'></div>
    <!-- <form action="occaupload.php?occaID=" method="post" enctype="multipart/form-data"> -->
    <?php
echo "<form action='occaupload.php?occaID=$id' method='post' enctype='multipart/form-data'>";
?>
    <table class='table table-hover table-bordered table-sm text-center'>
        <tr>
            <td>IMG</td>
            <td>
                <?php
foreach ($data as $key => $r) {
    echo $r['occa_img'];
    echo "<div class='py-0'></div>";
}
?>
            </td>
        </tr>
        <tr>
            <td>
                Chọn Hình để upload (chỉ cho file .jpg):
            </td>
            <td>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload" name="submit">
            </td>
        </tr>

    </table>
    </form>
    <!-- <a href="http://localhost:8080/1804HDTV/1804HDTVAdmin/index.php#!/occasion">click</a> -->
</body>

</html>