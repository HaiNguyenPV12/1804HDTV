<?php
    
?>
<!------------------------------------------------ content ------------------------------------->
<!------------------------------------------------ content ------------------------------------->
<!------------------------------------------------ content ------------------------------------->
<style>
.border-shop {
    border-color: #7c42bd !important;
}
.card-img-top{
    width: 100%;
    height: 250px;
    object-fit: cover;
}
.text-shop a{
    color: #7c43bd;
}

.card-caption{
    position:absolute;
    top:200px;
    width:100%;
    height:50px;
    background-color:rgba(220,220,220,0.7);
    padding-top:5px;
    font-size:23px;
    font-weight:400;
}
.card-caption a{
    color:#6d24c0;
}
.card{
    transition: 0.3s;
    transition-timing-function: ease;
}
.card:hover{
    margin-top:-10px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
}
</style>

<div class="container col-11 mt-3 mb-3">
    <?php
        include "../src/flowerdb.php";
        $sitedir="../";
        // -------------------------------------------- Chi tiết loại hoa ------------------------------------- //
        if (isset($_GET["fcate"])) {
            if ($_GET["fcate"]!="") {
                $fcateid = $_GET["fcate"];
                $flowerdata = getSql("SELECT * FROM flower,flower_cate WHERE flower.f_cate_ID=flower_cate.f_cate_ID AND flower.f_cate_ID = '$fcateid'");
                //  Nếu tìm không thấy hoa trong loại hoa này ------------------------------------------------ //
                if (sizeof($flowerdata)<=0) {
                    $f = getSql("SELECT * FROM flower_cate WHERE f_cate_ID = '$fcateid'")[0];
                    echo '<div class="row">
                            <div class="col">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                        <li class="breadcrumb-item"><a href="#!flowercate">Loại Hoa</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">'.$f["f_cate_name"].'</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>';

                    echo '<div class="row">';

                    echo '<div class="col-lg-2 mr-2 border" style="background-color:#ebdbfd">';
                    echo '<h3 class="my-3 text-center">Các loại hoa</h3>
                        <h1 class="my-3 text-center">'.$f["f_cate_name"].'</h1>';
                    if (file_exists($sitedir.$f["f_cate_img"])) {
                        $imgurl = $sitedir.$f["f_cate_img"];
                    }else{
                        $imgurl = $sitedir."img/undefined.jpg";
                    }
                    echo '<img src="../'.$imgurl.'" style="width:100%;border-radius:100%;">';
                    echo '<div class="mb-2 mt-4">'.nl2br($f["f_cate_detail"]).'</div>';
                    echo '</div>';

                    echo "<div class='col-lg-9 container text-center'>";
                    echo "  <h3>Loại hoa này chưa có trong shop hoặc đã hết</h3>";
                    echo "  <a href='#!flowercate'>Trở lại Danh sách Loại Hoa</a>";
                    echo "</div>";

                    echo "</div>";
                }else{
                // Nếu có hoa trong loại này, thì đầu tiên kiểm tra xem có bó nào chứa nó chưa ------------------------------- //
                    echo '<div class="row">
                            <div class="col">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                        <li class="breadcrumb-item"><a href="#!flowercate">Loại Hoa</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">'.$flowerdata[0]["f_cate_name"].'</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>';

                    echo '<div class="row">';
                    echo '<div class="col-lg-2 mr-2 border" style="background-color:#ebdbfd">';
                    echo '<h3 class="my-3 text-center">Các loại hoa</h3>
                        <h1 class="my-3 text-center">'.$flowerdata[0]["f_cate_name"].'</h1>';
                    if (file_exists($sitedir.$flowerdata[0]["f_cate_img"])) {
                        $imgurl = $sitedir.$flowerdata[0]["f_cate_img"];
                    }else{
                        $imgurl = $sitedir."img/undefined.jpg";
                    }
                    echo '<img src="../'.$imgurl.'" style="width:100%;border-radius:100%;">';
                    echo '<div class="mb-2 mt-4">'.nl2br($flowerdata[0]["f_cate_detail"]).'</div>';
                    echo '</div>';

                    echo '<div class="col-lg-10 row border bg-light">';
                    // In ra danh sách các hoa có bó trước
                    foreach ($flowerdata as $key => $fdata) {
                        $bexisted = getSql("SELECT * FROM bouq_detail WHERE f_ID = '".$fdata['f_ID']."'");
                        if (sizeof($bexisted)>0) {
                            if (file_exists($sitedir.$fdata["f_img"])) {
                                $fimgurl = $sitedir.$fdata["f_img"];
                            }else{
                                $fimgurl = $sitedir."img/undefined.jpg";
                            }
                            echo '<div class="col-lg-4 col-md-5 mb-3 mt-3">
                                    <div class="card h-80 border-primary border-shop">
                                        <a href="#!flower/'.$fdata["f_ID"].'"><img class="card-img-top custom" src="'.$fimgurl.'" alt=""></a>
                                        <div class="text-center card-caption" style="">
                                            <div class="card-title text-center">
                                                <a href="#!flower/'.$fdata["f_ID"].'" >'.$fdata["f_name"].'</a>
                                            </div>   
                                        </div>
                                        <a href="#!flower/'.$fdata["f_ID"].'" class="btn card-footer btn-shop">
                                            Xem các Bó có <br><h5>'.$fdata["f_name"].'</h5>
                                        </a>
                                    </div>
                                </div>';
                        }    
                    }

                    // Sau đó in ra danh sách các hoa chưa có bó
                    foreach ($flowerdata as $key => $fdata) {
                        $bexisted = getSql("SELECT * FROM bouq_detail WHERE f_ID = '".$fdata['f_ID']."'");
                        if (sizeof($bexisted)<=0) {
                            if (file_exists($sitedir.$fdata["f_img"])) {
                                $fimgurl = $sitedir.$fdata["f_img"];
                            }else{
                                $fimgurl = $sitedir."img/undefined.jpg";
                            }
                            echo '<div class="col-lg-4 col-md-5 mb-3 mt-3">
                                    <div class="card h-80 border-primary border-shop">
                                        <a href="#!flower/'.$fdata["f_ID"].'"><img class="card-img-top custom" src="'.$fimgurl.'" alt=""></a>
                                        <div class="text-center card-caption" style="">
                                            <div class="card-title text-center">
                                                <a href="#!flower/'.$fdata["f_ID"].'" >'.$fdata["f_name"].'</a>
                                            </div>   
                                        </div>
                                        <a class="btn card-footer btn-secondary" style="border:none;">
                                            Chưa có bó nào có hoa này</h5>
                                        </a>
                                    </div>
                                </div>';
                        }    
                    }
                    echo '  </div>';
                    echo '</div>';
                }
                
                
            }else{
                showAll();
            }
        }else{
            showAll();
        }

        // Danh sách tất cả loại hoa
        function showAll(){
            //include "../src/flowerdb.php";
            $sitedir="../";
            $fcatedata = getSql("SELECT * FROM flower_cate order by case when f_cate_ID='KH' THEN 1 ELSE 0 end");
            echo '<div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Loại Hoa</li>
                            </ol>
                        </nav>
                    </div>
                </div>';


            echo '<h2>Danh sách Loại Hoa</h2>
                    <div class="row mt-3">';
            if (sizeof($fcatedata)<=0) {
                echo "Chưa có dữ liệu Loại Hoa!";
            }else{
                foreach ($fcatedata as $key => $fcate) {
                    $fcateimg = $sitedir."img/undefined.jpg";
                    if (file_exists($sitedir.$fcate["f_cate_img"])) {
                        $fcateimg = $sitedir.$fcate["f_cate_img"];
                    }else{
                        //$fcateimg = $sitedir."img/undefined.jpg";
                    }
                    $chk =true;
                    $flowerdata = getSql("SELECT * FROM flower WHERE f_cate_ID = '".$fcate["f_cate_ID"]."'");
                    if (sizeof($flowerdata)>0) {
                        $chk = true;
                    }else{
                        $chk = false;
                    }
                    
                    if ($chk) {
                        echo '<div class="col-lg-3 col-md-5 mb-4">
                            <div class="card h-80 border-primary border-shop hoverable">
                                    <a href="#!flowercate/'.$fcate["f_cate_ID"].'"><img class="card-img-top" src="'.$fcateimg.'" alt=""></a>
                                    <div class="text-center card-caption" style="">
                                        <div class="card-title text-center">
                                            <a href="#!flowercate/'.$fcate["f_cate_ID"].'" >'.$fcate["f_cate_name"].'</a>
                                        </div>   
                                    </div>';
                        echo '<a href="#!flowercate/'.$fcate["f_cate_ID"].'" class="btn card-footer btn-shop" style="border-radius:0px;border-bottom:2px solid #9f7fc3">
                                Xem các Loại hoa '.$fcate["f_cate_name"].'
                            </a>
                            <a href="#!browse.php/filter/'.$fcate["f_cate_name"].'/*/*/*" class="btn card-footer btn-shop">
                                Tìm Bó có hoa '.$fcate["f_cate_name"].'
                            </a>';
                        echo'   </div>
                            </div>';
                    }
                }

                foreach ($fcatedata as $key => $fcate) {
                    $fcateimg = $sitedir."img/undefined.jpg";
                    if (file_exists($sitedir.$fcate["f_cate_img"])) {
                        $fcateimg = $sitedir.$fcate["f_cate_img"];
                    }else{
                        $fcateimg = $sitedir."img/undefined.jpg";
                    }
                    $chk =true;
                    $flowerdata = getSql("SELECT * FROM flower WHERE f_cate_ID = '".$fcate["f_cate_ID"]."'");
                    if (sizeof($flowerdata)>0) {
                        $chk = true;
                    }else{
                        $chk = false;
                    }
                    
                    if (!$chk) {
                        echo '<div class="col-lg-3 col-md-5 mb-4">
                            <div class="card h-80 border-primary border-shop hoverable">
                                <a href="#!flowercate/'.$fcate["f_cate_ID"].'"><img class="card-img-top custom" src="'.$fcateimg.'" alt=""></a>
                                
                                <div class="card-caption">
                                    <div class="card-title text-center">
                                        <a href="#!flowercate/'.$fcate["f_cate_ID"].'">'.$fcate["f_cate_name"].'</a>
                                    </div>   
                                </div>';
                        echo '<a class="btn card-footer btn-secondary" style="border:none;">
                                Loại hoa này chưa có trong shop hoặc đã hết
                            </a>';
                        echo'   </div>
                            </div>';
                    }
                }
            }
            echo '</div>';
        }
        
    ?>
    
</div>

<br>
<!------------------------------------------------ content ------------------------------------->
<!------------------------------------------------ content ------------------------------------->
<!------------------------------------------------ content ------------------------------------->

