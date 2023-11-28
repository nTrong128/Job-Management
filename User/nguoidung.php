<?php include_once '../condb/condb.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <link href="../styles/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../styles/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="../js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Người dùng</title>
</head>

<body>

    <header>
        <nav class=" navbar navbar-expand custom_navbar_bg fixed-top border-bottom border-light border-3">
            <button class=" btn mx-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar_content" aria-controls="sidebar_content">
                <i class="fa-solid fs-2 text-light fa-bars"></i>
            </button>
            <div class="container-fluid">
                <a class="navbar-brand text-white fs-4" href="trangchu.php"><img src="../image/logo.png" style="width: 40px;" class="w3-circle"></a>
                <a class="navbar-brand text-white fs-2"> QUẢN LÝ CÔNG VIỆC </a>
                <a class="btn btn-outline-light px-2 py-2 me-2" href="dangxuat.php" role="button">ĐĂNG XUẤT</a>
            </div>
            </div>
        </nav>
    </header>

    <main>


        <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar_content" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header custom-bg text-light">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    <?php  if (isset($_SESSION['nguoidung'])): ?>
                    <?php
                        $email = $_SESSION['nguoidung'];
                        $query = "select * from nguoidung where ND_EMAIL ='$email'";
                        $sql = mysqli_query($conn, $query);
                        $nguoidung = mysqli_fetch_assoc($sql);
                        $nd_ma = $nguoidung['ND_MA'];
                        echo $nguoidung['ND_HOTEN']; ?>
                    <?php endif ?>
                </h5>

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
                        <li><a class="dropdown-item" href="#">Đang chờ</a></li>
                        <li><a class="dropdown-item" href="#">Đang thực hiện</a></li>
                        <li><a class="dropdown-item" href="#">Đang giám sát</a></li>
                        <li><a class="dropdown-item" href="#">Đã hoàn thành</a></li>
                        <li><a class="dropdown-item" href="#">Quá hạn</a></li>
                    </ul>
                </div>

            </div>
        </div>


        <!-- CONTENT -->
        <div class="p-5 rounded text-center">
            <div class="row d-flex justify-content-between ">
                <div class=" col bg-warning rounded-4 m-4 p-1 job-container shadow-lg p-0 mb-5 rounded">
                    <h3 class="fw-bold text-light ">ĐANG CHỜ</h3>
                    <div class="table_job_scroll">
                        <div class=" bg-white rounded-4 job-container p-1 m-1">
                            <?php
$query_cv = "select * from congviec where CV_NTH ='$nd_ma' and CV_TIENDO = 0 and CV_NGAYKETTHUC > NOW()";
$ketqua = $conn->query($query_cv);
if ($ketqua->num_rows > 0):
    while ($cv = $ketqua->fetch_assoc()):;
        ?>

                            <div class="m-2 rounded-4 border border-warning">
                                <h4><?php echo $cv['CV_TEN'] ?>

                                </h4>
                                <hr class="m-1 rounded border border-warning border-1 opacity-100">
                                <p>
                                    <?php
                              $start_date = date_create($cv['CV_NGAYBATDAU']);
        $end_date = date_create($cv['CV_NGAYKETTHUC']);
        echo date_format($start_date, "d M");
        echo " - ";
        echo date_format($end_date, "d M");

        ?>
                                </p>
                                <a href="nd_congviec_sua.php?capnhat_ma=<?php echo $cv['CV_MA']?>" class="btn btn-warning m-1">Nhận</a>
                                <a href="nd_congviec_chitiet.php?chitiet_ma=<?php echo $cv['CV_MA']?>" class="btn btn-warning m-1">Xem chi tiết</a>

                            </div>
                            <?php
    endwhile;
else:
    ?>
                            <h5 class="card-title"><?php echo "Không có";endif;?></h5>
                        </div>
                    </div>
                </div>
                <div class=" col bg-info rounded-4 m-4 p-1 job-container shadow-lg p-0 mb-5 rounded">
                    <h3 class="fw-bold text-light">ĐANG THỰC HIỆN</h3>
                    <div class="table_job_scroll">
                        <div class=" bg-white rounded-4 job-container-child p-1 m-1">
                            <?php
