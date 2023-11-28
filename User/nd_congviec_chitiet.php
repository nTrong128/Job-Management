<?php

// Update User
include_once('../condb/condb.php');
$ma = $_GET['chitiet_ma'];

$query_cv = "SELECT * FROM congviec WHERE CV_MA='$ma'";

$congviec_data = mysqli_query($conn, $query_cv);
$cv = mysqli_fetch_array($congviec_data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <link href="../styles/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../styles/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="../js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Người dùng</title>
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
                <a class="btn btn-outline-light px-2 py-2 me-2" href="dangxuat.php" role="button">ĐĂNG XUẤT</a>
            </div>
            </div>
        </nav>
    </header>

    <main>


        <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar_content" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header custom-bg text-light">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    <?php  if (isset($_SESSION['nguoidung'])): ?>
                    <?php
                        $email = $_SESSION['nguoidung'];
                        $query = "select * from nguoidung where ND_EMAIL ='$email'";
                        $sql = mysqli_query($conn, $query);
                        $nguoidung = mysqli_fetch_assoc($sql);
                        $nd_ma = $nguoidung['ND_MA'];
                        echo $nguoidung['ND_HOTEN']; ?>
                    <?php endif ?>
                </h5>

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

        <div class="form_center">
            <form id="form" name="form" method="post" onsubmit="return validateForm()" class="form">
                <div class="navbar_container shadow-lg p-5 py-4 m-2 border border-2 rounded">
                    <h1 class="text-light text-center">XEM CHI TIẾT CÔNG VIỆC</h1>
                    <hr class="text-dark border border-2 rounded " style="border-top: 4px solid white">

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Tên công việc:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly class="form-control" type="text" placeholder="Nhập tên công việc" name="ten" id="ten" value="<?php echo $cv['CV_TEN'];?> ">
                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="ngaybatdau">Ngày bắt đầu:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly class="form-control" type="" placeholder="Điền ngày bắt đầu công việc" name="ngaybatdau" id="ngaybatdau" value="<?php echo $cv['CV_NGAYBATDAU'];?> ">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="ngayketthuc">Ngày kết thúc:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly class="form-control" type="" name="ngayketthuc" id="ngayketthuc" value="<?php echo $cv['CV_NGAYKETTHUC'];?> ">
                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Nội dung:</label>
                        </div>
                        <div class="col p-1 ">
                            <textarea readonly class="form-control" name="noidung" id="noidung" rows="3"><?php echo $cv['CV_NOIDUNG'];?></textarea>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Tiến độ:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly type="number" min="0" max="100" class="form-control" name="tiendo" id="tiendo" rows="3" value=<?php echo $cv['CV_TIENDO'];?>></input>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="trangthai">Trạng thái:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly type="text" min="<?php echo $cv['CV_TRANGTHAICV'];?>" max="100" class="form-control" name="trangthai" id="trangthai" rows="3"
                                value=<?php echo $cv['CV_TRANGTHAICV'];?>></input>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="nguoithuchien">Người thực hiện:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly type="text" class="form-control" name="nguoithuchien" value="<?php $nd_ma = $cv['CV_NTH'];
$query_nd = "SELECT * FROM nguoidung WHERE ND_MA='$nd_ma'";
$nguoidung_data = mysqli_query($conn, $query_nd);
$nguoidung = mysqli_fetch_array($nguoidung_data);
echo $nguoidung['ND_HOTEN'];?>">

                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="nguoigiamsat">Người giám sát:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly type="text" class="form-control" name="nguoigiamsat" value="<?php
                            $nd_ma = $cv['CV_NGS'];
$query_nd = "SELECT * FROM nguoidung WHERE ND_MA='$nd_ma'";
$nguoidung_data = mysqli_query($conn, $query_nd);
$nguoidung = mysqli_fetch_array($nguoidung_data);
echo $nguoidung['ND_HOTEN'];
?> ">

                        </div>
                    </div>





                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="loai">Loại công việc:</label>
                        </div>
                        <div class="col p-1">
                            <input readonly type="text" class="form-control" name="loaicongviec" value="<?php
$lcv_ma = $cv['LCV_MA'];
$lcv = "SELECT * FROM loaicongviec WHERE LCV_MA='$lcv_ma'";
$lcv_data = mysqli_query($conn, $lcv);
$lcv = mysqli_fetch_array($lcv_data);
echo $lcv['LCV_TEN'];
?>">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1 text-light">
                            <label for="ngayketthuc">Ngày tạo:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly class="form-control" type="" name="ngayketthuc" id="ngayketthuc" value="<?php echo $cv['CV_NGAYTAO'];?> ">
                        </div>
                    </div>
                    <div class="btn_form">
                        <a href="nguoidung.php" style="width:50%" class="btn  btn-dark">Quay lại</a>
                        <a href="nd_congviec_sua.php?capnhat_ma=<?php echo $ma?>" style="width:50%" class="btn mx-2 btn-success">Nhận</a>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer class="footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>
</body>

</html>