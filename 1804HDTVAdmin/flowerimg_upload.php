<!-- Trang xử lý upload hình ảnh -->

<?php
/*
echo basename($_FILES["fimgfile"]["name"]);
//echo $_POST["fimgid"];
$imageFileType = strtolower(pathinfo(basename($_FILES["fimgfile"]["name"]),PATHINFO_EXTENSION));
echo $imageFileType;
$data = $_FILES["fimgfile"];
foreach ($data as $key => $value) {
    echo $key." : ".$value."<br>";
}
*/

$target_dir = "./../../1804HDTV/";
$target_file_name= $_POST["fimg"];
$target_file = $target_dir . $target_file_name;
//echo $_FILES["fimgfile"]["tmp_name"];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$tmp_dir = "./tmp/".$_POST["fid"].".".$imageFileType;
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["fimgfile"]["tmp_name"]);
if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    echo "Tập tin không phải hình ảnh.<br>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fimgfile"]["size"] > 5000000) {
    echo "Tập tin quá lớn. (phải nhỏ hơn 5mb)<br>";
    $uploadOk = 0;
}

if (isset($_POST['cmdFImgUpload'])) {
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Có vấn đề khi tải lên!<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fimgfile"]["tmp_name"], ".".$tmp_dir)) {
            echo "<img src=".$tmp_dir." style='max-width:50vh'></img>";
            echo "<input type='hidden' value='$target_file'>";
        } else {
            echo "Có vấn đề khi tải lên!";
        }
    }
}else if (isset($_POST['cmdImgEdit'])) {
     // Check if $uploadOk is set to 0 by an error
     if ($uploadOk == 0) {
        echo "Có vấn đề khi tải lên!<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fimgfile"]["tmp_name"], ".".$tmp_dir)) {
            echo "<img id='tempimg' src=".$tmp_dir." style='max-width:50vh'></img>";
            echo "<input type='hidden' id='tempdir' name='tempdir' value='$tmp_dir'>";
        } else {
            echo "Có vấn đề khi tải lên!";
        }
    }

}else{
    echo "no";
}

?>