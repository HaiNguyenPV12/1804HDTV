<?php
include "../src/fconnectadmin.php";
session_start();
?>
<div class="container mb-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped" >
                    <thead>
                        <tr>
                            <th scope="col" class="text-left">Hình ảnh</th>
                            <th scope="col" class="text-left">Bó hoa</th>
                            <th scope="col" class="text-left">Số lượng</th>
                            <th scope="col" class="text-left">Đơn giá</th>
                            <th scope="col" class="text-left">Thành tiền</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                if (isset($_SESSION["cart"])) {
                                    //print_r($_SESSION["cart"]);
                                    include "../src/flowerdb.php";
                                    $bdata = getSql("SELECT * FROM bouquet"); 
                                    $sum ="";
                                    foreach ($_SESSION["cart"] as $key => $cart) {
                                            foreach ($bdata as $key2 => $b) {
                                                if ($b["b_ID"]==$cart["bid"]) {
                                                    echo "<tr>";
                                                    $img = getSql("SELECT * FROM bouq_img WHERE b_ID = '".$b["b_ID"]."' ORDER BY b_img_ID ASC");                                                    
                                                    if (sizeof($img)<=0) {
                                                        echo "<td>"."<img style='max-width:10vw' src='../img/undefined.jpg'>"."</td>";
                                                    }else{
                                                        if (file_exists("../".$img[0]["b_img"])) {
                                                            echo "<td>"."<img style='max-width:10vw' src='../".$img[0]["b_img"]."'>"."</td>";
                                                        }else{
                                                            echo "<td>"."<img style='max-width:10vw' src='../img/undefined.jpg'"."</td>";
                                                        }
                                                    }
                                                    echo "<td>",$b["b_name"],"</td>";
                                                    echo "<td>",$cart["quan"],"</td>";
                                                    echo "<td>",$b["b_price"],"</td>";
                                                    echo "<td>",$b["b_price"]*$cart["quan"],"</td>";
                                                    echo "<td><button class='btn btn-danger' type='button' name='btnDel'>X
                                                           <input type='hidden' id='bid' value='".$b["b_ID"]."'> 
                                                        </button></td>";
                                                    echo "</tr>";
                                                    break;
                                                }
                                            }
                                        }
                                    
                                }else{
                                    echo "Chưa có dữ liệu giỏ hàng";
                                }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <a href="index.php" class="btn btn-block btn-light btn-active">Tiếp tục mua hàng</a>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <a href="#!payment" class="btn btn-lg btn-block btn-success text-uppercase btn-shop">Thanh toán</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
    </div>
    <br>

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