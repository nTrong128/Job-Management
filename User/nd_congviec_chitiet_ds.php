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
include_once 'nd_thongbao.php';
?>
<?php
$ma = $_GET['chitiet_ma'];
$link = $_GET['turn_back'];
$link = "$link.php";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Chi tiết công việc</title>
</head>

<body>

    <header>
        <nav class=" navbar navbar-expand custom_navbar_bg fixed-top border-bottom border-light border-3">
            <button class=" btn mx-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar_content" aria-controls="sidebar_content">
                <i class="fa-solid fs-2 text-light fa-bars"></i>
            </button>
            <div class="container-fluid">
                <a class="navbar-brand text-white fs-4" href="nguoidung.php"><img src="../image/logo.png" style="width: 40px;" class="w3-circle"></a>
                <a class="navbar-brand text-white fs-2"> QUẢN LÝ CÔNG VIỆC </a>
                <div class="d-flex">
                    <div class="d-flex">
                        <div class="dropdown mx-4 position-relative">
                            <span class="position-absolute top-0 start-100 fs-6 translate-middle badge bg-danger rounded-pill badge-danger">
                                <?php echo $soluong_thongbao; ?>
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">
                                <i class="fs-1 fa-solid fa-bell"></i>
                            </a>
                            <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">
                                <div class="notification-heading border-bottom py-2 d-flex justify-content-between">
                                    <h4 class="">Thông báo</h4>
                                    <form id="form" name="form" method="POST" onsubmit="return validateForm()" class="">
                                        <button type="dochet" name="dochet" onclick="reloadPageContentOnSubmit()" class="btn btn-dark menu-title">Đánh dấu tất cả là đã đọc</button>
                                    </form>

                                </div>
                                <li class="divider"></li>
                                <div class="notifications-wrapper">
                                    <?php
if ($ds_thongbao->num_rows > 0):
    while ($thongbao = mysqli_fetch_assoc($ds_thongbao)):;
        ?>
                                    <div class="content" href="#">
                                        <div class="notification-item <?php if ($thongbao['TB_XEM'] == '0') echo "unread" ?>">

                                            <div class="d-flex justify-content-between">
                                                <h4 class="item-title"><?php echo $thongbao['CV_TEN'] ?></h4>
                                                <?php
                                        if ($thongbao['TB_XEM'] == '0'):
                                        ?>
                                                <a class="text-decoration-none  btn btn-dark" href="nd_thongbao_doc.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                                    Đánh dấu đã đọc
                                                </a>
                                                <?php else: ?>
                                                <a class="text-decoration-none btn btn-dark" href="nd_thongbao_chuadoc.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                                    Đánh dấu là chưa đọc
                                                </a>
                                                <?php endif;?>
                                            </div>

                                            <?php 
                                        // $start_date = date_create($thongbao['TB_TG']);
                                        
                                        // $date_out = timeAgo($start_date);
                                        $date_out = timeAgo($thongbao['TB_TG']);
                                        
                                        ?>
                                            <p class="item-info"><?php echo $date_out?></p>
                                            <div class="d-flex justify-content-between">
                                                <p class="item-info"><?php echo $thongbao['TB_NOIDUNG'];?></p>
                                                <a class="btn btn-danger text-decoration-none" href="nd_thongbao_xoa.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                                    Xoá
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    endwhile;
else:?>
                                    <div class="noti-container">
                                        <h5 class="card-title my-2 mx-2"><?php echo "Tạm thời không có thông báo.";endif;?></h5>
                                    </div>

                                </div>
                                <div class="notification-footer">
                                </div>
                            </ul>
                        </div>
                        <a class="btn btn-outline-light px-2 py-2 me-2" href="dangxuat.php" role="button">ĐĂNG XUẤT</a>
                    </div>
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
                        <li><a class="dropdown-item" href="nd_cv_cho.php">Đang chờ</a></li>
                        <li><a class="dropdown-item" href="nd_cv_thuchien.php">Đang thực hiện</a></li>
                        <li><a class="dropdown-item" href="nd_cv_giamsat.php">Đang giám sát</a></li>
                        <li><a class="dropdown-item" href="nd_cv_hoanthanh.php">Đã hoàn thành</a></li>
                        <li><a class="dropdown-item" href="nd_cv_quahan.php">Quá hạn</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="form_center">
            <div class="rounded bg-white mb-5 form_container">

                <div class="p-3 my-5">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h5 class=" text-center">Cập nhật công việc</h5>
                    </div>
                    <form id="form" name="form" method="POST" class="form form_admin">
                        <div class="col mt-2">
                            <div class="col"><label for="loai" class="labels">Loại công việc</label>
                                <input type="text" readonly class="form-control" name="loai" id="loai" value="<?php
