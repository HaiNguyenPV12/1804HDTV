
<?php
    include "../src/flowerdb.php";
    if (isset($_GET["bid"]) && $_GET["bid"]!="") {
        $bid = $_GET["bid"];
        $data = getSql("SELECT * FROM bouquet WHERE b_ID = '$bid'");
        if (sizeof($data)<=0) {
            echo "<h4 class='text-center text-danger'>Không tìm thấy thông tin bó hoa!</h4>";
            exit;
        }
        $data = $data[0];
    }else{
        echo "Không tìm thấy thông tin bó hoa!";
        exit;
    }
    $sitedir = "../";
?>
<style>
.image-gallery {
    margin: 0 auto;
    display: table;
    max-height:80vh;
}

.primary,
.thumbnails {
    display: table-cell;
}

.thumbnails {
    width: 7vw;

}

.primary {
    width: 40vw;
    height: 60vh;
    border: 4px solid #b38edd;
    background-color: #cccccc;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
}

.thumbnail:hover .thumbnail-image,
.selected .thumbnail-image {
    border: 4px solid #7c43bd;
}

.thumbnail-image {
    width: 6vw;
    height: 6vw;
    margin: 1vh auto;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    border: 4px solid transparent;
}
.border-shop {
    border: 4px solid;
    border-color: #7c42bd !important;
}
</style>

