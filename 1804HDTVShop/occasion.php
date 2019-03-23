<html>

<head>
    <link rel="stylesheet" href="../Content/1804HDTVShop/home.css">
</head>

<body>
    <div class='container'>
        <div class='col-12 mt-1'>
            <div class="row justify-content-center">
                <h2>Tất cả các dịp</h2>
            </div>
        </div>
    </div>
    <?php
include "../src/fconnectadmin.php";
$sql = "SELECT * from occasion INNER JOIN v_bouq_gen on v_bouq_gen.occa_name = occasion.occa_name where v_bouq_gen.b_img LIKE '%_00.%' ORDER by occa_ID desc";
$rs = mysqli_query($cn, $sql);
$cardindex = 1;
$occaindex = "";
while ($row = mysqli_fetch_assoc($rs)) {
    if ($cardindex % 2 == 0) {
        $class = '2';
    } else {
        $class = '1';
    }
    if ($occaindex != $row['occa_ID']) {
        echo "<div style=\"background: url(../" . $row['occa_img'] . "); background-size: cover;\" class='event-card'>
            <div class='row event-details h-100'>
                <div class='col-5 pull-left event-text-" . $class . " text-center'>
                    <div class='row h-75'>
                        <div class='col my-auto'>
                            <h2>Hoa " . $row['occa_name'] . "</h2>
                            <pre class='event-text-content'>" . $row['occa_detail'] . "</pre>
                        </div>
                    </div>
                    <a href='#!browse.php/occa/" . $row['occa_name'] . "' class='btn btn-primary btn-shop'>Xem Các Bó " . $row['occa_name'] . "</a>
                </div>
            </div>
        </div>";
        $cardindex++;
    }
    $occaindex = $row['occa_ID'];
}
?>
</body>

</html>