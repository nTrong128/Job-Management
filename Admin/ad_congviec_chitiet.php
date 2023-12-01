<?php

// Update User
include_once('../condb/condb.php');
include_once './ad_thongbao.php';
$ma = $_GET['chitiet_ma'];

$query_congviec = "SELECT * FROM congviec WHERE CV_MA='$ma'";

$congviec_data = mysqli_query($conn, $query_congviec);
$congviec = mysqli_fetch_array($congviec_data);

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
        <nav class="navbar_container navbar  navbar-expand-lg">
            <button class=" btn mx-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="fa-solid fs-2 text-light fa-bars"></i>
            </button>
            <div class="container-fluid">
                <a class="navbar-brand text-white fs-4" href="trangchu.php"><img src="../image/logo.png" style="width: 60px;" class="w3-circle"></a>
                <a class="navbar-brand text-white fs-2"> QUẢN LÝ CÔNG VIỆC </a>
                <div class="d-flex">
                    <div class="dropdown mx-4 position-relative">
                        <span class="position-absolute top-0 start-100 fs-6 translate-middle badge bg-danger rounded-pill badge-danger">
                            <?php echo $soluong_thongbao; ?>
                            <span class="visually-hidden">unread messages</span>
                        </span>
                        <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">
                            <i class="fs-1 fa-solid fa-bell"></i>
                        </a>
                        <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">
                            <div class="notification-heading d-flex justify-content-between">
                                <h4 class="">Thông báo</h4>
                                <form id="form" name="form" method="POST" onsubmit="return validateForm()" class="">
                                    <button type="dochet" name="dochet" onclick="reloadPageContentOnSubmit()" class="btn btn-dark menu-title">Đánh dấu tất cả là đã đọc</button>
                                </form>
                                
                            </div>
                            <li class="divider"></li>
                            <div class="notifications-wrapper">
                                <?php
if ($ds_thongbao->num_rows > 0):
    while ($thongbao = mysqli_fetch_assoc($ds_thongbao)):;
        ?>
                                <div class="content" href="#">
                                    <div class="notification-item <?php if ($thongbao['TB_XEM'] == '0') echo "unread" ?>">
                                        
                                        <div class="d-flex justify-content-between">
                                            <h4 class="item-title"><?php echo $thongbao['CV_TEN'] ?></h4>
                                        <?php
                                        if ($thongbao['TB_XEM'] == '0'):
                                        ?>
                                        <a class="text-decoration-none  btn btn-dark" href="ad_thongbao_doc.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                            Đánh dấu đã đọc
                                        </a>
                                        <?php else: ?>
                                        <a class="text-decoration-none btn btn-dark" href="ad_thongbao_chuadoc.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                            Đánh dấu là chưa đọc
                                        </a>
                                        <?php endif;?>
                                        </div>
                                        <p class="item-info">Người thực hiện: <?php echo $thongbao['ND_HOTEN'] ?></p>
                                        <?php 
                                        // $start_date = date_create($thongbao['TB_TG']);
                                        
                                        // $date_out = timeAgo($start_date);
                                        $date_out = timeAgo($thongbao['TB_TG']);
                                        
                                        ?>
                                        <p class="item-info"><?php echo $date_out?></p>
                                        <div class="d-flex justify-content-between">
                                            <p class="item-info"><?php echo $thongbao['TB_ND']?></p>
                                            <a class="btn btn-dark text-decoration-none" href="ad_thongbao_xoa.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                            Xoá
                                        </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="noti-container">
                                    <?php
    endwhile;
else:?><h5 class="card-title m-0"><?php echo "Tạm thời không có thông báo.";endif;?></h5>
                                </div>

                            </div>
                            <li class="divider"></li>
                            <div class="notification-footer">
                            </div>
                        </ul>
                    </div>
                    <a class="btn btn-outline-light px-2 py-2 me-2" href="../User/dangxuat.php" role="button">ĐĂNG XUẤT</a>
                </div>
            </div>
            </div>
        </nav>
    </header>
    <main>

        <div class="form_center">
            <form id="form" name="form" method="post" onsubmit="return validateForm()" class="form">
                <div class="container p-5 py-4 m-2 border border-2 rounded">
                    <h1 class="text-light text-center">XEM CHI TIẾT CÔNG VIỆC</h1>
                    <hr class="text-dark border border-2 rounded " style="border-top: 4px solid white">

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Tên công việc:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly class="form-control" type="text" placeholder="Nhập tên công việc" name="ten" id="ten" value="<?php echo $congviec['CV_TEN'];?> ">
                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="ngaybatdau">Ngày bắt đầu:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly class="form-control" type="" placeholder="Điền ngày bắt đầu công việc" name="ngaybatdau" id="ngaybatdau" value="<?php echo $congviec['CV_NGAYBATDAU'];?> ">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="ngayketthuc">Ngày kết thúc:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly class="form-control" type="" name="ngayketthuc" id="ngayketthuc" value="<?php echo $congviec['CV_NGAYKETTHUC'];?> ">
                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Nội dung:</label>
                        </div>
                        <div class="col p-1 ">
                            <textarea readonly class="form-control" name="noidung" id="noidung" rows="3"><?php echo $congviec['CV_NOIDUNG'];?></textarea>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Tiến độ:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly type="number" min="0" max="100" class="form-control" name="tiendo" id="tiendo" rows="3" value=<?php echo $congviec['CV_TIENDO'];?>></input>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="trangthai">Trạng thái:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly type="text" min="<?php echo $congviec['CV_TRANGTHAICV'];?>" max="100" class="form-control" name="trangthai" id="trangthai" rows="3"
                                value=<?php echo $congviec['CV_TRANGTHAICV'];?>></input>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="nguoithuchien">Người thực hiện:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly type="text" class="form-control" name="nguoithuchien" value="<?php $user_id = $congviec['CV_NTH'];
$query_nguoidung = "SELECT * FROM nguoidung WHERE ND_MA='$user_id'";
$nguoidung_data = mysqli_query($conn, $query_nguoidung);
$nguoidung = mysqli_fetch_array($nguoidung_data);
echo $nguoidung['ND_HOTEN'];?> ">

                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="nguoigiamsat">Người giám sát:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly type="text" class="form-control" name="nguoigiamsat" value="<?php
                            $user_id = $congviec['CV_NGS'];
$query_nguoidung = "SELECT * FROM nguoidung WHERE ND_MA='$user_id'";
$nguoidung_data = mysqli_query($conn, $query_nguoidung);
$nguoidung = mysqli_fetch_array($nguoidung_data);
echo $nguoidung['ND_HOTEN'];
?> ">

                        </div>
                    </div>





                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="loai">Loại công việc:</label>
                        </div>
                        <div class="col p-1">
                            <input readonly type="text" class="form-control" name="loaicongviec" value="<?php
$lcv_ma = $congviec['LCV_MA'];
$query_lcv = "SELECT * FROM loaicongviec WHERE LCV_MA='$lcv_ma'";
$lcv_data = mysqli_query($conn, $query_lcv);
$lcv = mysqli_fetch_array($lcv_data);
echo $lcv['LCV_TEN'];
?>">
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="ngayketthuc">Ngày tạo:</label>
                        </div>
                        <div class="col p-1 ">
                            <input readonly class="form-control" type="" name="ngayketthuc" id="ngayketthuc" value="<?php echo $congviec['CV_NGAYTAO'];?> ">
                        </div>
                    </div>
                    <div class="btn_form ">
                        <a href="ad_congviec_ds.php" style="width:100%" class="btn  btn-dark">Quay lại</a>
                    </div>
                </div>
            </form>
        </div>
    </main>

</body>

</html>