<?php
   $handle = opendir("../Scripts/1804HDTVShop/controllers/");

   while (($file = readdir($handle)) !== false) {
       echo '<script type="text/javascript" src="' . '../Scripts/1804HDTVShop/controllers/' . $file . '"></script>';
   }
   
   closedir($handle);
?>