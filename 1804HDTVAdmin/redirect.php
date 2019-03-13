<?php
    if (isset($_GET["bouquet"])) {
        //
        //header("Refresh:0; url=index.php");
        header("Location: bouquet.php");
        Header('Location: '.$_SERVER['PHP_SELF']);
    }
?>