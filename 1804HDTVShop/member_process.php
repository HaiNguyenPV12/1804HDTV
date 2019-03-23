<?php
include "../src/fconnectadmin.php";
session_start();
?>

    <?php
    include "../src/flowerdb.php";
    if (isset($_POST["cmdMember"])&& isset($_POST["memName"]) && isset($_POST["memEmail"]) && isset($_POST["memPhone"])&& isset($_POST["memAddress"])&& isset($_POST["memID"])&& isset($_POST["memPW"])) 
    {
        $memName = $_POST["memName"];
        $memEmail = $_POST["memEmail"];
        $memAddress = $_POST["memAddress"];
        $memPhone = $_POST["memPhone"];
        $memID = $_POST["memID"];
        $memPW = $_POST["memPW"];

        $udata = getSql("select * from member where mem_uID = '$memID'");
        if(sizeof($udata)>0)
        {
            echo "ID này đã tồn tại không thể đăng ký";
            exit();
        }
        else
        {
            $mcdata = getSql("select cus_ID from customer where cus_phone = '$memPhone'");
            if (sizeof($mcdata)>0) 
            {
                $cusID = $mcdata[0]['cus_ID'];
                $cdata = getSql("Select * from member where cus_ID = '$cusID'");
                if(sizeof($cdata)>0)
                {
                    echo "ok";
                }
                else
                {
                    $nsql = insertSql("insert into member values(null,'$memID','$memPW','$cusID')");
                }
                
                
            }
            else
            {
                $sql = insertSql("insert into customer values(null,'$memPhone','$memName','$memAddress','$memEmail')");
                $data = getSql("select cus_ID from customer where cus_phone = '$memPhone'");
                $cusID = $data[0]['cus_ID'];
                $nsql = insertSql("insert into member values(null,'$memID','$memPW','$cusID')");
                echo "ok";
            }
        }
            
    }
    else
    {
        echo "Thiếu dữ kiện";
    }           

   
   
?>

    