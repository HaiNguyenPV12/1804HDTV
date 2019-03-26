<?php
session_start();
if (!in_array("Q10", $_SESSION["sRight"], true) && !in_array("Q00", $_SESSION["sRight"], true)) {
    echo "<h2>Bạn không có quyền truy cập vào trang này!<h2>";
    exit;
}
?>
<style>
    img {
        max-width: 20vh;
    }
</style>

<body>
    <!-- Tựa đề -->
    <div class='row'>
        <h2 class="col-12">Quản lý Bình Luận</h2>
    </div>
    <div id="wrapper">
        <table id='commenttable' class='table table-hover table-bordered table-sm text-center'>
            <tr class='table-info table-shop'>
                <th style="width:50px;">ID</th>
                <th style="width:80px;">Tên</th>
                <th style="width:80px;">Bình luận</th>
                <th style="width:50px;">Mã bó</th>
                <th style="width:80px;">Ngày</th>
                <th style="width:20px;">Tình trạng</th>
                <th style="width:50px;"></th>
            </tr>
            <?php
            require("../src/flowerdb.php");

            //thuc hien cau truy van
            $result = getSql("select cm_id,cm_name,cm_detail,b_ID,cm_date,cm_check from comment order by cm_id desc");
            foreach ($result as $key => $r) {
                $cdata = getSql("select * from bouquet where b_ID = '" . $r["b_ID"] . "'");
                echo "<tr>";
                echo "<td>" . $r["cm_id"] . "</td>";
                echo "<td>" . $r["cm_name"] . "</td>";
                echo "<td>" . $r["cm_detail"] . "</td>";
                echo "<td>" . $cdata[0]["b_ID"] . "</td>";
                echo "<td>" . $r["cm_date"] . "</td>";
                echo "<td><a href='#' style='color:#09F;'>" . $r["cm_check"] . "</a></td>";
                echo "<td><button href='#' style='color:#F3F;'>Xóa</button></td>";
                echo "</tr>";
            }

            ?>



            <!-- Modal chung -->
            <div class="modal fade" id="modal" ng-controller="myModal">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header bg-info bg-shop">
                            <h4 id="modalHeader" class="modal-title text-light">{{modalHText}}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div ng-include="temp.url">
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                        </div>

                    </div>
                </div>
            </div>
</body> 