$query_cv = "select * from congviec where CV_NTH =$nd_ma and CV_TIENDO  > 0 and CV_TIENDO < 100 and CV_NGAYKETTHUC > NOW()";
$ketqua = $conn->query($query_cv);
if ($ketqua->num_rows > 0):
    while ($cv = $ketqua->fetch_assoc()):;
        ?>

                            <div class="m-2 rounded-4 border border-info ">
                                <h4><?php echo $cv['CV_TEN'] ?>

                                </h4>
                                <hr class="m-1 rounded border border-info border-1 opacity-100">
                                <?php
                              $start_date = date_create($cv['CV_NGAYBATDAU']);
        $end_date = date_create($cv['CV_NGAYKETTHUC']);
        echo date_format($start_date, "d M");
        echo " - ";
        echo date_format($end_date, "d M");

        ?>
                                <div class="progress mx-1">
                                    <div class="progress-bar" role="progressbar" style="width:<?php echo $cv['CV_TIENDO'];?>%;" aria-valuenow="<?php echo $cv['CV_TIENDO'];?>" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <p class="m-0"><i class="fa-solid fa-clock"></i>
                                    <?php
                              $start_date = date_create($cv['CV_NGAYBATDAU']);
        $end_date = date_create($cv['CV_NGAYKETTHUC']);
        echo date_diff($start_date, $end_date)->format("%a Ngày");


        ?>
                                </p>
                                <a href="nd_congviec_chitiet.php?chitiet_ma=<?php echo $cv['CV_MA']?>" class="btn btn-info m-1">Xem chi tiết</a>


                            </div>
                            <?php
    endwhile;
else:
    ?>
                            <h5 class="card-title m-0"><?php echo "Không có";endif;?></h5>
                        </div>
                    </div>

                </div>
                <div class="= col bg-secondary rounded-4 m-4 p-1 job-container shadow-lg p-0 mb-5 rounded">
                    <h3 class="fw-bold text-light">ĐANG GIÁM SÁT</h3>
                    <div class="table_job_scroll">
                        <div class=" bg-white rounded-4 job-container p-1 m-1">
                            <?php
$query_cv = "select * from congviec where CV_NGS =$nd_ma and CV_TIENDO < 100 and CV_NGAYKETTHUC > NOW()";
$ketqua = $conn->query($query_cv);
if ($ketqua->num_rows > 0):
    while ($cv = $ketqua->fetch_assoc()):;
        ?>

                            <div class="m-2 rounded-4 border border-secondary ">
                                <h4><?php echo $cv['CV_TEN'] ?>
                                </h4>
                                <hr class="m-2 rounded border border-secondary border-1 opacity-100">
                                <?php
                              $start_date = date_create($cv['CV_NGAYBATDAU']);
        $end_date = date_create($cv['CV_NGAYKETTHUC']);
        echo date_format($start_date, "d M");
        echo " - ";
        echo date_format($end_date, "d M");

        ?>
                                <div class="progress mx-1">
                                    <div class="progress-bar" role="progressbar" style="width:<?php echo $cv['CV_TIENDO'];?>%;" aria-valuenow="<?php echo $cv['CV_TIENDO'];?>" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <p class="m-0"><i class="fa-solid fa-clock"></i>
                                    <?php
                              $start_date = date_create($cv['CV_NGAYBATDAU']);
        $end_date = date_create($cv['CV_NGAYKETTHUC']);
        echo date_diff($start_date, $end_date)->format("%a Ngày");


        ?>
                                </p>
                                <a href="nd_congviec_chitiet.php?chitiet_ma=<?php echo $cv['CV_MA']?>" class="btn btn-secondary m-1">Xem chi tiết</a>

                            </div>
                            <?php
    endwhile;
else:
    ?>
                            <h5 class="card-title"><?php echo "Không có";endif;?></h5>
                        </div>
                    </div>
                </div>
                <div class=" col bg-success rounded-4 m-4 p-1 job-container shadow-lg p-0 mb-5 rounded">
                    <h3 class="fw-bold text-light">ĐÃ HOÀN THÀNH</h3>
                    <div class="table_job_scroll">
                        <div class=" bg-white rounded-4 job-container p-1 m-1">
                            <?php
