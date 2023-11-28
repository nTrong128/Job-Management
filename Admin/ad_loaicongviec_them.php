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

    <main>

        <div class="form_center">
            <form id="form" name="form" method="post" onsubmit="return validateForm()" class="form">
                <div class="container p-5 py-4 m-2 border border-2 rounded">
                    <h1 class="text-light text-center">TẠO CÔNG VIỆC</h1>
                    <hr class="text-dark border border-2 rounded " style="border-top: 4px solid white">

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Tên loại công việc:</label>
                        </div>
                        <div class="col p-1 ">
                            <input class="form-control" type="text" placeholder="Nhập tên loại công việc" name="ten" id="ten" required>
                        </div>
                    </div>

                    <div class="row p-2 my-1 rounded">
                        <div class="col p-1  text-light">
                            <label class="" for="text">Nhập mô tả:</label>
                        </div>
                        <div class="col p-1 ">
                            <textarea class="form-control" name="mota" id="mota" placeholder="Mô tả" rows="3"></textarea>
                        </div>
                    </div>



                    <div class="btn_form ">
                        <button style="width:100%" type="submit" class="btn  btn-dark" name="taoloaicongviec">Tạo loại công việc</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

</body>

</html>