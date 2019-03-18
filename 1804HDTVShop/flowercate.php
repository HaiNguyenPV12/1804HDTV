<?php
    include "../src/flowerdb.php";
    $fcatedata = getSql("SELECT * FROM flower_cate order by case when f_cate_ID='KH' THEN 1 ELSE 0 end");
    $sitedir="../";
?>
<!------------------------------------------------ content ------------------------------------->
<!------------------------------------------------ content ------------------------------------->
<!------------------------------------------------ content ------------------------------------->
<br>
<style>
.border-shop {
    border-color: #7c42bd !important;
}
.card-img-top{
    width: 100%;
    height: 15rem;
    object-fit: cover;
}
</style>
<div class="container col-12 pl-5 pr-5">
    <h2>Danh sách Loại Hoa</h2>
    <div class="row mt-3">
    <?php
        if (sizeof($fcatedata)<=0) {
            echo "Chưa có dữ liệu Loại Hoa!";
        }else{
            foreach ($fcatedata as $key => $fcate) {
                $fcateimg = $sitedir."img/undefined.jpg";
                if (file_exists($sitedir.$fcate["f_cate_img"])) {
                    $fcateimg = $sitedir.$fcate["f_cate_img"];
                }else{
                    $fcateimg = $sitedir."img/undefined.jpg";
                }
                echo '<div class="col-lg-3 col-md-5 mb-4">
                        <div class="card h-80 border-primary border-shop hoverable">
                            <a href="#"><img class="card-img-top custom" src="'.$fcateimg.'" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title text-center">
                                    <a href="#" >'.$fcate["f_cate_name"].'</a>
                                </h4>   
                            </div>
                            <a href="#" class="btn card-footer btn-shop">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>';
            }
        }
    ?>
    </div>
</div>

<br>
<!------------------------------------------------ content ------------------------------------->
<!------------------------------------------------ content ------------------------------------->
<!------------------------------------------------ content ------------------------------------->

