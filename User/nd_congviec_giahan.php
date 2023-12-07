<?php include_once '../condb/condb.php';
if ((!isset($_SESSION['nguoidung']))) {
    session_destroy();
    unset($_SESSION['nguoidung']);
    header("location: ../index.php");
}
$email = $_SESSION['nguoidung'];
$query = "select * from nguoidung where ND_EMAIL ='$email'";
$sql = mysqli_query($conn, $query);
$nguoidung = mysqli_fetch_assoc($sql);
$nd_ma = $nguoidung['ND_MA'];
?>

<?php
$ma = $_GET['giahan_ma'];
$query_gh = "SELECT * FROM giahancongviec WHERE CV_MA='$ma'";
$result = $conn->query($query_gh);
if ($result->num_rows > 0) {
    alert_and_redirect("Đã gửi yêu cầu !!!", "nguoidung.php");
}


$querry_cv = "SELECT * FROM congviec WHERE CV_MA='$ma'";

$cv_data = mysqli_query($conn, $querry_cv);
$cv = mysqli_fetch_array($cv_data);
$nguoidung_tb = $cv['CV_NTH'];
$hancu = $cv['CV_NGAYKETTHUC'];


if(isset($_POST['submit'])) {
    $hanmoi = $_POST['hanmoi'];
    $noidung = $_POST['noidung'];
    try {
        if($hanmoi <= $hancu) {
            header("Location: nguoidung.php");
            throw new Exception("Hạn mới không hợp lệ.");
        }
        $sql = "INSERT INTO giahancongviec(ND_MA,CV_MA,GH_NOIDUNG, GH_NGAY)
                 VALUES ('$nguoidung_tb','$ma','$noidung','$hanmoi')";

        $query = mysqli_query($conn, $sql);
        $sql_thongbao = "INSERT INTO thongbao
                        (ND_MA, CV_MA,TB_NOIDUNG, TB_TG, TB_XEM)
                        VALUES ('$nguoidung_tb','$ma','Yêu cầu gia hạn công việc',NOW(), '0')";
        $query_thongbao = mysqli_query($conn, $sql_thongbao);

    } catch (mysqli_sql_exception $e) {
        var_dump($e);
        exit;

    }


    if ($query) {

        echo "Đã gửi yêu cầu!";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Gia hạn thời gian công việc</title>
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
                <div class="">
                    <a class="btn btn-outline-light px-2 py-2 me-2" href="dangxuat.php" role="button">ĐĂNG XUẤT</a>
                </div>
            </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="sidebar_content" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header custom-bg text-light">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel">
                    <?php echo $nguoidung['ND_HOTEN'];?>
                </h3>

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
            <div class="rounded bg-white mb-5 form_container">

                <div class="p-3 my-5">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h5 class=" text-center">Xin gia hạn thời gian</h5>
                    </div>
                    <form id="form" name="form" method="POST" class="form form_admin">
                        <div class="row mt-2">
                            <div class="mt-2 col">
                                <label class="labels" for="ten">Ngày gia hạn mới</label>
                                <input class="form-control" type="date" name="hanmoi" min="<?php echo $cv['CV_NGAYKETTHUC']?>" id="hanmoi" value="<?php
                                $datetime = new DateTime('now');
                                $new_date = $datetime->format('Y-m-d');
                                echo $new_date ?>">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="mt-2 col">
                                <label class="labels" for="ten">Nội dung</label>
                                <textarea class="form-control" name="noidung" id="noidung" cols="30" rows="5" placeholder="Nhập nội dung"></textarea>
                            </div>
                        </div>


                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button w-50" name="submit" type="submit">Gửi đề nghị</button>
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