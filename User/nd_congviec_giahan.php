<?php
// Update User
include_once('../condb/condb.php');
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
        $sql = "INSERT INTO giahancongviec(CV_MA,GH_NOIDUNG, GH_NGAY)
                 VALUES ('$ma','$noidung','$hanmoi')";

        $query = mysqli_query($conn, $sql);
        $sql_thongbao = "INSERT INTO thongbao
                        (ND_MA, CV_MA,TB_ND, TB_TG, TB_XEM)
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
        <nav class="navbar_container navbar  navbar-expand-lg">
            <button class=" btn mx-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="fa-solid fs-2 text-light fa-bars"></i>
            </button>
            <div class="container-fluid">
                <a class="navbar-brand text-white fs-4" href="nguoidung.php"><img src="../image/logo.png" style="width: 60px;" class="w3-circle"></a>
                <a class="navbar-brand text-white fs-2"> QUẢN LÝ CÔNG VIỆC </a>

                <div class="text-light fs-5">
                    <?php if (isset($_SESSION['success'])) : ?>
                    <div class="error success">
                        <h3>
                            <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                        </h3>
                    </div>

                    <?php endif ?>


                    <a class="btn btn-outline-light px-2 py-2 me-2" href="trangchu.php" role="button">ĐĂNG XUẤT</a>
                </div>
            </div>
        </nav>
    </header>

    <main>


        <div class="form_center">
            <form id="form" name="form" method="POST" onsubmit="return validateForm()" class="form">
                <div class="container p-5 py-4 m-2 border border-2 rounded">
                    <h1 class="text-light text-center">GIA HẠN THỜI GIAN</h1>
                    <hr class="text-dark border border-2 rounded " style="border-top: 4px solid white">

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1   text-light">
                            <label for="ngaysinh">Ngày gia hạn mới:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="date" name="hanmoi" min="<?php echo $cv['CV_NGAYKETTHUC']?>" id="hanmoi" min="<?php echo $cv['CV_NGAYKETTHUC'];?>"
                                value="<?php echo $cv['CV_NGAYKETTHUC'];?>">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1   text-light">
                            <label for="ngaysinh">Nội dung:</label>
                        </div>
                        <div class="col p-1 ">
                            <textarea class="form-control" name="noidung" id="noidung" cols="30" rows="10" placeholder="Nhập nội dung"></textarea>
                        </div>
                    </div>


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