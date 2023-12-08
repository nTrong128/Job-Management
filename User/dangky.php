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
                <a class="btn btn-outline-light px-3 py-3 me-2" href="../index.php" role="button">ĐĂNG NHẬP</a>
            </div>
        </nav>
    </header>

    <main>

        <div class="form_center">
            <div class="rounded bg-white mb-5 form_container">

                <div class="p-3 py-5">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h5 class=" text-center">Đăng ký</h5>
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
                            <button class="btn btn-primary profile-button w-50" name="dangky" type="dangky">Đăng ký</button>
                        </div>
                    </form>
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