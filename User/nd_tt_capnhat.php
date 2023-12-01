<?php
// Update User
include_once('../condb/condb.php');
$ma = $_GET['capnhat_nd_ma'];

$query_nd = "SELECT * FROM nguoidung WHERE ND_MA='$ma'";

$nguoidung_data = mysqli_query($conn, $query_nd);
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

        <div class="form_center ">
            <form id="form" name="form" method="POST" onsubmit="return validateForm()" class="form ">
                <div class="navbar_container shadow-lg p-0 mb-5 rounded p-5 py-4 m-2 border border-2">
                    <h1 class="text-light text-center">CẬP NHẬT THÔNG TIN</h1>
                    <hr class="text-dark border border-2 rounded " style="border-top: 4px solid white">
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="name">Điền họ và tên:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" placeholder="Họ và tên" name="name" id="name" value="<?php echo $nguoidung['ND_HOTEN'];?> ">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1   text-light">
                            <label for="diachi">Địa chỉ:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" name="diachi" id="diachi" value="<?php echo $nguoidung['ND_DIACHI'];?> ">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1   text-light">
                            <label for="ngaysinh">Ngày tháng năm sinh:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="date" name="ngaysinh" id="ngaysinh" value="<?php echo $nguoidung['ND_NGAYSINH'];?> ">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="sdt">Số điện thoại:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="tel" name="sdt" id="sdt" value="<?php echo $nguoidung['ND_SDT'];?> ">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="email">Email:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" name="email" id="email" value="<?php echo $nguoidung['ND_EMAIL'];?> ">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="mscb">Mã số cán bộ:</label>
                        </div>
                        <div class="col p-1  ">
                            <input class="form-control" type="text" name="mscb" id="mscb" value="<?php echo $nguoidung['ND_MSCB'];?> ">
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
</body>

</html>