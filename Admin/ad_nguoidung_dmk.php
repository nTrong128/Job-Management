<?php
// Update User
include_once('../condb/condb.php');
include_once('./ad_thongbao.php');
if ((!isset($_SESSION['admin']))) {
    session_destroy();
    unset($_SESSION['admin']);
    header("location: ../index.php");
}

$ma = $_GET['dmk_nd_ma'];
$query_nd = "SELECT * FROM nguoidung WHERE ND_MA='$ma'";
$nguoidung_data = mysqli_query($conn, $query_nd);
$nguoidung = mysqli_fetch_array($nguoidung_data);
$mkcu_nd = $nguoidung['ND_MATKHAU'];

if(isset($_POST['submit'])) {
    $password = $_POST['pass1'];
    $repassword = $_POST['pass2'];
    try {

        $sql = "UPDATE nguoidung
                SET ND_MATKHAU=md5('$password')
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
                                                <p class="item-info"><?php echo $thongbao['TB_NOIDUNG']?></p>></p>
                                                <a class="btn btn-danger text-decoration-none" href="ad_thongbao_xoa.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
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
                        <a class="btn btn-outline-light px-2 py-2 me-2" href="./dangxuat.php" role="button">ĐĂNG XUẤT</a>
                    </div>
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

            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-end">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="../Image/default_avatar.jpg" width="200">
                            <span class="font-weight-bold"><?php echo $nguoidung['ND_HOTEN'];?></span>
                            <span class="text-black-50"><?php echo $nguoidung['ND_EMAIL'];?></span>
                            <span><?php echo$nguoidung['ND_DIACHI'];?></span>

                            <div class="mt-5 text-center">
                                <!-- <a href="nd_tt_doiavatar.php?da_nd_ma=<?php echo $ma?>" class="btn btn-outline-success mb-2" name="avatar_change" type="avatar">Đổi ảnh đại diện</a> -->
                                <a href="nd_tt_doimatkhau.php?dmk_nd_ma=<?php echo $ma?>" class="btn btn-outline-success mb-2" name="doimatkhau" type="doimatkhau">Đổi mật khẩu</a>
                            </div>

                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <h5 class=" text-center">Cập nhật thông tin người dùng</h5>
                            </div>
                            <form id="form" name="form" method="POST" class="form">
                                <div class="mt-2 col-md-12">
                                    <label class="labels">Nhập mật khẩu mới</label>
                                    <input required type="password" id="pass1" name="pass1" class="form-control" placeholder="Mật khẩu mới">
                                </div>
                                <div class="mt-2 col-md-12">
                                    <label class="labels">Nhập lại mật khẩu mới</label>
                                    <input required type="password" id="pass2" name="pass2" class="form-control" placeholder="Nhập lại mật khẩu mới">
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button w-50" name="submit" type="submit">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>


    <footer class="footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>

    <script>
    var password = document.getElementById("pass1"),
        confirm_password = document.getElementById("pass2");

    function passValid(string) {
        var re = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/
        return re.test(string)
    }

    function validatePassword() {
        if (!passValid(password.value)) {
            password.setCustomValidity("Mật khẩu phải từ 8 ký tự (bao gồm chữ và số, có ít nhất 1 ký tự in hoa và 1 ký tự đặc biệt)");
        } else {
            password.setCustomValidity('');
        }
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Mật khẩu không khớp");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onkeyup = validatePassword;
    confirm_password.onkeyup = validatePassword;
    </script>
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
</body>

</html>