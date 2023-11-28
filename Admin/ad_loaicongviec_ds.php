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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>LOẠI CÔNG VIỆC</title>
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

    <main class="pb-4">


        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header custom-bg text-light">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    <?php  if (isset($_SESSION['username'])) : ?>
                    <?php

                echo "Admin"; ?>
                    <?php endif ?>
                </h5>

                <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="fa-solid fa-xmark fa-2xl" style="color: #ffffff;"></i>
                </button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <a href="ad_trangchu.php" type="button" class="btn btn-outline-secondary w-100 my-1 py-2">Trang chủ</a>
                </div>
                <div>
                    <a href="ad_nguoidung_ds.php" type="button" class="btn btn-outline-secondary w-100 my-1 py-2">Danh sách người dùng</a>
                </div>
                <div>
                    <a href="ad_congviec_ds.php" type="button" class="btn btn-outline-secondary w-100 my-1 py-2">Danh sách công việc</a>
                </div>
                <div>
                    <a href="ad_loaicongviec_ds.php" type="button" class="btn btn-outline-secondary w-100 my-1 py-2">Phân loại công việc</a>
                </div>
                <div>
                    <a href="ad_thongke.php" type="button" class="btn btn-outline-secondary w-100 my-1 py-2">Báo cáo thống kê</a>
                </div>

            </div>
        </div>
        <div class="rounded mx-4 mb-4 pt-4  d-flex justify-content-sm-between">
            <input class="rounded-2" type="text" id="searchBar" placeholder="Tìm kiếm loại công việc.." title="Nhập thông tin công việc">
            <a href="ad_loaicongviec_them.php" class="btn btn-dark p-3 px-4">Thêm loại công việc mới</a>
        </div>

        <div class="m-auto jobs_table table_job_scroll w-75 d-flex justify-content-center">

            <table id="dataTable" class="tableFixHead table text-center align-middle ">
                <thead class="align-middle">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên loại công việc</th>
                        <th scope="col"></th>


                    </tr>
                </thead>
                <tbody>

                    <?php
          $query_cv = "SELECT * FROM loaicongviec";
$ds_cv = mysqli_query($conn, $query_cv);
$i = 1;
while ($cv = mysqli_fetch_assoc($ds_cv)):
    ;
    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $i;
    $i += 1; ?>
                        </th>
                        <td>
                            <?php echo $cv['LCV_TEN']; ?>
                        </td>
                        <td style="width:25%">
                            <!-- <button class="btn"><a href="ad_loaicongviec_chitiet.php?chitiet_ma=<?php echo $cv['LCV_MA']?>"><i class="fa-solid fa-eye"></i></a></button> -->
                            <!-- <button class="btn"><a href="ad_loaicongviec_sua.php?chinhsua_ma=<?php echo $cv['LCV_MA']?>"><i class="fa-solid fa-pen-to-square"></i></a></button> -->
                            <button class="btn"><a href="ad_loaicongviec_xoa.php?xoa_ma=<?php echo $cv['LCV_MA']?>"><i class="fa-sharp fa-solid fa-trash"></i></a></button>

                        </td>


                    </tr>
                    <?php
endwhile;
?>
                </tbody>
            </table>
        </div>



    </main>


    <footer class="footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>
    <script>
    $(document).ready(function() {
        $("#searchBar").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#dataTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
</body>

</html>