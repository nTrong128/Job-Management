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
                <a class="navbar-brand text-white fs-2" href="trangchu.php"><img src="../image/logo.png" style="width: 50px;" class="w3-circle"> QUẢN LÝ CÔNG VIỆC</a>
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