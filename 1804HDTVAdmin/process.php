<?php
// Đây là trang xử lý tập trung tất cả các lệnh liên quan tới cơ sở dữ liệu

// Trang thêm hoa
if (isset($_POST['cmdAddFlower'])) {
    // Kiểm tra các dữ liệu bên form Add
    if (isset($_POST['fid']) && isset($_POST['fname']) && isset($_POST['fcate']) && isset($_POST['fimg'])&& isset($_POST['fdetail'])) {
        $fid = $_POST['fid'];
        $fname = $_POST['fname'];
        $fcate = $_POST['fcate'];
        $fimg = $_POST['fimg'];
        $fdetail = $_POST['fdetail'];
        include '../src/flowerdb.php';

        // Insert dữ liệu
        insertSql("insert into flower values ('$fid','$fcate','$fname','$fimg','$fdetail')");

        $imageFileType = strtolower(pathinfo($fimg,PATHINFO_EXTENSION));
        // Đường dẫn file tạm
        $dir1 = "tmp/".$fid.".".$imageFileType;
        // Đường dẫn file đích
        $dir2 = "../".$fimg;
        // Kiểm tra và tạo folder ở đích đến
        if (!file_exists("../img/Flower/".$fid)) {
            mkdir("../img/Flower/".$fid, 0777, true);
        }
        // Lệnh rename cũng có tác dụng chuyển file sang directory khác
        rename($dir1, $dir2);

        echo "ok";
    }else{
        echo "no";
    }
// Trang xóa chung
}else if (isset($_POST['cmdDelete'])) {
    // Nếu là xóa bó hoa thì sẽ nhận biết bằng bID
    if (isset($_POST['bid'])) {
        // Thiết lập đường dẫn đến site gốc
        $sitedir = "../";
        $bid = $_POST['bid'];
        include '../src/flowerdb.php';
        // Lấy dữ liệu hình của bó hoa này
        $imgdata = getSql("Select * from bouq_img where b_ID = '$bid'");
        // Lấy dữ liệu hoa có trong bó hoa này
        $fdata = getSql("Select * from bouq_detail where b_ID = '$bid'");

        // Nếu có hoa trong bó hoa này thì thực hiện lệnh xóa
        if (sizeof($fdata)>0) {
            deleteSql("delete from bouq_detail where b_ID = '$bid'");
        }
        // Nếu có hình trong bó hoa này
        if (sizeof($imgdata)>0) {
            // Thực hiện xóa file trước
            foreach ($imgdata as $key => $img) {
                if (file_exists($sitedir.$img['b_img'])) {
                    unlink($sitedir.$img['b_img']);
                }
            }
            // Rồi xóa trong CSDL
            deleteSql("delete from bouq_img where b_ID = '$bid'");
        }
        // Gỡ luôn folder
        if (file_exists($sitedir."/img/Bouquet/".$bid)) {
            rmdir($sitedir."/img/Bouquet/".$bid);
        }
        // Cuối cùng là xóa bó hoa
        $delete = deleteSql("delete from bouquet where b_ID ='$bid'");
        echo "ok";
    // Nếu xóa hình trong bó hoa thì nhận biết bằng bimgid
    }else if (isset($_POST['bimgid'])) {
        $bimgid = $_POST['bimgid'];
        include '../src/flowerdb.php';
        // thiết lập đường dẫn file hình
        $deleteDir = (getSql("select * from bouq_img where b_img_ID ='$bimgid'"))[0]["b_img"];
        // Xóa dữ liệu trên CSDL
        $delete = deleteSql("delete from bouq_img where b_img_ID ='$bimgid'");
        if ($delete) {
            // Xóa file hình
            if (unlink("../".$deleteDir)) {
                echo "ok";
            }else{
                echo "lỗi xóa file trên server";
            }   
        }else{
            echo "lỗi sql";
        }
    // Néu xóa hoa
    }else if (isset($_POST['fid'])) {
        $fid = $_POST['fid'];
        include '../src/flowerdb.php';
        // Lấy dữ liệu hoa này có trong các bó hoa hay không
        $existed = getSql("SELECT * FROM bouq_detail where f_ID = '$fid'");
        // Lấy đường dẫn file hình
        $img = getSql("SELECT f_img from flower where f_ID = '$fid'")[0];

        // Nếu hoa này có trong các bó hoa thì thực hiện xóa dữ liệu đó trước
        if (sizeof($existed)>0) {
            deleteSql("DELETE FROM bouq_detail where f_ID = '$fid'");
        }
        // Sau đó là thực hiện xóa trong CSDL
        deleteSql("delete from flower where f_ID ='$fid'");

        // Cuối cùng là xóa file hình
        if (file_exists("../".$img['f_img'])) {
            if (unlink("../".$img['f_img'])) {
                rmdir("../img/Flower/".$fid);
            }else{
                if (file_exists("../img/Flower/".$fid)) {
                    rmdir("../img/Flower/".$fid);
                }
            }
        }
        
        echo "ok";
    // Nếu là xóa chức vụ thì dựa vào roleid
    }else if (isset($_POST['roleid'])) {
        $roleid = $_POST['roleid'];
        include '../src/staffdb.php';
        // Kiểm tra xem còn người giữ chức vụ này hay không
        if (sizeof(getSql("select * from staff where s_role_ID = '$roleid'"))>0) {
            // Nếu có thì cảnh báo và không thực hiện lệnh nào nữa
            echo "<h3>Vẫn còn người giữ chức vụ này nên không thể xóa được!<br>Hãy chắc chắn rằng không ai còn giữ chức vụ này mới xóa được.</h3>";
            exit;
        }
        // Nếu không có người nào giữ chức vụ này thì
        // Đầu tiên là xóa các quyền có trong chức vụ này trước
        if (sizeof(getSql("select * from right_detail where s_role_ID = '$roleid'"))>0) {
            deleteSql("DELETE FROM right_detail where s_role_ID = '$roleid'");
        }
        // Sau đó mới xóa chức vụ này
        $delete = deleteSql("delete from staff_role where s_role_ID ='$roleid'");
        echo "ok";
    }else{
        echo "Không có id";
    }
// Trang chỉnh sửa hoa
}else if (isset($_POST['cmdEditFlower'])) {
    if (isset($_POST['fid_old']) && isset($_POST['fimg_old']) && isset($_POST['fid']) && isset($_POST['fname']) && isset($_POST['fcate']) && isset($_POST['fimg']) && isset($_POST['fdetail'])) {
        $sitedir = "../";
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
        // Nếu ID hoa thay đổi, cần chú ý những thứ có liên quan đến ID hoa
            // Lấy dữ liệu hoa có trong bó
            $existed = getSql("Select * from bouq_detail where f_ID = '$fid_old'");
            // Lấy dữ liệu màu có trong hoa
            $cexisted = getSql("Select * from flower_color_detail where f_ID='$fid_old'");

            // Đầu tiên phải insert dữ liệu với ID hoa mới, để update các bảng kia không bị lỗi foreign key
            insertSql("insert into flower values('$fid','$fcate', '$fname','$fimg', '$fdetail')"); 
            // Cập nhật hoa trong bó
            if (sizeof($existed)>0) {
                updateSql("update bouq_detail set f_ID='$fid' where f_ID = '$fid_old'");
            }
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
            $dir1 = $tempimg;
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
// Trang thêm bó hoa
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
        insertSql("insert into bouquet values ('$bid','$bname','$bdetail',$bprice, $bselling)");
        echo "ok";
    }else{
        echo "not enough";
    }
// Trang chỉnh sửa bó hoa
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
        updateSql("update bouquet set b_name = '$bname', b_detail = '$bdetail', b_price = $bprice, b_selling = $bselling where b_ID = '$bid'");
        echo "ok";
    }else{
        echo "not enough";
    }
