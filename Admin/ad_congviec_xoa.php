<?php

// Xoá công việc
include_once('../condb/condb.php');
if(isset($_REQUEST['xoa_ma']) and $_REQUEST['xoa_ma'] != "") {
    $ma = $_GET['xoa_ma'];
    $sql = "DELETE FROM congviec WHERE CV_MA='$ma'";
    if ($conn->query($sql) === false) {
        echo "Error deleting row.: " . $conn->error;
    } else {
        echo "Xoá thành công!";
        header("Location: ad_congviec_ds.php");
    }
}