$lcv_id = $cv['LCV_MA'];
$lcv = "SELECT * FROM loaicongviec WHERE LCV_MA='$lcv_id'";
$lcv_data = mysqli_query($conn, $lcv);
$lcv_current = mysqli_fetch_array($lcv_data);
echo $lcv_current['LCV_TEN'];
?>
                            
                            ">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="mt-2 col">
                                <label class="labels" for="ten">Tên công việc</label>
                                <input required type="text" id="ten" name="ten" class="form-control" placeholder="Nhập tên công việc" readonly value="<?php echo $cv['CV_TEN'];?>">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="mt-2 col"><label for="ngaybatdau" class="labels">Ngày bắt đầu</label>
                                <input required type="date" min='1899-01-01' max='2100-01-01' id="ngaybatdau" name="ngaybatdau" class="form-control" placeholder="Ngày bắt đầu" readonly
                                    value="<?php echo $cv['CV_NGAYBATDAU'];?>">
                            </div>
                            <div class="mt-2 col"><label for="ngayketthuc" class="labels">Ngày kết thúc</label>
                                <input required type="date" min='1899-01-01' max='2100-01-01' id="ngayketthuc" name="ngayketthuc" class="form-control" placeholder="Ngày kết thúc" readonly
                                    value="<?php echo $cv['CV_NGAYKETTHUC'];?>">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="mt-2 col"><label class="labels" for="noidung">Nội dung công việc</label><textarea readonly type="text" id="noidung" name="noidung" rows=4 class="form-control"
                                    placeholder="Nhập nội dung"><?php echo $cv['CV_NOIDUNG'];?></textarea>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="mt-2 col"><label for="tiendo" class="labels">Tiến độ</label>
                                <input required type="number" min="<?php echo $cv['CV_TIENDO'];?>" max="100" id="tiendo" name="tiendo" id="tiendo" class="form-control" placeholder="Tiến độ"
                                    value="<?php echo $cv['CV_TIENDO'];?>">
                            </div>
                            <div class="mt-2 col"><label for="trangthai" class="labels">Trạng thái</label>
                                <input required type="text" id="trangthai" name="trangthai" id="trangthai" class="form-control" placeholder="Trạng thái" readonly
                                    value="<?php echo $cv['CV_TRANGTHAICV'];?>">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="mt-2 col"><label for="ngaytao" class="labels">Ngày tạo</label>
                                <input required type="date" id="ngaytao" name="ngaytao" class="form-control" placeholder="Ngày tạo" readonly value="<?php echo $cv['CV_NGAYTAO'];?>">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="mt-2 col"><label class="labels" for="nguoithuchien">Người thực hiện</label>
                                <input readonly type="text" class="form-control" id="nguoithuchien" placeholder="Người thực hiện" name="nguoithuchien" value="<?php $user_id = $cv['CV_NTH'];
$user = "SELECT * FROM nguoidung WHERE ND_MA='$user_id'";
$user_data = mysqli_query($conn, $user);
$user_current = mysqli_fetch_array($user_data);
echo $user_current['ND_HOTEN'];?> ">
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="mt-2 col">
                                <label class="labels">Người giám sát</label>

                                <input type="text" readonly class="form-control" placeholder="Người giám sát" id="nguoigiamsat" name="nguoigiamsat" value="<?php
                            $user_id = $cv['CV_NGS'];
$user = "SELECT * FROM nguoidung WHERE ND_MA='$user_id'";
$user_data = mysqli_query($conn, $user);
$user_current = mysqli_fetch_array($user_data);
echo $user_current['ND_HOTEN'];
?> ">
                            </div>

                        </div>
                        <div class="d-flex mt-5 text-center justify-content-center">
                            <a href="<?php echo $link?>" class="btn btn-dark profile-button w-25 mx-2" name="submit" type="submit">Quay lại</a>
                            <button class="btn btn-success profile-button w-25 mx-2" name="submit" type="submit">Cập nhật</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer class="fixed-bottom footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>
</body>
<script>
var prevScrollpos = window.pageYOffset;

/* Get the header element and it's position */
var headerDiv = document.querySelector("nav");
var mainDiv = document.querySelector("main");
var headerBottom = headerDiv.offsetTop + headerDiv.offsetHeight;

window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;

    /* if scrolling down, let it scroll out of view as normal */
    if (prevScrollpos <= currentScrollPos) {
        headerDiv.classList.remove("fixed-top");
        headerDiv.style.top = "-7.2rem";
        mainDiv.style.marginTop = "0";
    }
    /* otherwise if we're scrolling up, fix the nav to the top */
    else {
        headerDiv.classList.add("fixed-top");
        headerDiv.style.top = "0";
        mainDiv.style.marginTop = "80px";

    }

    prevScrollpos = currentScrollPos;
}
</script>

</html>