<?php
    
    require("../src/flowerdb.php");

    mysql_query("delete from comment where cm_id");

    mysql_close($conn);

    header("location:list_comment.php");
    exit();
?>