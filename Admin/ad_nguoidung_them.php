<?php include_once '../condb/condb.php';
include_once './ad_thongbao.php'; 
if ((!isset($_SESSION['admin']))) {
    session_destroy();
    unset($_SESSION['admin']);
    header("location: ../index.php");
}?>
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
    <title>Thêm tài khoản</title>
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
                                            <p class="item-info"><?php echo $thongbao['TB_ND']?></p>
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

        <div class="form_center">
            <div class="rounded bg-white mb-5 form_container">

                <div class="p-3 py-5">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h5 class=" text-center">Thêm người dùng mới</h5>
                    </div>
                    <form id="form" name="form" method="POST" class="form form_admin">
                        <div class="col mt-2">
                            <div class="col"><label for="name" class="labels">Họ và tên</label><input type="text" required name="name" id="name" class="form-control" placeholder="Họ và tên">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="mt-2 col">
                                <label class="labels">Email</label>
                                <input required type="text" id="email" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="mt-2 col"><label for="ngaysinh" class="labels">Ngày sinh</label>
                                <input id="ngaysinh" required type="date" min='1899-01-01' max='2100-01-01' name="ngaysinh" class="form-control" placeholder="Ngày sinh">
                            </div>
                            <div class="mt-2 col"><label class="labels">Số điện thoại</label>
                                <input required type="text" id="sdt" name="sdt" class="form-control" placeholder="Số điện thoại">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="mt-2 col"><label class="labels">Địa chỉ</label><input required type="text" id="diachi" name="diachi" class="form-control" placeholder="Địa chỉ">
                            </div>
                        </div>


                        <div class="row mt-2">
                            <div class="mt-2 col"><label class="labels">MSCB</label><input required type="text" id="mscb" name="mscb" class="form-control" placeholder="MSCB">
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="mt-2 col"><label class="labels">Mật khẩu</label><input required type="password" id="pass1" name="pass1" class="form-control" placeholder="Mật khẩu">
                            </div>
                            <div class="mt-2 col"><label class="labels">Nhập lại mật khẩu</label><input required type="password" id="pass2" name="pass2" class="form-control"
                                    placeholder="Nhập lại mật khẩu">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button w-50" name="them" type="submit">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>


    <footer id="grad1" class="justify-content-center navbar p-3 text-white ">
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
    var password = document.getElementById("pass1"),
        confirm_password = document.getElementById("pass2");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Mật khẩu không khớp.");
        } else {
            confirm_password.setCustomValidity('');
        }
    }



    function nameValid(string) {
        var re = /^[a-zA-Z !@#\$%\^\&*\)\(+=._-]{2,}$/g // regex here
        return re.test(removeAscent(string))
    }

    function validateName() {
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
    password.onchange = validatePassword;
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