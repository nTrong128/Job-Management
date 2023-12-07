<!-- <?php include_once '../condb/condb.php'; ?> -->
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
    <title>Đăng ký tài khoản</title>
</head>

<body>
    <header>
        <nav class="navbar_container navbar  navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand text-white fs-2" href="../index.php"><img src="../image/logo.png" style="width: 50px;" class="w3-circle"> QUẢN LÝ CÔNG VIỆC</a>
                <a class="btn btn-outline-light px-3 py-3 me-2" href="dangnhap.php" role="button">ĐĂNG NHẬP</a>
            </div>
        </nav>
    </header>

    <main>

        <div class="form_center">
            <form action="dangky.php" id="form" name="form" method="post" onsubmit="return validateForm()" class="form shadow-lg p-0 mb-5 rounded">
                <div class="navbar_container p-5 py-4 border border-2 rounded">
                    <h1 class="text-light text-center">ĐĂNG KÝ TÀI KHOẢN</h1>
                    <hr class="text-dark border border-2 rounded " style="border-top: 4px solid white">

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="name">Điền họ và tên:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" placeholder="Họ và tên" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1   text-light">
                            <label for="diachi">Địa chỉ:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" name="diachi" id="diachi" placeholder="Nhập địa chỉ của bạn" required>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="sdt">Số điện thoại:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="tel" name="sdt" id="sdt" placeholder="Nhập số điện thoại" required>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="email">Email:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" placeholder="Nhập email" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="mscb">Mã số cán bộ:</label>
                        </div>
                        <div class="col p-1  ">
                            <input class="form-control" type="text" placeholder="Nhập mã số cán bộ:" name="mscb" id="mscb" required>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="passwd">Mật khẩu:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="password" placeholder="Mật khẩu" name="passwd" id="passwd" required>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="passwd2">Xác nhận mật khẩu:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="password" placeholder="Xác nhận mật khẩu" name="passwd2" id="passwd2" required>
                        </div>
                    </div>
                    <div>
                        <div class="form-check text-light mb-3">
                            <input class="form-check-input" type="checkbox" id="myCheck" name="remember" required>
                            <label class="form-check-label" for="myCheck">Tôi đồng ý điều khoản và chính sách bảo mật.</label>
                        </div>
                    </div>
                    <div class="btn_form ">
                        <button style="width:100%" type="submit" class="btn  btn-dark" name="dangky">ĐĂNG KÝ</button>
                    </div>
                </div>
            </form>
        </div>
    </main>


    <footer class="footer_container d-flex justify-content-center p-3 text-dark">
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