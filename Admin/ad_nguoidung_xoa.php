<?php

// Xoá user
include_once('../condb/condb.php');
if(isset($_REQUEST['xoa_ma']) and $_REQUEST['xoa_ma'] != "") {
    try {
        $ma = $_GET['xoa_ma'];
        $sql = "DELETE FROM nguoidung WHERE ND_MA='$ma'";
        $query = mysqli_query($conn, $sql);
    }catch (mysqli_sql_exception $e) {
        alert_and_redirect("Không thể xoá người dùng này!!!","ad_nguoidung_ds.php");
        exit;

    }
    if ($query) {
        echo "Xoá thành công!";
        header("Location: ad_nguoidung_ds.php");
    } else {
        header("Location: ad_nguoidung_ds.php");
        echo "Error deleting row.: " . $conn->error;
    }
}