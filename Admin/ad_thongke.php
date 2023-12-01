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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Thống kê</title>
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
                                            <a class="btn btn-danger text-decoration-none" href="ad_thongbao_xoa.php?thongbao_ma=<?php echo $thongbao['TB_MA'];?>">
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

        <!-- Chart table -->
        <div class="rounded rounded-4 mb-5 chart bg-white text-center">
            <h3> Thống kê tổng số lượng công việc theo từng loại</h3>
            <div class="d-flex">
                <div class="mx-5 p-2 col-6">
                    <canvas id="chartBar"></canvas>
                </div>
                <div class="mx-5 p-2 col-4">

                    <canvas id="chartPie"></canvas>
                </div>
            </div>
        </div>

        <div class="rounded rounded-4 mb-5 chart_big bg-white text-center">
            <h2> Thống kê tổng số lượng công việc theo từng loại theo tháng</h2>
            <div class="d-flex">
                <div class="mx-5 p-2 col-7">
                    <canvas id="byMonthChart"></canvas>
                </div>
                <div class="mx-5 col-3">
                    <select class="form-select" name="monthSelect" id="monthSelect">
                        <option id="monthSelect_1" value="1">Tháng một</option>
                        <option id="monthSelect_2" value="2">Tháng hai</option>
                        <option id="monthSelect_3" value="3">Tháng ba</option>
                        <option id="monthSelect_4" value="4">Tháng tư</option>
                        <option id="monthSelect_5" value="5">Tháng năm</option>
                        <option id="monthSelect_6" value="6">Tháng sáu</option>
                        <option id="monthSelect_7" value="7">Tháng bảy</option>
                        <option id="monthSelect_8" value="8">Tháng tám</option>
                        <option id="monthSelect_9" value="9">Tháng chín</option>
                        <option id="monthSelect_10" value="10">Tháng mười</option>
                        <option id="monthSelect_11" value="11">Tháng mười một</option>
                        <option id="monthSelect_12" value="12">Tháng mười hai</option>
                    </select>

                    <canvas id="chartPie2"></canvas>
                </div>
            </div>

        </div>

    </main>


    <footer class="footer_container d-flex justify-content-center p-3 text-dark">
        <p>B2016962 &copy; 2023 Bản quyền thuộc về Nguyễn Văn Hậu.</p>
    </footer>

    <?php
$query_cv_dth = "select * from congviec where CV_TIENDO < 100 and CV_NGAYKETTHUC > NOW()";
$dth = $conn->query($query_cv_dth);
$soluong_dth = $dth->num_rows;

$query_cv_ht = "SELECT * FROM congviec WHERE CV_TIENDO = 100";
$ht = $conn->query($query_cv_ht);
$soluong_ht = $ht->num_rows;

$query_cv_qh ="select * from congviec where CV_TIENDO < 100 and CV_NGAYKETTHUC < NOW()";
$qh = $conn->query($query_cv_qh);
$soluong_qh = $qh->num_rows;



$query_cv_ht_thang = "SELECT
  calendar.month AS Month,
  COUNT(congviec.CV_NGAYBATDAU) AS TONG
FROM
  calendar
LEFT JOIN
  congviec ON EXTRACT(MONTH FROM congviec.CV_NGAYBATDAU) = calendar.month AND congviec.CV_TIENDO = 100
GROUP BY
  calendar.month
ORDER BY
  calendar.month;";
$query_cv_dth_thang = "SELECT
  calendar.month AS Month,
  COUNT(congviec.CV_NGAYBATDAU) AS TONG
FROM
  calendar
LEFT JOIN
  congviec ON EXTRACT(MONTH FROM congviec.CV_NGAYBATDAU) = calendar.month AND congviec.CV_TIENDO < 100 AND congviec.CV_NGAYKETTHUC > NOW()
GROUP BY
  calendar.month
ORDER BY
  calendar.month;";
$query_cv_qh_thang = "SELECT
  calendar.month AS Month,
  COUNT(congviec.CV_NGAYBATDAU) AS TONG
FROM
  calendar
LEFT JOIN
  congviec ON EXTRACT(MONTH FROM congviec.CV_NGAYBATDAU) = calendar.month AND congviec.CV_TIENDO < 100 AND congviec.CV_NGAYKETTHUC < NOW()
GROUP BY
  calendar.month
ORDER BY
  calendar.month;";
