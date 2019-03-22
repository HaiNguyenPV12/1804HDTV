<?php
include "../src/fconnectadmin.php";
session_start();
?>

    <!-- content -->
    <?php
    include "../src/flowerdb.php";
    if (isset($_GET["cmdMember"])&& isset($_GET["memName"]) && isset($_GET["memEmail"]) && isset($_GET["memPhone"])&& isset($_GET["memAddress"])&& isset($_GET["memID"])&& isset($_GET["memPW"])) 
    {
        $memName = $_GET["memName"];
        $memEmail = $_GET["memEmail"];
        $memAddress =$_GET["memAddress"];
        $memPhone = $_GET["memPhone"];
        $memID = $_GET["memID"];
        $memPW = $_GET["memPW"];
        
        $mcdata = getSql("select cus_ID from customer where cus_phone = '$memPhone'");
        if (sizeof($mcdata)>0) 
        {
            $cusID = $mcdata[0]['cus_ID'];
            $cdata = getSql("Select * from member where cus_ID = '$cusID'");
            if(sizeof($cdata)>0)
            {
                header ("location: member_login.php");
            }
            else
            {
                $sql = updateSql("update customer set cus_name = '$memName', cus_address= '$memAddress', cus_email ='$memEmail' where cus_phone = '$memPhone'");
                $nsql = insertSql("insert into member values(null,'$memID','$memPW','$cusID')");
                header ("location: member_login.php");
            }
            
            
        }
        else
        {
            $sql = insertSql("insert into customer values(null,'$memPhone','$memName','$memAddress','$memEmail')");
            $data = getSql("select cus_ID from customer where cus_phone = '$memPhone'");
            $cusID = $data[0]['cus_ID'];
            $nsql = insertSql("insert into member values(null,'$memID','$memPW','$cusID')");
            header ("location: member_login.php");
        }
        
    }
    else
    {
        echo "Thiếu dữ kiện";
    }           

   
   
?>

    