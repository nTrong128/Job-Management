<?php include_once '../condb/condb.php'; ?>
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
    <title>Người dùng</title>
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

                <div class="">
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


                    <button type="button" class="btn btn-warning px-2 me-2">
                        Notifications <span class="badge badge-light">4</span>
                    </button>
                    <a class="btn btn-outline-light px-2 py-2 me-2" href="../User/trangchu.php" role="button">ĐĂNG XUẤT</a>


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

        <div class="rounded p-4 d-flex justify-content-sm-between">
            <input class="rounded-2" type="text" id="searchBar" placeholder="Tìm kiếm người dùng.." title="Nhập thông tin người dùng">
            <a href="ad_nguoidung_them.php" class="btn btn-dark p-3 px-4">Thêm người dùng</a>
        </div>
        <div class="jobs_table table_job_scroll mx-4 ms-4 rounded bg-light  border border-2">
            <table id="dataTable" class="table tableFixHead text-center align-middle">
                <thead class="align-middle">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mã số cán bộ</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
$query_nguoidung = "SELECT * FROM nguoidung";
$ds_nguoidung = mysqli_query($conn, $query_nguoidung);
$i = 1;
while ($nguoidung = mysqli_fetch_assoc($ds_nguoidung)):
    ;
    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $i;
    $i += 1; ?>
                        </th>
                        <td>
                            <?php echo $nguoidung['ND_HOTEN']; ?>
                        </td>
                        <td>
                            <?php echo $nguoidung['ND_NGAYSINH']; ?>
                        </td>
                        <td>
                            <?php echo $nguoidung['ND_DIACHI']; ?>
                        </td>
                        <td>
                            <?php echo $nguoidung['ND_SDT']; ?>
                        </td>
                        <td>
                            <?php echo $nguoidung['ND_EMAIL']; ?>
                        </td>
                        <td>
                            <?php echo $nguoidung['ND_MSCB']; ?>
                        </td>
                        <td>
                            <button title="Chỉnh sửa thông tin người dùng" type="button" class="btn" data-toggle="modal" data-target="#myModal">
                                <a href="ad_nguoidung_sua.php?capnhat_ma=<?php echo $nguoidung['ND_MA'];?>">
                                    <i class="fa-solid fa-user-pen"></i>
                                </a>
                            </button>

                            <button class="btn" title="Xoá người dùng"><a href="ad_nguoidung_xoa.php?xoa_ma=<?php echo $nguoidung['ND_MA'];?>"><i class="fa-sharp fa-solid fa-trash"></i></a></button>
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