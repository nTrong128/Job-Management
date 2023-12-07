<?php
// Update User
include_once('../condb/condb.php');
if ((!isset($_SESSION['nguoidung']))) {
    session_destroy();
    unset($_SESSION['nguoidung']);
    header("location: ../index.php");
}
$ma = $_GET['capnhat_nd_ma'];

$query_nd = "SELECT * FROM nguoidung WHERE ND_MA='$ma'";

$nguoidung_data = mysqli_query($conn, $query_nd);
$nguoidung = mysqli_fetch_array($nguoidung_data);


if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $ngaysinh = $_POST['ngaysinh'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $mscb = $_POST['mscb'];
    try {

        $sql = "UPDATE nguoidung
                SET ND_HOTEN='$name',
                    ND_NGAYSINH='$ngaysinh',
                    ND_DIACHI='$diachi',
                    ND_SDT='$sdt',
                    ND_EMAIL='$email',
                    ND_MSCB='$mscb'
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
                                    <h5 class=" text-center">Cập nhật thông tin cá nhân</h5>
                                </div>
                                <form id="form" name="form" method="POST" class="form">
                                <div class="row mt-2">
                                    <div class="col"><label for="name" class="labels">Họ và tên</label>
                                    <input id="name" type="text" required name="name" class="form-control" placeholder="Họ và tên"
                                            value="<?php echo $nguoidung['ND_HOTEN'];?>"></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="mt-2 col-md-12"><label for="ngaysinh" class="labels">Ngày sinh</label><input id="ngaysinh" required type="date" name="ngaysinh" class="form-control"
                                            placeholder="Ngày sinh" value="<?php echo $nguoidung['ND_NGAYSINH'];?>"></div>
                                    <div class="mt-2 col-md-12"><label class="labels">Số điện thoại</label><input required type="text"  id="sdt" name="sdt" class="form-control" placeholder="Số điện thoại"
                                            value="<?php echo $nguoidung['ND_SDT'];?>">
                                    </div>
                                    <div class="mt-2 col-md-12"><label class="labels">Địa chỉ</label><input required type="text" id="diachi" name="diachi" class="form-control" placeholder="Địa chỉ"
                                            value="<?php echo $nguoidung['ND_DIACHI'];?>"></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="mt-2 col-md-6"><label class="labels">Email</label><input readonly required type="text" id="email" name="email" class="form-control" placeholder="Email"
                                            value="<?php echo $nguoidung['ND_EMAIL'];?>">
                                    </div>
                                    <div class="mt-2 col-md-6"><label class="labels">MSCB</label><input readonly required type="text" id="mscb" name="mscb" class="form-control"
                                            value="<?php echo $nguoidung['ND_MSCB'];?>" placeholder="MSCB">
                                    </div>
                                </div>
                                <div class="mt-5 text-center"><button class="btn btn-primary profile-button w-50" name="submit" type="submit">Lưu</button></div>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            
        </div>
    </main>


    <footer class="fixed-bottom footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>
    <script>
    function removeAscent(str) {
        if (str === null || str === undefined) return str;
        str = str.toLowerCase();
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");

        return str;
    }

    var nameInput = document.getElementById("name");
    var phoneInput = document.getElementById("sdt");
    var addInput = document.getElementById("diachi");
    var emailInput = document.getElementById("email");
    var mscbInput = document.getElementById("mscb");

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
    



    function nameValid(string) {
        var re = /^[a-zA-Z !@#\$%\^\&*\)\(+=._-]{2,}$/g // regex here
        return re.test(removeAscent(string))
    }

    function validateName() {
        console.log("validateName");
        if (!nameValid(nameInput.value)) {
            nameInput.setCustomValidity("Tên từ 2 kí tự, không có kí tự đặc biệt, không có số");

        } else {
            nameInput.setCustomValidity('');

        }
    }

    function phonevalid(string) {
        var re = /^\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/
        return re.test(string)
    }

    function validatePhone() {
        if (!phonevalid(phoneInput.value)) {
            phoneInput.setCustomValidity("Số điện thoại không hợp lê");

        } else {
            phoneInput.setCustomValidity('');

        }
    }

    function validateAdd() {
        if (addInput.value.length < 5) {
            addInput.setCustomValidity("Địa chỉ phải dài hơn 5 ký tự");
        } else {
            addInput.setCustomValidity('');
        }
    }

    function emailValid(string) {
        var re = /^\S+@\S+\.\S+$/
        return re.test(string)
    }

    function validateEmail() {
        if (!emailValid(emailInput.value)) {
            emailInput.setCustomValidity("Địa chỉ email không hợp lệ");
        } else {
            emailInput.setCustomValidity('');

        }
    }

    function validateMSCB() {
        if (mscbInput.value.length != 6) {
            mscbInput.setCustomValidity("Mã số cán bộ có 6 kí tự");
        } else {
            mscbInput.setCustomValidity('');
        }
    }
    mscbInput.onkeyup = validateMSCB;
    emailInput.onkeyup = validateEmail;
    addInput.onkeyup = validateAdd;
    phoneInput.onkeyup = validatePhone;
    nameInput.onkeyup = validateName;

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