<?php
    include "../src/flowerdb.php";
    $fcatedata = getSql("SELECT * FROM flower_cate order by case when f_cate_ID='KH' THEN 1 ELSE 0 end");
?>
<!------------------------------------------------ content ------------------------------------->
<!------------------------------------------------ content ------------------------------------->
<!------------------------------------------------ content ------------------------------------->
<br>
<style>
.border-shop {
    border-color: #7c42bd !important;
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
                echo '<div class="col-lg-3 col-md-5 mb-4">
                        <div class="card h-80 border-primary border-shop">
                            <a href="#"><img class="card-img-top custom" src="../img/Bouquet/B000/B000_00.jpg" alt=""></a>
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

