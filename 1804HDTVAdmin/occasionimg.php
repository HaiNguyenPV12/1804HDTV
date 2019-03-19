<html>

<body>
<button class='btn btn-shop'>
    <a href="#!occasion/">
        Về Trang Bó
    </a>
</button>
<?php
include '../src/flowerdb.php';
$id = $_GET['bid'];
$data = getSql("SELECT * from occasion where occa_ID = '$id'");
foreach ($data as $key => $r) {
    echo $r['occa_img'];
    echo "<div class='py-0'></div>";
    echo '<input type="file" name="fileToUpload" id="fileToUpload">';
}
?>
</body>

</html>