// Trang chỉnh sửa hoa có trong bó
}else if (isset($_POST['cmdEditFBouquet'])) {
    if (isset($_POST['bid'])) {
        include '../src/flowerdb.php';
        $bid = $_POST['bid'];
        // Kiểm tra xem dữ liệu hoa có trong bó này có chưa
        if (sizeof(getSql("SELECT * FROM bouq_detail WHERE b_ID='$bid'"))>0) {
            // Có thì xóa
            $delete = deleteSql("DELETE FROM bouq_detail WHERE b_ID = '$bid'");
        }
        // Nếu có dữ liệu hoa mới thì insert
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
// Trang đăng nhập
}else if (isset($_POST["cmdLogin"])) {
    if (isset($_POST["id"]) && isset($_POST["pw"])) {
        $id = $_POST["id"];
        $pw = $_POST["pw"];
        include '../src/staffdb.php';
        $get = getSql("SELECT * from staff where s_u_ID='$id' and s_u_PW='$pw'");
        // Nếu có dữ liệu thì bắt đầu cho trạng thái đăng nhập
        if (sizeof($get)>0) { 
            session_start();
            // ID
            $_SESSION["uID"]=$id;
            // tên
            $_SESSION["uName"]=$get[0]['s_name'];
            // Chức vụ
            $_SESSION["sRole"]=$get[0]['s_role_ID'];
            // Đưa chức vụ thành mảng, để dễ dàng lấy ra
            $rights = getSql("SELECT * from right_detail where s_role_ID = '".$_SESSION['sRole']."'");
            $_SESSION["sRight"]=array_column($rights, 'right_ID');
            // Trạng thái đăng nhập
            $_SESSION["loggedin"]=true;
            echo "ok";
        }else{
            echo "error";
        }
    }
// Trang chỉnh sửa quyền trong chức vụ
}else if (isset($_POST["cmdEditRoleR"])) {
    if (isset($_POST['roleid'])) {
        include '../src/staffdb.php';
        $roleid = $_POST['roleid'];
        // Xóa các quyền cũ
        if (sizeof(getSql("SELECT * from right_detail where s_role_ID = '$roleid'"))>0) {
            deleteSql("DELETE FROM right_detail WHERE s_role_ID = '$roleid'");
        }
        // Đưa các quyền mới vào
        if (isset($_POST['rdata'])) {
            foreach ($_POST["rdata"] as $key => $rdata) {
                $insert = insertSql("INSERT INTO right_detail VALUES (null, '$roleid','$rdata',1)");
            }
            echo "ok";
        }else{
            echo "ok";
        }  
    }else{
        echo "not enough";
    }
// Trang thêm chức vụ
}else if (isset($_POST['cmdAddRole'])) {
    if (isset($_POST['roleid']) && isset($_POST['rolename']) && isset($_POST['roledetail'])) {
        include '../src/staffdb.php';
        $roleid = $_POST['roleid'];
        $rolename = $_POST['rolename'];
        $roledetail = $_POST['roledetail'];
        insertSql("insert into staff_role values ('$roleid','$rolename','$roledetail')");
        echo "ok";
    }else{
        echo "not enough";
    }
// Trang chỉnh sửa chức vụ
}else if (isset($_POST['cmdEditRole'])) {
    if (isset($_POST['roleidold']) && isset($_POST['roleid']) && isset($_POST['rolename']) && isset($_POST['roledetail'])) {
        include '../src/staffdb.php';
        $roleid = $_POST['roleid'];
        $rolename = $_POST['rolename'];
        $roleidold = $_POST['roleidold'];
        $roledetail = $_POST['roledetail'];
        // Nếu ID của chức vụ có thay đổi
        if ($roleid!=$roleidold) {
            // Đầu tiên là insert dữ liệu mới, để khi cập nhật các bảng liên quan không bị lỗi do foreign key
            insertSql("INSERT into staff_role values ('$roleid', '$rolename','$roledetail')");
            // Nếu có dữ liệu bên bảng quyền có trong chức vụ thì update nó
            if (sizeof(getSql("select * from right_detail where s_role_ID = '$roleidold'"))>0) {
                updateSql("update right_detail set s_role_ID = '$roleid' where s_role_ID = '$roleidold'");
            }
            // Nếu có dữ liệu bên bảng nhân viên thì update nó
            if (sizeof(getSql("select * from staff where s_role_ID = '$roleidold'"))>0) {
                updateSql("update staff set s_role_ID = '$roleid' where s_role_ID = '$roleidold'");
            }
            // Xóa dữ liệu cũ
            deleteSql("DELETE FROM staff_role where s_role_ID = '$roleidold'");
            echo "ok";
        }else{
            $update = updateSql("update staff_role set s_role_name = '$rolename', s_role_detail = '$roledetail' where s_role_ID = '$roleidold'");
            echo "ok";
        }
    }else{
        echo "not enough";
    }
// Trang chỉnh sửa màu cho hoa
}else if (isset($_POST["cmdFlowerColor"])) {
    if (isset($_POST['fid'])) {
        include '../src/flowerdb.php';
        $fid = $_POST['fid'];
        // Kiểm tra xem hoa này có dữ liệu màu chưa, có thì xóa 
        if (sizeof(getSql("SELECT * from flower_color_detail where f_ID = '$fid'"))>0) {
            deleteSql("DELETE FROM flower_color_detail WHERE f_ID = '$fid'");
        }
        // Insert dữ liệu màu mới vào
        if (isset($_POST['cdata'])) {
            foreach ($_POST["cdata"] as $key => $cdata) {
                insertSql("INSERT INTO flower_color_detail VALUES (null,'$fid','$cdata')");
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