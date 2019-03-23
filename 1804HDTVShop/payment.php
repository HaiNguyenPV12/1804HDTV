<?php
include "../src/fconnectadmin.php";
session_start();
?>
    <div class="container">
    <h2 class="text-center">Thanh toán</h2>
    <div class="row">
        <div class="container col-8">
            <div class="table-responsive">
                <table class="table table-striped" >
                    <thead>
                        <tr>
                            <th scope="col-4" class="text-left">Hình ảnh</th>
                            <th scope="col-2" class="text-left">Bó hoa</th>
                            <th scope="col-2" class="text-left">Số lượng</th>
                            <th scope="col-2" class="text-left">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        <?php
                                if (isset($_SESSION["cart"])) {
                                    //print_r($_SESSION["cart"]);
                                    include "../src/flowerdb.php";
                                    $bdata = getSql("SELECT * FROM bouquet"); 
                                    $sum= 0;
                                    $ship= 30000;                           
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
                                                    echo "<td>",$aprice = $b["b_price"]*$cart["quan"],"</td>";
                                                    $sum = $sum + $aprice;
                                                    echo "</tr>";
                                                    break;
                                                }
                                            }
                                        }
                                    echo "<tr>";
                                    echo "<td>"."</td>";
                                    echo "<td>"."</td>";
                                    echo "<td>"."PHÍ SHIP"."</td>";
                                    echo "<td>".$ship."</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>"."</td>";
                                    echo "<td>"."</td>";
                                    echo "<td>"."TỔNG TIỀN THANH TOÁN"."</td>";
                                    echo "<td>",$sum+$ship,"</td>";
                                    echo "</tr>";
                                    
                                }else{
                                    echo "Chưa có dữ liệu giỏ hàng";
                                }
                        ?>
                    </tbody>
                    </tbody>
                </table>
            </div>

        </div>
        
        <div class="container col-4">
            <div class="card bg-light">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Thông tin thanh toán</h4>
                    <form method="post" name="frmPayment" id="frmPayment">
                    <input type="hidden" name ="cmdPayment">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="cusName" id="cusName" class="form-control" placeholder="Họ tên khách hàng" type="text">
                        </div> <!-- form-group// -->
                        <p style="color:red;display:none;"  id="nameLabel"></p>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="cusEmail" id="cusEmail"  class="form-control" placeholder="Địa chỉ email" type="text">
                        </div> <!-- form-group// -->
                        <p style="color:red;display:none;"  id="emailLabel"></p>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="cusAddress" id="cusAddress"  class="form-control" placeholder="Địa chỉ nhận hàng" type="text">
                        </div> <!-- form-group// -->
                        <p style="color:red;display:none;"  id="addressLabel"></p>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                            </div>
                            <input name="cusPhone" id="cusPhone"  class="form-control" placeholder="Số điện thoại" type="text">
                        </div> <!-- form-group// -->
                        <p style="color:red;display:none;"  id="phoneLabel"></p>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
                            </div>
                            <input name="dateVal" id="dateVal" class="form-control" placeholder="Ngày nhận hàng" type="datetime-local">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button  name="cmdPay" id="cmdPay"  type="button" class="btn btn-primary btn-block">Xác nhận thanh toán </button>
                               
                        </div> <!-- form-group// -->
                    </form>
                </article>
            </div>
           <!-- card.// -->
        </div>

        </div>
    </div>
    <br>

   
</html>