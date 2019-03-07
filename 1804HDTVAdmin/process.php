<?php
//kiểm tra cmdAdd
if (isset($_POST['cmdAddFlower'])) {
    //kiểm tra các dữ liệu bên form Add
    if (isset($_POST['fid']) && isset($_POST['fname']) && isset($_POST['fcate']) && isset($_POST['fimg'])&& isset($_POST['fdetail'])) {
        $fid = $_POST['fid'];
        $fname = $_POST['fname'];
        $fcate = $_POST['fcate'];
        $fimg = $_POST['fimg'];
        $fdetail = $_POST['fdetail'];
        include '../src/flowerdb.php';
        $insert = insertSql("insert into flower values ('$fid','$fcate','$fname','$fimg','$fdetail')");

        $imageFileType = strtolower(pathinfo($fimg,PATHINFO_EXTENSION));
        $dir1 = "./../tmp/".$fid.".".$imageFileType;
        $dir2 = "./../../1804HDTV/".$fimg;
        // Check folder
        if (!file_exists("./../../1804HDTV/img/Flower/".$fid)) {
            mkdir("./../../1804HDTV/img/Flower/".$fid, 0777, true);
        }
        rename($dir1, $dir2);

        echo "ok";
    }else{
        echo "no";
    }
}else if (isset($_POST['cmdDelete'])) {
    if (isset($_POST['bid'])) {
        $sitedir = "./../../1804HDTV/";
        $bid = $_POST['bid'];
        include '../src/flowerdb.php';
        $imgdata = getSql("Select * from bouq_img where b_ID = '$bid'");
        $fdata = getSql("Select * from bouq_detail where b_ID = '$bid'");
        if (sizeof($fdata)>0) {
            deleteSql("delete from bouq_detail where b_ID = '$bid'");
        }
        if (sizeof($imgdata)>0) {
            foreach ($imgdata as $key => $img) {
                if (file_exists($sitedir.$img['b_img'])) {
                    unlink($sitedir.$img['b_img']);
                }
            }
            deleteSql("delete from bouq_img where b_ID = '$bid'");
        }
        if (file_exists($sitedir."/img/Bouquet/".$bid)) {
            rmdir($sitedir."/img/Bouquet/".$bid);
        }
        $delete = deleteSql("delete from bouquet where b_ID ='$bid'");
        echo "ok";
    }else if (isset($_POST['bimgid'])) {
        $bimgid = $_POST['bimgid'];
        include '../src/flowerdb.php';
        $deleteDir = (getSql("select * from bouq_img where b_img_ID ='$bimgid'"))[0]["b_img"];
        $delete = deleteSql("delete from bouq_img where b_img_ID ='$bimgid'");
        if ($delete) {
            if (unlink("./../../1804HDTV/".$deleteDir)) {
                echo "ok";
            }else{
                echo "lỗi xóa file trên server";
            }   
        }else{
            echo "lỗi sql";
        }
    }else if (isset($_POST['fid'])) {
        $fid = $_POST['fid'];
        include '../src/flowerdb.php';
        $existed = getSql("SELECT * FROM bouq_detail where f_ID = '$fid'");
        $img = getSql("SELECT f_img from flower where f_ID = '$fid'")[0];
        if (sizeof($existed)>0) {
            deleteSql("DELETE FROM bouq_detail where f_ID = '$fid'");
        }
        $delete = deleteSql("delete from flower where f_ID ='$fid'");
        if (unlink("./../../1804HDTV/".$img['f_img'])) {
            rmdir("./../../1804HDTV/img/Flower/".$fid);
        }
        echo "ok";

    }else if (isset($_POST['roleid'])) {
        $roleid = $_POST['roleid'];
        include '../src/staffdb.php';
        if (sizeof(getSql("select * from staff where s_role_ID = '$roleid'"))>0) {
            echo "<h3>Vẫn còn người giữ chức vụ này nên không thể xóa được!<br>Hãy chắc chắn rằng không ai còn giữ chức vụ này mới xóa được.</h3>";
            exit;
        } 
        if (sizeof(getSql("select * from right_detail where s_role_ID = '$roleid'"))>0) {
            deleteSql("DELETE FROM right_detail where s_role_ID = '$roleid'");
        }
        $delete = deleteSql("delete from staff_role where s_role_ID ='$roleid'");
        if ($delete) {
            echo "ok";
        }else{
            echo "lỗi sql";
        }
    }else{
        echo "Không có id";
    }
}else if (isset($_POST['cmdEditFlower'])) {
    if (isset($_POST['fid_old']) && isset($_POST['fimg_old']) && isset($_POST['fid']) && isset($_POST['fname']) && isset($_POST['fcate']) && isset($_POST['fimg']) && isset($_POST['fdetail'])) {
        $sitedir = "./../../1804HDTV/";
        $fid_old = $_POST['fid_old'];
        $fimg_old = $_POST['fimg_old'];
        $fid = $_POST['fid'];
        $fname = $_POST['fname'];
        $fcate = $_POST['fcate'];
        $fimg = $_POST['fimg'];
        $fdetail = $_POST['fdetail'];

        include '../src/flowerdb.php';
        // Xử lý dữ liệu thông tin hoa
        // Nếu ID hoa như cũ thì khỏe, chỉ cần update nó
        if ($fid_old==$fid) {
            updateSql("update flower set f_name='$fname',f_cate_ID='$fcate', f_img='$fimg', f_detail='$fdetail' where f_ID='$fid_old'");
        }else{
        // Nếu ID hoa thay đổi, cần chú ý những thứ có dùng đến ID hoa
            // Lấy dữ liệu hoa có trong bó
            $existed = getSql("Select * from bouq_detail where f_ID = '$fid_old'");
            // Lấy dữ liệu hoa có trong màu
            $cexisted = getSql("Select * from flower_color_detail where f_ID='$fid_old'");

            // Đầu tiên phải insert dữ liệu với ID hoa mới, để update các bảng kia không bị lỗi foreign key
            insertSql("insert into flower values('$fid','$fcate', '$fname','$fimg', '$fdetail')"); 
            // Cập nhật hoa trong bó
            if (sizeof($existed)>0) {
                updateSql("update bouq_detail set f_ID='$fid' where f_ID = '$fid_old'");
            }
            //updateSql("update flower set f_ID = '$fid', f_name='$fname',f_cate_ID='$fcate', f_img='$fimg', f_detail='$fdetail' where f_ID='$fid_old'");
            // Cập nhật màu trong hoa
            if (sizeof($cexisted)>0) {
                updateSql("update flower_color_detail set f_ID = '$fid' where f_ID='$fid_old'");
            }
            // Cuối cùng là xóa hoa với ID cũ
            deleteSql("delete from flower where f_ID = '$fid_old'");

        } 

        // Tới dữ liệu hình
        // Kiểm tra xem file hình có thay đổi kg
        if (isset($_POST['fimgfile'])) {
        // Nếu có thì
            // Khởi tạo đường dẫn file hình đã upload lên folder tạm và đường dẫn mới
            $imageFileType = strtolower(pathinfo($fimg,PATHINFO_EXTENSION));
            $tempimg = $_POST['tempimg'];
            $dir1 = "./.".$tempimg;
            $dir2 = $sitedir.$fimg;
            // Kiểm tra và tạo folder ở đích đến
            if (!file_exists($sitedir."img/Flower/".$fid)) {
                mkdir($sitedir."img/Flower/".$fid, 0777, true);
            }
            // Di chuyển vào
            rename($dir1, $dir2);

            // Nếu ID thay đổi, có khả năng folder cũ vẫn tồn tại, nên xóa nó đi
            if ($fid!=$fid_old) {
                // Kiểm tra xem file có tồn tại không
                if (file_exists($sitedir.$fimg_old)) {
                    // Tồn tại thì xóa
                    if (unlink($sitedir.$fimg_old)) {
                        rmdir($sitedir."img/Flower/".$fid_old); 
                    }
                }else{
                // Dù file không tồn tại cũng kiểm tra xem folder tồn tại không
                    if (file_exists($sitedir."img/Flower/".$fid_old)) {
                        rmdir($sitedir."img/Flower/".$fid_old);
                    }
                }
            } 
        }else{
        // Nếu file hình kg thay đổi
        // Nếu ID không thay đổi, nghĩa là đường dẫn vẫn như cũ, folder vẫn như cũ
            // Nếu ID thay đổi
            if ($fid!=$fid_old) {
                // Di chuyển file hình sang folder mới
                // Thiết lập đường dẫn
                $dir1 = $sitedir.$fimg_old;
                $dir2 = $sitedir.$fimg;
                // Đầu tiên kiểm tra file hình cũ có hay không
                if (file_exists($sitedir.$fimg_old)) {
                    // Tạo folder ở đích đến trước nếu chưa có
                    if (!file_exists($sitedir."img/Flower/$fid")) {
                        mkdir($sitedir."img/Flower/$fid", 0777, true);
                    }
                    // Di chuyển
                    rename($dir1, $dir2);
                    // Xóa folder cũ
                    if (file_exists($sitedir."img/Flower/$fid_old")) {
                        rmdir($sitedir."img/Flower/$fid_old");
                    }         
                }else{
                // Nếu file không tồn tại 
                    // thì cũng kiểm tra xem folder tồn tại hay không
                    if (file_exists($sitedir."img/Flower/$fid_old")) {
                        rmdir($sitedir."img/Flower/$fid_old");
                    } 
                }
            }
        }
        
        echo "ok";
    }else{
        echo "no";
    }
}else if (isset($_POST['cmdAddBouquet'])) {
    if (isset($_POST['bid']) && isset($_POST['bname']) && isset($_POST['bprice']) && isset($_POST['bdetail'])) {
        include '../src/flowerdb.php';
        $bid = $_POST['bid'];
        $bname = $_POST['bname'];
        $bprice = $_POST['bprice'];
        $bdetail = $_POST['bdetail'];
        $bselling = 1;
        if (isset($_POST['bselling'])) {
            $bselling = 1;
        }else {
            $bselling = 0;
        }
        $insert = insertSql("insert into bouquet values ('$bid','$bname','$bdetail',$bprice, $bselling)");
        if ($insert) {
            echo "ok";
        }else{
            echo "error";
        }
    }else{
        echo "not enough";
    }
}else if (isset($_POST['cmdEditBouquet'])) {
    if (isset($_POST['bid']) && isset($_POST['bname']) && isset($_POST['bprice']) && isset($_POST['bdetail'])) {
        include '../src/flowerdb.php';
        $bid = $_POST['bid'];
        $bname = $_POST['bname'];
        $bprice = $_POST['bprice'];
        $bdetail = $_POST['bdetail'];
        if (isset($_POST['bselling'])) {
            $bselling = 1;
        }else {
            $bselling = 0;
        }
        $update = updateSql("update bouquet set b_name = '$bname', b_detail = '$bdetail', b_price = $bprice, b_selling = $bselling where b_ID = '$bid'");
        if ($update) {
            echo "ok";
        }else{
            echo "<h2>Không có thay đổi!</h2>";
        }
    }else{
        echo "not enough";
    }
}else if (isset($_POST['cmdEditFBouquet'])) {
    if (isset($_POST['bid'])) {
        include '../src/flowerdb.php';
        $bid = $_POST['bid'];
        if (sizeof(getSql("SELECT * FROM bouq_detail WHERE b_ID='$bid'"))>0) {
            $delete = deleteSql("DELETE FROM bouq_detail WHERE b_ID = '$bid'");
        }
        if (isset($_POST['fdata'])) {
            foreach ($_POST["fdata"] as $key => $fdata) {
                $data = preg_split('/:/',$fdata);
                $insert = insertSql("INSERT INTO bouq_detail VALUES (null, '$bid','".$data[0]."',".$data[1].")");
            }
        }
        echo "ok";
    }else{
        echo "not enough";
    }
}else if (isset($_POST["cmdLogin"])) {
    if (isset($_POST["id"]) && isset($_POST["pw"])) {
        $id = $_POST["id"];
        $pw = $_POST["pw"];
        include '../src/staffdb.php';
        $get = getSql("SELECT * from staff where s_u_ID='$id' and s_u_PW='$pw'");
        if (sizeof($get)>0) { 
            session_start();
            $_SESSION["uID"]=$id;
            $_SESSION["uName"]=$get[0]['s_name'];
            $_SESSION["sRole"]=$get[0]['s_role_ID'];
            $rights = getSql("SELECT * from right_detail where s_role_ID = '".$_SESSION['sRole']."'");
            $_SESSION["sRight"]=array_column($rights, 'right_ID');
            $_SESSION["loggedin"]=true;
            echo "ok";
        }else{
            echo "error";
        }
    }
}else if (isset($_POST["cmdEditRoleR"])) {
    if (isset($_POST['roleid'])) {
        include '../src/staffdb.php';
        $roleid = $_POST['roleid'];
        if (sizeof(getSql("SELECT * from right_detail where s_role_ID = '$roleid'"))>0) {
            $delete = deleteSql("DELETE FROM right_detail WHERE s_role_ID = '$roleid'");
            if (!$delete) {
                echo "error";
            }
        }
        if (isset($_POST['rdata'])) {
            foreach ($_POST["rdata"] as $key => $rdata) {
                $insert = insertSql("INSERT INTO right_detail VALUES ('$roleid','$rdata',1)");
            }
            if ($insert) {
                echo "ok";
            }
        }else{
            echo "ok";
        }  
    }else{
        echo "not enough";
    }
}else if (isset($_POST['cmdAddRole'])) {
    if (isset($_POST['roleid']) && isset($_POST['rolename']) && isset($_POST['roledetail'])) {
        include '../src/staffdb.php';
        $roleid = $_POST['roleid'];
        $rolename = $_POST['rolename'];
        $roledetail = $_POST['roledetail'];
        $insert = insertSql("insert into staff_role values ('$roleid','$rolename','$roledetail')");
        if ($insert) {
            echo "ok";
        }else{
            echo "error";
        }
    }else{
        echo "not enough";
    }
}else if (isset($_POST['cmdEditRole'])) {
    if (isset($_POST['roleidold']) && isset($_POST['roleid']) && isset($_POST['rolename']) && isset($_POST['roledetail'])) {
        include '../src/staffdb.php';
        $roleid = $_POST['roleid'];
        $rolename = $_POST['rolename'];
        $roleidold = $_POST['roleidold'];
        $roledetail = $_POST['roledetail'];

        if ($roleid!=$roleidold) {
            $insert = updateSql("INSERT into staff_role values ('$roleid', '$rolename','$roledetail')");
            if (sizeof(getSql("select * from right_detail where s_role_ID = '$roleidold'"))>0) {
                $updateright = updateSql("update right_detail set s_role_ID = '$roleid' where s_role_ID = '$roleidold'");
            }
            if (sizeof(getSql("select * from staff where s_role_ID = '$roleidold'"))>0) {
                $updatestaff = updateSql("update staff set s_role_ID = '$roleid' where s_role_ID = '$roleidold'");
            }    
            $delete = deleteSql("DELETE FROM staff_role where s_role_ID = '$roleidold'");
            echo "ok";
        }else{
            $update = updateSql("update staff_role set s_role_name = '$rolename', s_role_detail = '$roledetail' where s_role_ID = '$roleidold'");
            echo "ok";
        }
    }else{
        echo "not enough";
    }
}else if (isset($_POST["cmdFlowerColor"])) {
    if (isset($_POST['fid'])) {
        include '../src/flowerdb.php';
        $fid = $_POST['fid'];
        if (sizeof(getSql("SELECT * from flower_color_detail where f_ID = '$fid'"))>0) {
            $delete = deleteSql("DELETE FROM flower_color_detail WHERE f_ID = '$fid'");
            if (!$delete) {
                echo "error";
            }
        }
        if (isset($_POST['cdata'])) {
            foreach ($_POST["cdata"] as $key => $cdata) {
                $insert = insertSql("INSERT INTO flower_color_detail VALUES (null,'$fid','$cdata')");
            }
            echo "ok";
        }else{
            echo "ok";
        }  
    }else{
        echo "not enough";
    }
}else{
    echo 'not have cmd';
}
?>