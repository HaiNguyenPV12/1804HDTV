<?php
// Trang xử lý hình ảnh

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
$target_file_name= $_POST["bimg"];
$target_file = $target_dir . $target_file_name;
//echo $_FILES["fimgfile"]["tmp_name"];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$tmp_dir = "./tmp/".$_POST["bimgid"].".".$imageFileType;
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["bimgfile"]["tmp_name"]);
if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    echo "Tập tin không phải hình ảnh.<br>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["bimgfile"]["size"] > 5000000) {
    echo "Tập tin quá lớn. (phải nhỏ hơn 5mb)<br>";
    $uploadOk = 0;
}

if (isset($_POST['cmdImgUpload'])) {
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Có vấn đề khi tải lên!<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["bimgfile"]["tmp_name"], ".".$tmp_dir)) {
            echo "<img src=".$tmp_dir." style='max-width:70vh'></img>";
            echo "<input type='hidden' value='$target_file'>";
        } else {
            echo "Có vấn đề khi tải lên!";
        }
    }
}else if (isset($_POST['cmdImgAdd'])){
     // Check if file already exists
     if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        //$uploadOk = 0;
        unlink($target_file);
    }

    // Check folder
    if (!file_exists($target_dir."img/Bouquet/".$_POST["bid"])) {
        mkdir($target_dir."img/Bouquet/".$_POST["bid"], 0777, true);
    }

    if (move_uploaded_file($_FILES["bimgfile"]["tmp_name"], $target_file)) {
        include "../src/flowerdb.php";
        $insert = insertSql("insert into bouq_img values('".$_POST["bimgid"]."','".$_POST["bid"]."','".$_POST["bimg"]."')");
        if ($insert) {
            echo "ok";
        }else{
            echo "error";
        }
    } else {
        echo "Có vấn đề khi tải lên!";
    }
}else if (isset($_POST['cmdImgEdit'])) {
    // Check if file already exists
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        //$uploadOk = 0;
        unlink($target_file);
    }
    // Check folder
    if (!file_exists($target_dir."img/Bouquet/".$_POST["bid"])) {
        mkdir($target_dir."img/Bouquet/".$_POST["bid"], 0777, true);
    }
    if (move_uploaded_file($_FILES["bimgfile"]["tmp_name"], $target_file)) {
        echo "ok";
    } else {
        echo "Có vấn đề khi tải lên!";
    }

}else{
    echo "no";
}

?>