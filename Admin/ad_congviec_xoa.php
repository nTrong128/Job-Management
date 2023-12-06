<?php

// Xoá công việc
include_once('../condb/condb.php');
if(isset($_REQUEST['xoa_ma']) and $_REQUEST['xoa_ma'] != "") {
    try {
        $ma = $_GET['xoa_ma'];
        $sql = "DELETE FROM congviec WHERE CV_MA='$ma'";
        $query = mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception $e) {
        alert_and_redirect("Không thể xoá công việc này!!!","ad_congviec_ds.php");
        exit;
    }


    if ($query) {
        echo "Xoá thành công!";
        header("Location: ad_congviec_ds.php");
    } else {
        header("Location: ad_congviec_ds.php");
        echo "Error deleting row.: " . $conn->error;
    }
}