<div class="container col-10 mt-3 mb-3">
    <!-- Mini navbar -->
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#!browse.php">Bó Hoa</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $data["b_name"] ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main -->
    <div class="row mb-2">
        <!-- Hình ảnh -->
        <div class="image-gallery col-6 border bg-light">
            <aside class="thumbnails">
                <?php
                    $imgdata = getSql("SELECT * FROM bouq_img WHERE b_ID='$bid' order by b_img_ID");
                    $firstimgurl = $sitedir."img/undefined.jpg";
                    if (sizeof($imgdata)>0) {
                        $num=0;
                        $selected="";
                        foreach ($imgdata as $key => $img) {
                            $imgurl = $sitedir.$img["b_img"];
                            if ($num==0) {
                                $selected="selected";
                                $firstimgurl = $sitedir.$img["b_img"];
                            }else{
                                $selected="";
                            }
                            if (file_exists($imgurl)) {
                                echo '<div class="'.$selected.' thumbnail" data-big="'.$imgurl.'">
                                        <div class="thumbnail-image" style="background-image: url('.$imgurl.')"></div>
                                    </div>';
                            }else{
                                echo '<div class="'.$selected.' thumbnail" data-big="'.$sitedir.'img/undefined.jpg">
                                        <div class="thumbnail-image" style="background-image: url('.$sitedir.'img/undefined.jpg)"></div>
                                    </div>';
                            }
                            $num++;
                        }
                    }else{
                        echo '<div class="selected thumbnail" data-big="'.$sitedir.'img/undefined.jpg">
                                <div class="thumbnail-image" style="background-image: url('.$sitedir.'img/undefined.jpg)"></div>
                            </div>';
                        $firstimgurl = $sitedir."img/undefined.jpg";
                    }
                ?>

            </aside>

            <main class="primary" style="background-image: url('<?php 
                if (!file_exists($firstimgurl)) {
                    $firstimgurl = $sitedir."img/undefined.jpg";
                }
                echo $firstimgurl;
            ?>');"></main>
        </div>
        <!-- Hết phần hình ảnh -->

        <!-- Thông tin chi tiết -->
        <div class="col-6 border bg-light">
            <?php 
                $solddata = getSql("SELECT * FROM order_detail WHERE b_ID ='$bid'");
                $sold=0;
                if (sizeof($solddata)>0) {
                    foreach ($solddata as $key => $sdata) {
                        $sold = $sold + (int)$sdata["quan"];
                    }
                }
            ?>
            <!-- Phần đặt hàng -->
            <h2 class="mt-2 mr-2">Bó <?php echo $data["b_name"] ?></h2>
            <small class="text-muted ml-1">Đã bán <?php echo $sold ?> sản phẩm</small>
            <?php
                if ($data["b_selling"]==1) {
                    echo '<h5 class="text-primary display-4">'.number_format($data["b_price"],0,",",".").' Đ</h5>';
                    echo '<div class="form-inline">
                            <p class="mb-2 mr-sm-2 col-3 text-left" for="quant">Giao hàng :</p>
                            <p class="mb-2"><i class="fa fa-truck"></i> Nội thành TP.HCM</p>
                        </div>';
                    echo '<div class="form-inline">
                        <input type="hidden" id="bid" name="bid" value="'.$bid.'">
                            <p class="mb-2 mr-sm-2 col-3 text-left" for="quant">Số lượng :</p>
                            <input type="number" id="quantity" name="quantity" min="1"
                                class="form-control mb-2 input-lg col-2" placeholder="Số lượng" value="1" min="0" step="1">
                            <button id="cmdAddToCart" name="cmdAddToCart" class="btn btn-primary btn-lg btn-block btn-shop col-6 mb-2 ml-sm-2"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Thêm vào giỏ hàng</button>
                        </div>';
                }else{
                    echo '<h5 class="text-danger display-4">Hết hàng</h5>';
                }
            ?>
            <!-- Hết Phần đặt hàng -->

            <!-- Phần đặc điểm, chi tiết -->
            <div class="container-fluid">
                <h5>Đặc tính</h5>
                <div class="row">
                    <?php
                        // Hoa có trong bó
                        $flowerdata = getSql("SELECT * FROM flower, bouq_detail WHERE flower.f_ID = bouq_detail.f_ID and b_ID = '$bid'");
                        $num=0;
                        if (sizeof($flowerdata)>0) {
                            echo '<span class="col-sm-1 mb-2"></span>';
                            echo '<span class="col-sm-2 mb-2">Hoa:</span>';
                            echo '<span class="col-sm-9 mb-2">';
                            foreach ($flowerdata as $key => $fdata) {
                                if ($num!=0) {
                                    echo ' , ';
                                }
                                echo '<a href="#!flower/'.$fdata["f_ID"].'">';
                                echo $fdata["f_name"];
                                echo '</a>';
                                $num++;
                            }
                            echo '</span>';
                        }

                        // Loại hoa
                        $flowercatedata = getSql("SELECT DISTINCT f_cate_name,flower_cate.f_cate_ID FROM flower, bouq_detail, flower_cate WHERE flower.f_ID = bouq_detail.f_ID and flower_cate.f_cate_ID=flower.f_cate_ID and b_ID = '$bid'");
                        $num=0;
                        if (sizeof($flowercatedata)>0) {
                            echo '<span class="col-sm-1 mb-2"></span>';
                            echo '<span class="col-sm-2 mb-2">Loại hoa:</span>';
                            echo '<span class="col-sm-9 mb-2">';
                            foreach ($flowercatedata as $key => $fcdata) {
                                if ($num!=0) {
                                    echo ' , ';
                                }
                                echo '<a href="#!flowercate/'.$fcdata["f_cate_ID"].'">';
                                echo 'Hoa '.$fcdata["f_cate_name"];
                                echo '</a>';
                                $num++;
                            }
                            echo '</span>';
                        }

                        // Màu có trong bó
                        $colordata = getSql("SELECT DISTINCT f_color_name FROM flower, bouq_detail, flower_color, flower_color_detail WHERE flower.f_ID = bouq_detail.f_ID and flower_color_detail.f_ID=flower.f_ID and flower_color_detail.f_color_ID=flower_color.f_color_ID and b_ID = '$bid'");
                        $num=0;
                        if (sizeof($colordata)>0) {
                            echo '<span class="col-sm-1 mb-2"></span>';
                            echo '<span class="col-sm-2 mb-2">Màu:</span>';
                            echo '<span class="col-sm-9 mb-2">';
                            foreach ($colordata as $key => $cdata) {
                                if ($num!=0) {
                                    echo ' , ';
                                }
                                echo '<a href="#!browse.php/filter/*/'.$cdata["f_color_name"].'/*/*/*">';
                                echo $cdata["f_color_name"];
                                echo '</a>';
                                $num++;
                            }
                            echo '</span>';
                        }

                        // Dịp
                        $num=0;
                        $occadata = getSql("SELECT DISTINCT occa_name FROM bouquet, occasion, occasion_detail WHERE bouquet.b_ID=occasion_detail.b_ID and occasion_detail.occa_ID=occasion.occa_ID and bouquet.b_ID = '$bid'");
                        if (sizeof($occadata)>0) {
                            echo '<span class="col-sm-1 mb-2"></span>';
                            echo '<span class="col-sm-2 mb-2">Dịp:</span>';
                            echo '<span class="col-sm-9 mb-2">';
                            foreach ($occadata as $key => $odata) {
                                if ($num!=0) {
                                    echo ' , ';
                                }
                                echo '<a href="#!browse.php/filter/*/*/'.$odata["occa_name"].'/*/*">';
                                echo $odata["occa_name"];
                                echo '</a>';
                                $num++;
                            }
                            echo '</span>';
                        }
                    ?>
                </div>

                <h5>Mô tả</h5>
                
                <div class="row mb-2">
                    <?php 
                    echo '<div class="col-1"></div>';
                    echo '<div class="col-11">'.nl2br($data["b_detail"]).'</div>'; 
                    ?>
                </div>

            </div>
            <!-- Hết Phần đặc điểm, chi tiết -->
        </div>
        <!-- Hết Thông tin chi tiết -->
    </div>
    <!-- Hết Main -->

    <!--Bình luận-->
    <div class="container row border bg-light">
        <div class="container row mt-2">
            <h5>Bình luận</h5>
        </div>

        <div class="container mb-3 mt-3">
            <?php
                $cmdata = getSql("SELECT * FROM comment WHERE b_ID = '$bid' AND cm_check=1 order by cm_date desc");
                if (sizeof($cmdata)>0) {
                    foreach ($cmdata as $key => $cm) {
                        $cmdate = strtotime($cm["cm_date"]);
                        echo '<div class="media border p-2 bg-active">
                                <img src="../img/user.png" class="mr-3 mt-3 rounded-circle"
                                    style="width:4vw;">
                                <div class="media-body text-dark">
                                    <h5><b>'.$cm["cm_name"].'</b></h5>
                                    <p class="text-muted">
                                    <i>'.date("H",$cmdate).':'.date("i",$cmdate).'
                                     - '.date("d",$cmdate).' tháng '.date("m",$cmdate).' năm '.date("Y",$cmdate).' 
                                    </i>
                                    </p>
                                    <p>'.$cm["cm_detail"].'</p>
                                </div>
                            </div>';
                    }
                }else{
                    echo '<div class="container-fluid border text-muted">(Chưa có bình luận nào)</div>';
                }
            ?>
        </div>

        <form id="frmComment" action="" class="form mb-3 row container">
            <input type="hidden" name="cmbid" id="cmbid" value="<?php echo $bid ?>">
            <input id="txtName" name="txtName" required class="form-control mb-2" type="text" placeholder="Tên *">
            <input id="txtPhone" name="txtPhone" required class="form-control mb-2" type="text" placeholder="Số điện thoại *">
            <input id="txtEmail" name="txtEmail" class="form-control mb-2" type="text" placeholder="Email">
            <textarea required name="txtDetail" id="txtDetail" cols="50" rows="2" class="form-control mb-2"
                placeholder="Hãy viết bình luận tại đây *"></textarea>
            <p class="container text-muted"><i>Lưu ý: Bình luận của bạn sẽ được hiện lên sau khi được xét duyệt</i></p>
            <button id="cmdAddComment" name="cmdAddComment" type="button" class="btn btn-lg btn-primary btn-shop">Gửi bình luận</button>
        </form>
    </div>
    <!--Hết bình luận-->
</div>

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

