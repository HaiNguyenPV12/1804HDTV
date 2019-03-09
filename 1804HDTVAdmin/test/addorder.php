<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tạo hóa đơn</title>
</head>
<body>
    <h2>Tạo hóa đơn</h2>
    <a href='index'>Back to Tester homepage</a><br>
    <form method="get" action="addorder_process">
    <?php
        include "../../src/flowerdb.php";
        $cdata = getSql("select * from customer");
        echo "<br>";
        echo "Hãy chọn khách hàng: <span id='cusname'></span><br>";
        foreach ($cdata as $key => $c) {
            echo "<label><input type='radio' name ='cid' value='".$c["cus_ID"]."'>".$c["cus_ID"]." : ".$c["cus_name"]."</label><br>";
        }
        echo "<label><input type='radio' name ='cid' value='new'>Khách hàng mới</label><br>";
    ?>
    <br>
    <select name="insert" id="insert">
        <?php
            $bdata = getSql("select * from bouquet");
            foreach ($bdata as $key => $b) {
                echo '<option value="'.$b['b_ID'].'">'.$b['b_name'].'</option>';
            }
        ?>
    </select>
    <input type="number" name="quan" id="quan" style='width:50px' min=1 value=1>
    <input type="button" id='add' value='Thêm vào giỏ'>
    <br>
    
        <b>Giỏ hàng</b>
        <div>
        <ul id='view'>
        </ul>
        </div>

        <br>
        <button type='submit' name='cmdOrder' id='cmdOrder'>Đặt hàng</button>
    </form>
    <script src="../../Scripts/jquery-3.3.1.min.js"></script>
    <script src="addorder.js"></script>
</body>
</html>