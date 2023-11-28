<?php
//Kết nối cơ sở dữ liệu
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nlcskhmt";
$_SESSION['success'] = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit();
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>



<?php
//Đăng ký
if (isset($_POST['dangky'])) {
    $name = $_POST["name"];
    $diachi = $_POST["diachi"];
    $sdt = $_POST["sdt"];
    $email = $_POST["email"];
    $mscb = $_POST["mscb"];
    $password = $_POST["passwd"];
    $_POST["passwd"] != $_POST["passwd2"];
    if (!empty($username) && !empty($name) && !empty($diachi) && !empty($sdt) && !empty($email) && !empty($mscb) && !empty($password)) {
        echo "<pre>";
        print_r($_POST);
        $sql = "INSERT INTO nguoidung (ND_HOTEN, ND_DIACHI, ND_SDT, ND_EMAIL,ND_MSCB, ND_MATKHAU) VALUES ('" . $_POST["name"] . "',
                '" . $_POST["diachi"] . "', '" . $_POST["sdt"] . "', '" . $_POST["email"] . "','" . $_POST["mscb"] . "' , '" . md5($_POST["passwd"]) . "')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $_SESSION['username'] = $email;

            $_SESSION['success'] = "You have logged in";
            header('Location: ../User/nguoidung.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
<?php
//Thêm người dùng
if (isset($_POST['them'])) {
    $name = $_POST["name"];
    $diachi = $_POST["diachi"];
    $sdt = $_POST["sdt"];
    $email = $_POST["email"];
    $mscb = $_POST["mscb"];
    $password = $_POST["passwd"];
    $_POST["passwd"] != $_POST["passwd2"];
    if (!empty($username) && !empty($name) && !empty($diachi) && !empty($sdt) && !empty($email) && !empty($mscb) && !empty($password)) {
        echo "<pre>";
        print_r($_POST);
        $sql = "INSERT INTO nguoidung (ND_HOTEN, ND_DIACHI, ND_SDT, ND_EMAIL,ND_MSCB, ND_MATKHAU) VALUES ('" . $_POST["name"] . "',
                '" . $_POST["diachi"] . "', '" . $_POST["sdt"] . "', '" . $_POST["email"] . "','" . $_POST["mscb"] . "' , '" . md5($_POST["passwd"]) . "')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            header('Location: ad_nguoidung_ds.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>


<?php
//Xử lý đăng nhập

if (isset($_POST['dangnhap'])) {
    //Lấy dữ liệu nhập vào
    $nguoidung = $_POST['email'];
    $pass = md5($_POST['passwd']);

    $nguoidung = strip_tags($nguoidung);
    $nguoidung = addslashes($nguoidung);
    $pass = strip_tags($pass);
    $pass = addslashes($pass);

    $sql = "select * from nguoidung where ND_EMAIL ='$nguoidung' and
            ND_MATKHAU = '$pass' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $_SESSION['nguoidung'] = $nguoidung;
        $_SESSION['success'] = "You have logged in!";
        header('Location: nguoidung.php');

        echo "<script> alert('Đăng nhập thành công') </script>";



    } else {
        echo "<script>alert('Sai mật khẩu hoặc tên đăng nhập')</script>";
    }
}
?>

<?php

//Xử lý đăng nhập Admin

if (isset($_POST['dangnhapAdmin'])) {
    //Lấy dữ liệu nhập vào
    $nguoidung = $_POST['email'];
    $pass = md5($_POST['passwd']);

    $nguoidung = strip_tags($nguoidung);
    $nguoidung = addslashes($nguoidung);
    $pass = strip_tags($pass);
    $pass = addslashes($pass);

    $sql = "select * from admin where AD_EMAIL ='$nguoidung' and
            AD_MATKHAU = '$pass' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $_SESSION['nguoidung'] = $nguoidung;
        $_SESSION['success'] = "You have logged in!";
        header('Location: ../admin/ad_trangchu.php');

        echo "<script> alert('Đăng nhập thành công') </script>";



    } else {
        echo "<script>alert('Sai mật khẩu hoặc tên đăng nhập')</script>";
    }
}

?>


<?php
//Tạo công việc mới
$query_loaicongviec = "SELECT * FROM loaicongviec";
$tatcaloai = mysqli_query($conn, $query_loaicongviec);


if (isset($_POST['taocongviec'])) {
    $loai = $_POST["loai"];
    $ten = $_POST["ten"];
    $noidung = $_POST["noidung"];
    $ngaybatdau = $_POST["ngaybatdau"];
    $ngayketthuc = $_POST["ngayketthuc"];
    $nguoithuchien = $_POST["nguoithuchien"];
    $nguoigiamsat = $_POST["nguoigiamsat"];
    $tiendo = 0;
    $trangthai = "Đang chờ";
    if (!empty($loai) && !empty($ten) && !empty($noidung) && !empty($ngaybatdau) && !empty($ngayketthuc) && !empty($nguoithuchien) && !empty($nguoigiamsat)) {
        $sql = "INSERT INTO congviec(CV_TEN, CV_NGAYBATDAU, CV_NGAYKETTHUC,CV_NOIDUNG,CV_TIENDO,CV_TRANGTHAICV,CV_NGAYTAO,CV_NTH,CV_NGS, LCV_MA)
            VALUES ('$ten','$ngaybatdau','$ngayketthuc','$noidung','$tiendo','$trangthai',NOW(),'$nguoithuchien','$nguoigiamsat','$loai')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            header('Location: ad_congviec_ds.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>


<?php

//Tạo loai công việc mới

if (isset($_POST['taoloaicongviec'])) {

    $ten = $_POST["ten"];

    if (!empty($ten)) {
        $sql = "INSERT INTO loaicongviec(LCV_TEN) VALUES ('$ten')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            header('Location: ad_loaicongviec_ds.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


function alert_and_redirect($msg, $location)
{
    echo "<script>alert('$msg');document.location='$location'</script>";

}
