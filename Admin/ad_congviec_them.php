<?php include_once '../condb/condb.php';
include_once './ad_thongbao.php'; ?>
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
            <form id="form" name="form" method="post" onsubmit="return validateForm()" class="form ">
                <div class="navbar_container p-5 py-4 m-2 border border-2 rounded">
                    <h1 class="text-light text-center">TẠO CÔNG VIỆC</h1>
                    <hr class="text-dark border border-2 rounded " style="border-top: 4px solid white">
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="loai">Loại công việc:</label>
                        </div>
                        <div class="col p-1 ">
                            <select class="form-control" name="loai">
                                <?php
while ($loai = mysqli_fetch_assoc($tatcaloai)):
    ;
    ?>
                                <option value="<?php echo $loai['LCV_MA'];
    ?>">
                                    <?php echo $loai['LCV_TEN'];
    ?>
                                </option>
                                <?php
endwhile;
?>
                            </select>

                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Tên công việc:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" placeholder="Nhập tên công việc" name="ten" id="ten" required>
                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="ngaybatdau">Ngày bắt đầu:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="date" placeholder="Điền ngày bắt đầu công việc" name="ngaybatdau" id="ngaybatdau" required>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="ngayketthuc">Ngày kết thúc:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="date" placeholder="Điền ngày kết thúc công việc" name="ngayketthuc" id="ngayketthuc" required>
                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Nhập nội dung:</label>
                        </div>
                        <div class="col p-1 ">
                            <textarea class="form-control" name="noidung" id="noidung" placeholder="Nội dung" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="nguoithuchien">Người thực hiện:</label>
                        </div>
                        <div class="col p-1 ">
                            <select class="form-control" name="nguoithuchien">
                                <?php
                                $query_nguoidung = "SELECT * FROM nguoidung";
$ds_nguoidung = mysqli_query($conn, $query_nguoidung);
while ($nguoidung = mysqli_fetch_assoc($ds_nguoidung)):
    ;
    ?>
                                <option value="<?php echo $nguoidung['ND_MA'];
    ?>">
                                    <?php echo $nguoidung['ND_HOTEN'];
    ?>
                                </option>
                                <?php
endwhile;
?>
                            </select>

                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label for="nguoigiamsat">Người giám sát:</label>
                        </div>
                        <div class="col p-1 ">
                            <select class="form-control" name="nguoigiamsat">
                                <?php
$query_nguoidung = "SELECT * FROM nguoidung";
$ds_nguoidung = mysqli_query($conn, $query_nguoidung);
while ($nguoidung = mysqli_fetch_assoc($ds_nguoidung)):
    ;
    ?>
                                <option value="<?php echo $nguoidung['ND_MA'];
    ?>">
                                    <?php echo $nguoidung['ND_HOTEN'];
    ?>
                                </option>
                                <?php
endwhile;
?>
                            </select>

                        </div>
                    </div>






                    <div class="btn_form ">
                        <button style="width:100%" type="submit" class="btn  btn-dark" name="taocongviec">Tạo công
                            việc</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

</body>

</html>