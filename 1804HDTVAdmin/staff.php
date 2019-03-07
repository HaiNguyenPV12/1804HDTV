<html>
    <!-- Tựa đề -->
    <div class='row'>
        <h2 class="col-10">Quản lý Nhân viên</h2>
        <button type="button" class="btn btn-success btn-lg col-2" data-toggle="modal" data-target="#modal" ng-click="temp.url = './Pages/bouquetadd.php';modalHText='Thêm mới';">Thêm mới</button>
    </div>

    <br>

    <!-- Đọc dữ liệu từ database để đưa ra bảng -->
    <?php
        // File trung gian kết nối database
        include '.././src/flowerdb.php';
        // Lấy dữ liệu thông tin bó hoa
        $data = getSql("SELECT * FROM bouquet");
    ?>

</html>