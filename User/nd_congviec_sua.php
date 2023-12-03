<?php

// Update User
include_once('../condb/condb.php');
$ma = $_GET['capnhat_ma'];

$query_cv = "SELECT * FROM congviec WHERE CV_MA='$ma'";

$cv_data = mysqli_query($conn, $query_cv);
$cv = mysqli_fetch_array($cv_data);
$nguoidung_tb = $cv['CV_NTH'];
$tiendo_cu = $cv['CV_TIENDO'];

if(isset($_POST['submit'])) {

    $tiendo = $_POST['tiendo'];
    
    try {
        if($tiendo <= $tiendo_cu) {
            header("Location: nguoidung.php");
            throw new Exception("Tiến độ mới không hợp lệ");
            }
        $sql = "UPDATE congviec
                SET 
                    CV_TIENDO='$tiendo'
                WHERE CV_MA=$ma";

        $query = mysqli_query($conn, $sql);
        
        $result = $conn->execute_query("SELECT * FROM thongbao WHERE ND_MA=$nguoidung_tb AND CV_MA=$ma");
        if($result->num_rows == 1 ) {
            $sql_thongbao = "UPDATE thongbao
                        SET TB_XEM = '0',
                            TB_TG = NOW(),
                            TB_ND = 'Cập nhật tiến độ công việc $tiendo_cu% -> $tiendo%'
                        WHERE ND_MA='$nguoidung_tb' AND CV_MA='$ma'";
            $query_thongbao = mysqli_query($conn, $sql_thongbao);
        }
        else {
            $sql_thongbao = "INSERT INTO thongbao
                        (ND_MA, CV_MA,TB_ND, TB_TG, TB_XEM)
                        VALUES ('$nguoidung_tb','$ma','Cập nhật tiến độ công việc $tiendo_cu% -> $tiendo%',NOW(), '0')";
            $query_thongbao = mysqli_query($conn, $sql_thongbao);
        }

    } catch (mysqli_sql_exception $e) {
        var_dump($e);
        exit;

    }


    if ($query) {

        echo "Cập nhật thành công!";
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
    <title>Tạo công việc</title>
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
                <a class="btn btn-outline-light px-2 py-2 me-2" href="dangxuat.php" role="button">ĐĂNG XUẤT</a>
            </div>
            </div>
        </nav>
    </header>
    <main>

        <div class="form_center">
            <form id="form" name="form" method="post" onsubmit="return validateForm()" class="form">
                <div class="container p-5 py-4 m-2 border border-2 rounded">
                    <h1 class="text-light text-center">CẬP NHẬT CÔNG VIỆC</h1>
                    <hr class="text-dark border border-2 rounded " style="border-top: 4px solid white">

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Tên công việc:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" placeholder="Nhập tên công việc" name="ten" id="ten" readonly value="<?php echo $cv['CV_TEN'];?> " />
                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="ngaybatdau">Ngày bắt đầu:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="" readonly name="ngaybatdau" id="ngaybatdau" readonly value="<?php echo $cv['CV_NGAYBATDAU'];?> " />
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="ngayketthuc">Ngày kết thúc:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" name="ngayketthuc" id="ngayketthuc" readonly value="<?php echo $cv['CV_NGAYKETTHUC'];?> " />
                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Nhập nội dung:</label>
                        </div>
                        <div class="col p-1 ">
                            <textarea class="form-control" name="noidung" id="noidung" readonly rows="3"><?php echo $cv['CV_NOIDUNG'];?></textarea>
                        </div>
                    </div>



                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Nhập tiến độ:</label>
                        </div>
                        <div class="col p-1 ">
                            <input type="number" min="<?php echo $cv['CV_TIENDO'];?>" max="100" class="form-control" name="tiendo" id="tiendo" rows="3" value=<?php echo $cv['CV_TIENDO'];?>></input>
                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="nguoithuchien">Người thực hiện:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly type="text" class="form-control" name="nguoithuchien" value="<?php $user_id = $cv['CV_NTH'];
$user = "SELECT * FROM nguoidung WHERE ND_MA='$user_id'";
$user_data = mysqli_query($conn, $user);
$user_current = mysqli_fetch_array($user_data);
echo $user_current['ND_HOTEN'];?> ">

                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="nguoigiamsat">Người giám sát:</label>
                        </div>
                        <div class="col p-1 ">
                            <input type="text" readonly class="form-control" name="nguoigiamsat" value="<?php
                            $user_id = $cv['CV_NGS'];
$user = "SELECT * FROM nguoidung WHERE ND_MA='$user_id'";
$user_data = mysqli_query($conn, $user);
$user_current = mysqli_fetch_array($user_data);
echo $user_current['ND_HOTEN'];
?> ">

                        </div>
                    </div>




                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="loai">Loại công việc:</label>
                        </div>
                        <div class="col p-1">
                            <input type="text" readonly class="form-control" name="loaicongviec" value="<?php
$lcv_id = $cv['LCV_MA'];
$lcv = "SELECT * FROM loaicongviec WHERE LCV_MA='$lcv_id'";
$lcv_data = mysqli_query($conn, $lcv);
$lcv_current = mysqli_fetch_array($lcv_data);
echo $lcv_current['LCV_TEN'];
?>
                            
                            ">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="ngayketthuc">Ngày tạo:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" readonly type="" name="ngayketthuc" id="ngayketthuc" value="<?php echo $cv['CV_NGAYTAO'];?> ">
                        </div>
                    </div>
                    <div class="btn_form ">
                        <button style="width:100%" class="btn  btn-dark" type="submit" name="submit">Cập nhật thay đổi</button>
                    </div>

                </div>
            </form>
        </div>
    </main>

</body>

</html>