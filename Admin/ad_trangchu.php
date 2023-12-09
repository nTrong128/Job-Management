<?php include_once '../condb/condb.php';
include_once './ad_thongbao.php'; ?>
<?php 
if ((!isset($_SESSION['admin']))) {
    session_destroy();
    unset($_SESSION['admin']);
    header("location: ../index.php");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>Admin</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand custom_navbar_bg fixed-top border-bottom border-light border-3">
            <button class=" btn mx-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="fa-solid fs-2 text-light fa-bars"></i>
            </button>
            <div class="container-fluid">
                <a class="navbar-brand text-white fs-4" href="ad_trangchu.php"><img src="../image/logo.png" style="width: 60px;" class="w3-circle"></a>
                <a class="navbar-brand text-white fs-2"> QUẢN LÝ CÔNG VIỆC </a>
                <div class="d-flex">
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
                                <div class="notification-heading border-bottom py-2 d-flex justify-content-between">
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
                                                <p class="item-info"><?php echo $thongbao['TB_NOIDUNG']?></p>
                                                <a class="btn btn-danger text-decoration-none" href="ad_thongbao_xoa.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                                    Xoá
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    endwhile;
else:?>
                                    <div class="noti-container">
                                        <h5 class="card-title my-2 mx-2"><?php echo "Tạm thời không có thông báo.";endif;?></h5>
                                    </div>

                                </div>
                                <div class="notification-footer">
                                </div>
                            </ul>
                        </div>
                        <a class="btn btn-outline-light px-2 py-2 me-2" href="./dangxuat.php" role="button">ĐĂNG XUẤT</a>
                    </div>
                </div>
            </div>
            </div>
        </nav>
    </header>
    <main>


        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header custom-bg text-light">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    ADMIN
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
        <?php
$query_nguoidung = "SELECT * FROM nguoidung";
$ds_nguoidung = mysqli_query($conn, $query_nguoidung);
$soluong_nguoidung = $ds_nguoidung->num_rows;
        ?>
        <?php
$query_cv = "SELECT * FROM congviec";
$ds_cv = mysqli_query($conn, $query_cv);
$soluong_cv = $ds_cv->num_rows;
?>
        <?php
$query_cv = "SELECT * FROM loaicongviec";
$ds_lcv = mysqli_query($conn, $query_cv);
$soluong_lcv = $ds_lcv->num_rows;
?>
        <div class="text-center container rounded-4 py-4">
            <div class="d-flex justify-content-center  text-light text-bold">
                <a href="ad_nguoidung_ds.php" style="width:172px; height:120px;"
                    class="d-flex align-items-center justify-content-center rounded-4 border border-2 shadow border-dark-subtle bg-secondary fs-2 mx-4 text-decoration-none text-light">

                    <h4><?php echo $soluong_nguoidung;?><br>Người dùng</h4>

                </a>
                <a href="ad_congviec_ds.php" style="width:172px; height:120px;"
                    class="d-flex align-items-center justify-content-center rounded-4 border border-2 shadow border-dark-subtle bg-secondary fs-2 mx-4 text-decoration-none text-light">

                    <h4><?php echo $soluong_cv;?><br>Công việc</h4>
                </a>
                <a href="ad_loaicongviec_ds.php" style="width:172px; height:120px;"
                    class="d-flex align-items-center justify-content-center rounded-4 border border-2 shadow border-dark-subtle bg-secondary fs-2 mx-4 text-decoration-none text-light">

                    <h4><?php echo $soluong_lcv;?><br>Loại công việc</h4>
                </a>
            </div>


        </div>


        <div class="container py-4 rouded rounded-4">
            <div class="d-flex">
                <div style="" class="col shadow-lg p-2 mx-2 flex-fill text-center w-50 bg-white rounded rounded-4">
                    <h3 class="title lh-lg bg-success text-light rounded-4 ">YÊU CẦU TỪ NGƯỜI DÙNG</h3>
                    <div class="request-containe table_job_scroll">
                        <!-- while loop here -->
                        <?php
if ($ds_yeucau->num_rows > 0):
    while ($yeucau = mysqli_fetch_assoc($ds_yeucau)):;
        ?>
                        <div class="noti_container bg-white rounded-4 my-2 text-center">
                            <h4 class=" pt-1 border-bottom border-2 px-4 rounded-top-4">Gia hạn thời gian</h4>
                            <div class="py-1">
                                <h4><?php echo $yeucau['CV_TEN'] ?></h4>
                                <p class="px-2"><?php echo $yeucau['GH_NGAY'] ?></p>
                                <p class="px-2"><?php echo $yeucau['GH_NOIDUNG']?></p>
                                <?php
        $para1 = $yeucau['GH_MA'];
        $para2 = $yeucau['CV_MA'];
        $para3 = $yeucau['GH_NGAY'];
        ?>
                                <button onclick="executeButton('<?php echo $para1?>', '<?php echo $para2?>', '<?php echo $para3?>',0)" class="mx-3 px-5 btn btn-danger">Từ chối</button>
                                <button onclick="executeButton('<?php echo $para1?>', '<?php echo $para2?>', '<?php echo $para3?>',1)" class=" mx-3 px-5 btn btn-success">Xác nhận</button>
                            </div>
                        </div>

                        <?php
    endwhile;
else:?><h5 class="card-title m-0"><?php echo "Tạm thời không có yêu cầu.";endif;?></h5>
                    </div>
                </div>
                <div style="" class="mx-2 col shadow-lg p-2 flex-fill w-50 rounded-4 bg-white">
                    <h3 class="title lh-lg bg-success text-light rounded-4 text-center">Thông báo</h3>
                    <div class="noti-container table_job_scroll">
                        <?php
$ds_thongbao = $conn->query($query_thongbao);
if ($ds_thongbao->num_rows > 0):
    while ($thongbao = mysqli_fetch_assoc($ds_thongbao)):;
        ?>
                        <div class="<?php if($thongbao['TB_XEM'] == '0')echo"unread"?> border border-dark border-2 noti_container rounded-4 my-2 text-center ">
                            <h4 class=" pt-1 border-bottom border-2 px-4 rounded-top-4"><?php echo $thongbao['CV_TEN'] ?></h4>
                            <div class="py-1">
                                <!-- <h5 class="card-title">Tên công việc: </h5> -->
                                <p class="px-2">Người thực hiện: <?php echo $thongbao['ND_HOTEN'] ?></p>
                                <p class="px-2"><?php echo $thongbao['TB_NOIDUNG']?></p>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-danger text-decoration-none col-3 mx-4" href="ad_thongbao_xoa.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                        Xoá
                                    </a>
                                    <?php
                                        if ($thongbao['TB_XEM'] == '0'):
                                        ?>
                                    <a class="btn btn-dark text-decoration-none col-4" href="ad_thongbao_doc.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                        Đánh dấu đã đọc
                                    </a>
                                    <?php else: ?>
                                    <a class="btn btn-dark text-decoration-none col-4" href="ad_thongbao_chuadoc.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
                                        Đánh dấu là chưa đọc
                                    </a>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <?php
    endwhile;
else:?><h5 class="card-title m-0 text-center"><?php echo "Tạm thời không có thông báo.";endif;?></h5>
                    </div>
                </div>
            </div>
        </div>


    </main>


    <footer class="fixed-bottom footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>
    <script>
    function executeButton(gh_ma, cv_ma, gh_ngay, state) {

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the response from the PHP script if needed
                console.log(xhr.responseText);
            }
        };

        xhr.open("POST", "ad_cv_giahan.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("request=" + gh_ma + "&cv_ma=" + cv_ma + "&date=" + gh_ngay + "&response=" + state);
        document.location.reload(true);

    }

    function reloadPageContentOnSubmit() {
        console.log("Reloaded")
        document.location.reload(true);
    }

    function searchFunc() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchBar");
        filter = input.value.toUpperCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    </script>
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
</body>

</html>