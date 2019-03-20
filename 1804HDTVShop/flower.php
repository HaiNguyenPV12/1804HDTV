<?php
include "../src/flowerdb.php";

?>
<style>
.border-shop {
    border-color: #7c42bd !important;
}
.card-img-top{
    width: 100%;
    height: 12rem;
    object-fit: cover;
}
.text-shop a{
    color: #7c43bd;
}
</style>

<div class="container col-10 mt-3 mb-3">
    <?php
        $sitedir = "../";
        if (isset($_GET["fid"])) {
            if ($_GET["fid"]=="") {
                die("Sản phẩm hết hàng hoặc chưa có trong shop!");
            }else {
                $fid = $_GET["fid"];
                $existed = getSql("SELECT * FROM flower, flower_cate WHERE flower.f_cate_ID = flower_cate.f_cate_ID AND f_ID = '$fid'");
                if (sizeof($existed)<=0) {
                    echo '<div class="row">
                            <div class="col">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                        <li class="breadcrumb-item"><a href="#!flowercate">Loại Hoa</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Hoa</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>';
                    die("<h4 class='text-center text-danger'>Sản phẩm hết hàng hoặc chưa có trong shop!</h4>");
                }
                $data =$existed[0];
            }
        }else{
            die("Sản phẩm hết hàng hoặc chưa có trong shop!");
        }


        echo '<div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="#!flowercate">Loại Hoa</a></li>
                            <li class="breadcrumb-item"><a href="#!flowercate/'.$data["f_cate_ID"].'">'.$data["f_cate_name"].'</a></li>
                            <li class="breadcrumb-item active" aria-current="page">'.$data["f_name"].'</li>
                        </ol>
                    </nav>
                </div>
            </div>';

        echo '<div class="row">';
        echo '<div class="col-lg-2 mr-2 border" style="background-color:#ebdbfd">';
        echo '<h3 class="my-3 text-center">Các bó có</h3>
            <h1 class="my-3 text-center">'.$data["f_name"].'</h1>';
        if (file_exists($sitedir.$data["f_img"])) {
            $imgurl = $sitedir.$data["f_img"];
        }else{
            $imgurl = $sitedir."img/undefined.jpg";
        }
        echo '<img src="'.$imgurl.'" style="width:100%;border-radius:100%;">';
        echo '<div class="mb-2 mt-4">'.nl2br($data["f_detail"]).'</div>';
        echo '</div>';


        $bouquet = getSql("SELECT * FROM bouquet, bouq_detail, flower WHERE bouquet.b_ID = bouq_detail.b_ID AND flower.f_ID = bouq_detail.f_ID and flower.f_ID = '$fid'");
        echo '<div class="col-lg-10 row border bg-light">';
        if (sizeof($bouquet)<=0) {
            die("Chưa có bó hoa nào có hoa này!");
        }else{
            foreach ($bouquet as $key => $bdata) {
                $bimg = getSql("SELECT * FROM bouq_img WHERE b_ID = '".$bdata["b_ID"]."' ORDER BY b_img_ID ASC");
                if (sizeof($bimg)<=0) {
                    $bimgurl = $sitedir."img/undefined.jpg";
                }else{
                    if (file_exists($sitedir.$bimg[0]["b_img"])) {
                        $bimgurl = $sitedir.$bimg[0]["b_img"];
                    }else{
                        $bimgurl = $sitedir."img/undefined.jpg";
                    }
                }
                
                echo '<div class="col-lg-3 col-md-5 mb-3 mt-3">
                    <div class="card h-80 border-primary border-shop">
                        <a href="#!product/'.$bdata["b_ID"].'"><img class="card-img-top custom" src="'.$bimgurl.'" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title text-center">
                                <a href="#!product/'.$bdata["f_ID"].'" >'.$bdata["b_name"].'</a>
                            </h4>
                        </div>
                        <a href="#!product/'.$bdata["b_ID"].'" class="btn card-footer btn-shop" style="border-radius:0px;border-bottom:2px solid #9f7fc3">
                            Xem chi tiết
                        </a>
                        <button name="cmdAddToCart" class="btn card-footer btn-shop">
                            <i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Cho vào giỏ hàng
                            <input type="hidden" id="bid" value="'.$bdata["b_ID"].'">
                        </button>

                    </div>
                </div>';
            }
        }
       
        echo '  </div>';

        echo '</div>';
    ?>
</div>

<!-- Modal kết quả -->
<div class="modal" id="result">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body text-center" id="txtResult">
            </div>
        </div>
    </div>
</div>