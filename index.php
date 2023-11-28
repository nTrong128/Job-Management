<?php include_once './condb/condb.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="./image/logo.png" />
    <link href="./styles/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Trang chủ</title>
</head>

<body>
    <header>
        <nav class="navbar_container navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand text-white fs-2" href="index.php"><img src="./image/logo.png" style="width: 50px" class="w3-circle" />
                    QUẢN LÝ CÔNG VIỆC</a>
                <div>
                    <a class="btn btn-outline-light px-4 py-3 me-2" href="./User/dangky.php" role="button">ĐĂNG KÝ</a>
                    <a class="btn btn-outline-light px-3 py-3 me-2" href="./User/dangnhap.php" role="button">ĐĂNG NHẬP</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="" style="min-height:500px;"></div>
    </main>

    <footer class="footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>
</body>

</html>