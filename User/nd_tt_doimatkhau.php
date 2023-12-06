<?php
// Update User
include_once('../condb/condb.php');
if ((!isset($_SESSION['nguoidung']))) {
    session_destroy();
    unset($_SESSION['nguoidung']);
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
        header("Location: nguoidung.php");

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
    <link rel="stylesheet" href="../styles/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="../js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-md5@0.8.3/src/md5.min.js"></script>
    <title>Người dùng</title>
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
                <a class="btn btn-outline-light px-2 py-2 me-2" href="dangxuat.php" role="button">ĐĂNG XUẤT</a>
            </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="sidebar_content" aria-labelledby="offcanvasExampleLabel">
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

            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-5 border-end">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle" src="../Image/default_avatar.jpg" width="200">

                            <span class="font-weight-bold"><?php echo $nguoidung['ND_HOTEN'];?></span>
                            <span class="text-black-50"><?php echo $nguoidung['ND_EMAIL'];?></span>
                            <span><?php echo$nguoidung['ND_DIACHI'];?></span>

                            <div class="mt-5 text-center">
                                <a href="nd_tt_doiavatar.php?da_nd_ma=<?php echo $ma?>" class="btn btn-outline-success mb-2" name="avatar_change" type="avatar">Đổi ảnh đại diện</a>
                                <a href="nd_tt_doimatkhau.php?dmk_nd_ma=<?php echo $ma?>" class="btn btn-outline-success mb-2" name="doimatkhau" type="doimatkhau">Đổi mật khẩu</a>
                            </div>

                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <h3 class="text-right">Đổi mật khẩu</h3>
                            </div>
                            <div class="row">
                                <form id="form" name="form" method="POST" class="form">
                                    <div class="mt-2 col-md-12">
                                        <label class="labels">Nhập mật khẩu cũ</label>
                                        <input required type="password" id="old_pass" name="oldpass" class="form-control" placeholder="Mật khẩu cũ">
                                    </div>
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

        </div>
    </main>


    <footer class="footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>

    <script>
    var old_password = document.getElementById("old_pass");
    var password = document.getElementById("pass1"),
        confirm_password = document.getElementById("pass2");


    function validatePassword() {
        var old_pass_db = '<?php echo $mkcu_nd;?>';

        var olb_pass_input = md5(old_password.value);

        if (old_pass_db != olb_pass_input) {
            old_password.setCustomValidity("Mật khẩu cũ không đúng");
        } else {
            old_password.setCustomValidity('');
        }

        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Mật khẩu không khớp");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    old_pass.onkeyup = validatePassword;
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    </script>
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