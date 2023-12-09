<?php include_once './condb/condb.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./image/logo.png">
    <link href="./styles/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Đăng nhập tài khoản</title>
</head>

<body>
    <main>

        <div class="form_center">

            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-5 border-end">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle" src="./Image/logo.png" width="200">
                            <h4 class="mt-4 my-2">QUẢN LÝ CÔNG VIỆC</h4>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 pb-2">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <h2 class=" text-center">ĐĂNG NHẬP</h2>
                            </div>
                            <hr class="border border-dark rounded-2 border-2 opacity-50">

                            <form id="form" name="form" method="POST" class="form form_admin">
                                <div class="row mt-1">
                                    <div class="mt-2 col"><label class="labels">Email</label><input required type="email" id="email" name="email" class="form-control" placeholder="Địa chỉ Email">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="mt-1 col"><label class="labels">Mật khẩu</label><input required type="password" id="passwd" name="passwd" class="form-control"
                                            placeholder="Nhập mật khẩu">
                                    </div>
                                </div>

                                <div class="my-2 text-center">
                                    <div class="btn_form"><a class="log_as_admin text-dark" href="./admin/ad_dangnhap.php">Đăng nhập với tư cách ADMIN ?</a></div>

                                </div>
                                <div class="my-2 text-center">
                                    <button class="btn btn-primary profile-button w-50" name="dangnhap" type="dangnhap">Đăng nhập</button>
                                </div>
                                <div class="my-2 text-center">
                                    <div class="btn_form">Chưa có tài khoản? <a class="log_as_admin text-dark" href="./User/dangky.php"> Đăng ký</a></div>

                                </div>
                            </form>
                        </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </main>



    <!-- <footer class="fixed-bottom footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer> -->
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