$query_cv = "select * from congviec where CV_NTH =$nd_ma and CV_TIENDO = 100";
$ketqua = $conn->query($query_cv);
if ($ketqua->num_rows > 0):
    while ($cv = $ketqua->fetch_assoc()):;
        ?>

                            <div class="m-2 rounded-4 border border-success ">
                                <h4><?php echo $cv['CV_TEN'] ?>

                                </h4>
                                <hr class="m-2 rounded border border-success border-1 opacity-100">
                                <?php
                              $start_date = date_create($cv['CV_NGAYBATDAU']);
        $end_date = date_create($cv['CV_NGAYKETTHUC']);
        echo date_format($start_date, "d M");
        echo " - ";
        echo date_format($end_date, "d M");

        ?>
                                <div class="progress m-2">
                                    <div class="progress-bar" role="progressbar" style="width:<?php echo $cv['CV_TIENDO'];?>%;" aria-valuenow="<?php echo $cv['CV_TIENDO'];?>" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <a href="nd_congviec_chitiet.php?chitiet_ma=<?php echo $cv['CV_MA']?>" class="btn btn-success m-1">Xem chi tiết</a>

                            </div>

                            <?php
    endwhile;
else:
    ?>
                            <h5 class="card-title"><?php echo "Không có";endif;?></h5>
                        </div>
                    </div>
                </div>
                <div class="col  bg-danger rounded-4 m-4 p-1 job-container shadow-lg p-0 mb-5 rounded">
                    <h3 class="fw-bold text-light">ĐÃ QUÁ HẠN</h3>
                    <div class="table_job_scroll">
                        <div class=" bg-white rounded-4 job-container p-1 m-1">
                            <?php
$query_cv = "select * from congviec where CV_NTH =$nd_ma and CV_TIENDO < 100 and CV_NGAYKETTHUC < NOW()";
$ketqua = $conn->query($query_cv);
if ($ketqua->num_rows > 0):
    while ($cv = $ketqua->fetch_assoc()):;
        ?>

                            <div class=" rounded-4 border border-danger m-2">
                                <h4><?php echo $cv['CV_TEN'] ?>

                                </h4>
                                <hr class="m-2 rounded border border-danger border-1 opacity-100">
                                <?php
                              $start_date = date_create($cv['CV_NGAYBATDAU']);
        $end_date = date_create($cv['CV_NGAYKETTHUC']);
        echo date_format($start_date, "d M");
        echo " - ";
        echo date_format($end_date, "d M");

        ?>
                                <div class="progress m-2">
                                    <div class="progress-bar" role="progressbar" style="width:<?php echo $cv['CV_TIENDO'];?>%;" aria-valuenow="<?php echo $cv['CV_TIENDO'];?>" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <p class="m-0"><i class="fa-solid fa-clock"></i>
                                    <?php
                              $start_date = date_create($cv['CV_NGAYBATDAU']);
        $end_date = date_create($cv['CV_NGAYKETTHUC']);
        echo date_diff($start_date, $end_date)->format("Quá hạn %a Ngày");


        ?>
                                </p>
                                <a href="nd_congviec_chitiet.php?chitiet_ma=<?php echo $cv['CV_MA']?>" class="btn btn-danger m-1">Xem chi tiết</a>
                                <a href="nd_congviec_giahan.php?giahan_ma=<?php echo $cv['CV_MA']?>" class="btn btn-danger m-1">Đề nghị gia hạn</a>
                            </div>
                            <?php
    endwhile;
else:
    ?>
                            <h5 class="card-title m-0"><?php echo "Không có";endif;?></h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
mysqli_close($conn);
?>
    </main>


    <footer class="footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>
    <script>
    $(document).ready(function() {
        const show_percent = true;
        var progressBars = $(".progress-bar");
        for (i = 0; i < progressBars.length; i++) {
            var progress = $(progressBars[i]).attr("aria-valuenow");
            $(progressBars[i]).width(progress + "%");
            if (show_percent) {
                $(progressBars[i]).text(progress + "%");
            }

            if (progress >= 90) {
                //90 and above
                $(progressBars[i]).addClass("bg-success");
            } else if (progress >= 30 && progress < 45) {
                $(progressBars[i]).addClass("bg-warning"); //From 30 to 44
            } else if (progress >= 45 && progress < 90) {
                $(progressBars[i]).addClass("bg-info"); //From 45 to 89
            } else {
                //29 and under
                $(progressBars[i]).addClass("bg-danger");
            }
        }
    });
    </script>
</body>

</html>