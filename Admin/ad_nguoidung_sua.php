<?php
// Update User
include_once('../condb/condb.php');
include_once('./ad_thongbao.php');
if ((!isset($_SESSION['admin']))) {
    session_destroy();
    unset($_SESSION['admin']);
    header("location: ../index.php");
}

$ma = $_GET['capnhat_ma'];

$query_nguoidung = "SELECT * FROM nguoidung WHERE ND_MA='$ma'";

$nguoidung_data = mysqli_query($conn, $query_nguoidung);
$nguoidung = mysqli_fetch_array($nguoidung_data);


if(isset($_POST['submit'])) {
$name = $_POST['name'];
$ngaysinh = $_POST['ngaysinh'];
$diachi = $_POST["diachi"];
$sdt = $_POST['sdt'];
$email = $_POST["email"];
$mscb = $_POST["mscb"];
$password = $_POST["passwd"];
try {

$sql = "UPDATE nguoidung
SET ND_HOTEN='$name',
ND_NGAYSINH='$ngaysinh',
ND_DIACHI='$diachi',
ND_SDT='$sdt',
ND_EMAIL='$email',
ND_MSCB='$mscb',
ND_MATKHAU=md5('$password')
WHERE ND_MA=$ma";

$query = mysqli_query($conn, $sql);

} catch (mysqli_sql_exception $e) {
var_dump($e);
exit;

}


if ($query) {

echo "Cập nhật thành công!";
header("Location: ad_nguoidung_ds.php");

} else {

echo "Error updating row.: " . $conn->error;

}

}
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
    <title>Cập nhật thông tin người dùng</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand custom_navbar_bg fixed-top border-bottom border-light border-3">
            <button class=" btn mx-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="fa-solid fs-2 text-light fa-bars"></i>
            </button>
            <div class="container-fluid">
                <a class="navbar-brand text-white fs-4" href="ad_trangchu.php"><img src="../image/logo.png" style="width: 60px;" class="w3-circle"></a>
                <a class="navbar-brand text-white fs-2"> QUẢN LÝ CÔNG VIỆC </a>
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
                            <div class="notification-heading d-flex justify-content-between">
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
                                            <a class="text-decoration-none  btn btn-dark" href="ad_thongbao_doc.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                                Đánh dấu đã đọc
                                            </a>
                                            <?php else: ?>
                                            <a class="text-decoration-none btn btn-dark" href="ad_thongbao_chuadoc.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                                Đánh dấu là chưa đọc
                                            </a>
                                            <?php endif;?>
                                        </div>
                                        <p class="item-info">Người thực hiện: <?php echo $thongbao['ND_HOTEN'] ?></p>
                                        <?php 
                                        // $start_date = date_create($thongbao['TB_TG']);
                                        
                                        // $date_out = timeAgo($start_date);
                                        $date_out = timeAgo($thongbao['TB_TG']);
                                        
                                        ?>
                                        <p class="item-info"><?php echo $date_out?></p>
                                        <div class="d-flex justify-content-between">
                                            <p class="item-info"><?php echo $thongbao['TB_ND']?></p>
                                            <a class="btn btn-danger text-decoration-none" href="ad_thongbao_xoa.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                                Xoá
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="noti-container">
                                    <?php
    endwhile;
else:?><h5 class="card-title m-0"><?php echo "Tạm thời không có thông báo.";endif;?></h5>
                                </div>

                            </div>
                            <li class="divider"></li>
                            <div class="notification-footer">
                            </div>
                        </ul>
                    </div>
                    <a class="btn btn-outline-light px-2 py-2 me-2" href="./dangxuat.php" role="button">ĐĂNG XUẤT</a>
                </div>
            </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header custom-bg text-light">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel">
                    ADMIN
                </h3>

                <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="fa-solid fa-xmark fa-2xl" style="color: #ffffff;"></i>
                </button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <a href="ad_trangchu.php" type="button" class="btn btn-outline-secondary w-100 my-1 py-2">Trang chủ</a>
                </div>
                <div>
                    <a href="ad_nguoidung_ds.php" type="button" class="btn btn-outline-secondary w-100 my-1 py-2">Danh sách người dùng</a>
                </div>
                <div>
                    <a href="ad_congviec_ds.php" type="button" class="btn btn-outline-secondary w-100 my-1 py-2">Danh sách công việc</a>
                </div>
                <div>
                    <a href="ad_thongke.php" type="button" class="btn btn-outline-secondary w-100 my-1 py-2">Báo cáo thống kê</a>
                </div>
            </div>
        </div>




        <div class="form_center">
            <form id="form" name="form" method="POST" onsubmit="return validateForm()" class="form">
                <div class="container p-5 py-4 m-2 border border-2 rounded">
                    <h1 class="text-light text-center">CẬP NHẬT THÔNG TIN</h1>
                    <hr class="text-dark border border-2 rounded " style="border-top: 4px solid white">
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="name">Điền họ và tên:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" placeholder="Họ và tên" name="name" id="name" value="<?php echo $nguoidung['ND_HOTEN'];?>">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1   text-light">
                            <label for="diachi">Địa chỉ:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" name="diachi" id="diachi" value="<?php echo $nguoidung['ND_DIACHI'];?>">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1   text-light">
                            <label for="ngaysinh">Ngày tháng năm sinh:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="date" name="ngaysinh" id="ngaysinh" value="<?php echo $nguoidung['ND_NGAYSINH'];?>">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="sdt">Số điện thoại:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="tel" name="sdt" id="sdt" value="<?php echo $nguoidung['ND_SDT'];?>">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="email">Email:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" name="email" id="email" value="<?php echo$nguoidung['ND_EMAIL'];?>">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="mscb">Mã số cán bộ:</label>
                        </div>
                        <div class="col p-1  ">
                            <input class="form-control" type="text" name="mscb" id="mscb" value="<?php echo$nguoidung['ND_MSCB'];?>">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="passwd">Mật khẩu:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="password" placeholder="Mật khẩu" name="passwd" id="passwd">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="passwd2">Xác nhận mật khẩu:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="password" placeholder="Xác nhận mật khẩu" name="passwd2" id="passwd2">
                        </div>
                    </div>
                    <div>

                    </div>
                    <div class="btn_form ">
                        <button style="width:100%" type="submit" class="btn  btn-dark" name="submit">CẬP NHẬT</button>
                    </div>
                </div>
            </form>
        </div>
    </main>


    <footer class="footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>

    <script>
    var password = document.getElementById("passwd"),
        confirm_password = document.getElementById("passwd2");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Mật khẩu không khớp.");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    document.addEventListener("DOMContentLoaded", function() {
        var elements = document.getElementsByTagName("INPUT");
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function(e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity("Trường này là bắt buộc.");
                }
            };
            elements[i].oninput = function(e) {
                e.target.setCustomValidity("");
            };
        }
    })
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
</body>

</html>