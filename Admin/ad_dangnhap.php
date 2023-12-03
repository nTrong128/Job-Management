<?php include_once '../condb/condb.php'; ?>
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
    <title>Đăng nhập tài khoản</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand custom_navbar_bg fixed-top border-bottom border-light border-3">
            <div class="container-fluid">
                <a class="navbar-brand text-light fs-2" href="trangchu.php"><img src="../image/logo.png" style="width: 50px;" class="w3-circle"> QUẢN LÝ CÔNG VIỆC</a>
                <!-- <a class="btn btn-outline-light px-3 py-3 me-2" href="dangky.php" role="button">ĐĂNG KÝ</a> -->
            </div>
        </nav>
    </header>
    <main>


        <div class="form_center">
            <form action="" method="POST">
                <div class="navbar_container text-light  p-5 py-4 m-2 border border-2 rounded">
                    <h1 class="text-center">ĐĂNG NHẬP TÀI KHOẢN</h1>
                    <hr class="border border-dark rounded-2 border-2 opacity-50">

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="text-light" for="email">Email:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" placeholder="Nhập email" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="passwd">Mật khẩu:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="password" placeholder="Nhập mật khẩu" name="passwd" id="passwd" required>
                        </div>
                    </div>
                    <div class="btn_form m-2"><a class="log_as_admin" href="../User/dangnhap.php">Đăng nhập với tư cách người dùng ?</a></div>
                    <div class="btn_form ">
                        <button style="width:100%" type="submit" class="btn  btn-dark" action="" name="dangnhapAdmin">ĐĂNG NHẬP</button>
                    </div>

                </div>

            </form>

        </div>

    </main>



    <footer class="footer_container d-flex justify-content-center p-3 text-dark">
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