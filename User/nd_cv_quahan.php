<?php include_once '../condb/condb.php';
if ((!isset($_SESSION['nguoidung']))) {
    session_destroy();
    unset($_SESSION['nguoidung']);
    header("location: ../index.php");
}
$email = $_SESSION['nguoidung'];
$query = "select * from nguoidung where ND_EMAIL ='$email'";
$sql = mysqli_query($conn, $query);
$nguoidung = mysqli_fetch_assoc($sql);
$nd_ma = $nguoidung['ND_MA'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <link href="../styles/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Công việc</title>
</head>

<body>
    <header>
        <nav class=" navbar navbar-expand custom_navbar_bg fixed-top border-bottom border-light border-3">
            <button class=" btn mx-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar_content" aria-controls="sidebar_content">
                <i class="fa-solid fs-2 text-light fa-bars"></i>
            </button>
            <div class="container-fluid">
                <a class="navbar-brand text-white fs-4" href="trangchu.php"><img src="../image/logo.png" style="width: 40px;" class="w3-circle"></a>
                <a class="navbar-brand text-white fs-2"> QUẢN LÝ CÔNG VIỆC </a>
                <div class="">
                    <a href="#"><img class="rounded-circle me-4" width="54px" src="../Image/default_avatar.jpg" alt="Profile Picture"></a>
                    <a class="btn btn-outline-light px-2 py-2 me-2" href="dangxuat.php" role="button">ĐĂNG XUẤT</a>
                </div>
            </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="sidebar_content" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header custom-bg text-light">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel">
                    <?php echo $nguoidung['ND_HOTEN'];?>
                </h3>

                <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="fa-solid fa-xmark fa-2xl" style="color: #ffffff;"></i>
                </button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <a href="nguoidung.php" type="button" class="btn btn-outline-secondary w-100 my-1 py-2">Trang
                        chủ</a>
                </div>
                <div>
                    <a href="nd_tt_capnhat.php?capnhat_nd_ma=<?php echo $nguoidung['ND_MA']?>" type="button" class="btn btn-outline-secondary w-100 my-1 py-2">Cập nhật
                        thông tin cá nhân</a>
                </div>
                <div class="dropdown w-100">
                    <button class="btn btn-outline-secondary w-100 dropdown-toggle" type="button" id="dropdownMenuButton1" data-mdb-toggle="dropdown" aria-expanded="false">
                        Công việc
                    </button>
                    <ul class="dropdown-menu w-100 text-center" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Đang chờ</a></li>
                        <li><a class="dropdown-item" href="#">Đang thực hiện</a></li>
                        <li><a class="dropdown-item" href="#">Đang giám sát</a></li>
                        <li><a class="dropdown-item" href="#">Đã hoàn thành</a></li>
                        <li><a class="dropdown-item" href="#">Quá hạn</a></li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="rounded p-4 d-flex justify-content-sm-between">
            <input class="rounded-2" type="text" id="searchBar" placeholder="Tìm kiếm người dùng.." title="Nhập thông tin người dùng">
            <a href="ad_nguoidung_them.php" class="btn btn-dark p-3 px-4">Thêm người dùng</a>
        </div>
        <?php
    $query_cv = "select * from congviec where CV_NTH =$nd_ma and CV_TIENDO < 100 and CV_NGAYKETTHUC < NOW()";
    $ds_cv = mysqli_query($conn, $query_cv);
    $soluong_cv = $ds_cv->num_rows;
    ?>
        <div class="container bg-white w-80 rounded-4 p-2" style="--bs-bg-opacity: .5;">
            <h2 class="text-center ">DANH SÁCH CÔNG VIỆC ĐÃ QUÁ HẠN</h2>
            <h2 class="text-center ">Tổng số người dùng: <?php echo $soluong_cv;?></h2>
        </div>
        <div class="m-4 ms-4 rounded bg-light border border-2">
            <table id="dataTable" class="table text-center align-middle">
                <thead class="align-middle">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên công việc</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Ngày kết thúc</th>
                        <th scope="col">Tiến độ</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
$i = 1;
while ($cv = mysqli_fetch_assoc($ds_cv)):
    ;
    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $i;
    $i += 1; ?>
                        </th>
                        <td>
                            <?php echo $cv['CV_TEN']; ?>
                        </td>
                        <td>
                            <?php echo $cv['CV_NGAYBATDAU']; ?>
                        </td>
                        <td>
                            <?php echo $cv['CV_NGAYKETTHUC']; ?>
                        </td>
                        <td>
                            <?php echo $cv['CV_TIENDO']; ?>
                        </td>
                        <td>
                            <?php echo $cv['CV_TRANGTHAICV']; ?>
                        </td>
                        <td>
                            <button title="Cập nhật tiến độ" type="button" class="btn-primary btn" data-toggle="modal" data-target="#myModal">
                                Cập nhật tiến độ
                            </button>
                        </td>

                    </tr>
                    <?php
endwhile;
?>
                </tbody>
            </table>
        </div>
    </main>


    <footer class="footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>
</body>
<script>
$(document).ready(function() {
    $("#searchBar").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#dataTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
<script>
var prevScrollpos = window.pageYOffset;

/* Get the header element and it's position */
var headerDiv = document.querySelector("nav");
var headerBottom = headerDiv.offsetTop + headerDiv.offsetHeight;

window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;

    /* if scrolling down, let it scroll out of view as normal */
    if (prevScrollpos <= currentScrollPos) {
        headerDiv.classList.remove("fixed-top");
        headerDiv.style.top = "-7.2rem";
    }
    /* otherwise if we're scrolling up, fix the nav to the top */
    else {
        headerDiv.classList.add("fixed-top");
        headerDiv.style.top = "0";
    }

    prevScrollpos = currentScrollPos;
}
</script>

</html>