$cv_ht_thang = $conn->query($query_cv_ht_thang);
$cv_dth_thang = $conn->query($query_cv_dth_thang);
$cv_qh_thang = $conn->query($query_cv_qh_thang);
?>
    <script>
    const ctx1 = document.getElementById('chartBar');
    var barColors = ["#4bc0c0", "#E2777A", "#36a2eb"];

    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Đang thực hiện', 'Đã hoàn thành', 'Quá thời hạn'],
            datasets: [{
                label: 'Số lượng công việc',
                backgroundColor: barColors,
                data: ['<?php echo $soluong_dth?>', '<?php echo $soluong_ht?>', '<?php echo $soluong_qh?>'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        font: {
                            size: 15
                        },
                        display: true,
                        text: 'Các loại',
                    },
                },
                y: {
                    title: {
                        font: {
                            size: 15
                        },
                        display: true,
                        text: 'Số lượng',
                    },
                    beginAtZero: true
                }
            }
        }
    });

    const ctx2 = document.getElementById('chartPie');
    var pieColors = ["#4bc0c0", "#E2777A", "#36a2eb"];

    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Đang thực hiện', 'Đã hoàn thành', 'Quá thời hạn'],
            datasets: [{
                backgroundColor: pieColors,
                hoverOffset: 4,
                data: ['<?php echo $soluong_dth?>', '<?php echo $soluong_ht?>', '<?php echo $soluong_qh?>'],
                borderWidth: 1,

            }]
        },

        options: {

        }
    });

    const ht_thang = [<?php
                while ($soluong = $cv_ht_thang->fetch_assoc()):
                    echo $soluong['TONG'];
                    echo ",";
                endwhile;
                ?>];
    const dth_thang = [<?php
                while ($soluong = $cv_dth_thang->fetch_assoc()):
                    echo $soluong['TONG'];
                    echo ",";
                endwhile;
                ?>];
    const qh_thang = [
        <?php
                while ($soluong = $cv_qh_thang->fetch_assoc()):
                    echo $soluong['TONG'];
                    echo ",";
                endwhile;
                ?>
    ];
    const ctx3 = document.getElementById('byMonthChart');
    var barColors = ["blue", "green", "red"];
    const data = {
        labels: ['Tháng một', 'Tháng hai', 'Tháng ba', 'Tháng tư', 'Tháng năm', 'Tháng sáu', 'Tháng bảy', 'Tháng tám', 'Tháng chín', 'Tháng mười', 'Tháng mười một', 'Tháng mười hai'],
        datasets: [{
                label: 'Đã hoàn thành',
                data: ht_thang,
                backgroundColor: "#E2777A",
            },
            {
                label: 'Đang thực hiện',
                data: dth_thang,
                backgroundColor: "#4bc0c0",
            },
            {
                label: 'Quá thời hạn',
                data: qh_thang,
                backgroundColor: "#36a2eb",
            },
        ]
    };
    new Chart(ctx3, {
        type: 'bar',
        data: data,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: ''
                },
            },
            responsive: true,
            scales: {
                x: {
                    title: {
                        font: {
                            size: 16
                        },
                        display: true,
                        text: 'Tháng'
                    },
                    stacked: true,
                },
                y: {
                    title: {
                        font: {
                            size: 16
                        },
                        display: true,
                        text: 'Số lượng'
                    },
                    stacked: true
                }
            }
        }
    });
    var pieColors = ["#4bc0c0", "#E2777A", "#36a2eb"];
    const config = {
        type: 'pie',
        data: {
            labels: ['Đang thực hiện', 'Đã hoàn thành', 'Quá thời hạn'],
            datasets: [{
                label: 'Số lượng',
                backgroundColor: pieColors,
                hoverOffset: 4,
                data: [dth_thang[10], ht_thang[10], qh_thang[10]],
                borderWidth: 1,

            }]
        },
    }

    // const ctx4 = document.getElementById('chartPie2');

    const ctx4 = new Chart(
        document.getElementById('chartPie2'),
        config
    );


    var currentMonth = new Date().getMonth() + 1;
    currentMonth = "monthSelect_" + currentMonth;


    const select = document.getElementById('monthSelect');
    select.addEventListener('change', function handleChange(event) {
        e = event.target.value;
        console.log(e);
        ctx4.data.datasets[0].data = [dth_thang[e - 1], ht_thang[e - 1], qh_thang[e - 1]];
        ctx4.update();
    });
    </script>
    <script>
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
</body>

</html>