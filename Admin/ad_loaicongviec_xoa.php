<?php

// Xoá user
include_once('../condb/condb.php');
if(isset($_REQUEST['xoa_ma']) and $_REQUEST['xoa_ma'] != "") {
    $id = $_GET['xoa_ma'];
    $sql = "DELETE FROM loaicongviec WHERE LCV_MA='$id'";
    if ($conn->query($sql) === false) {
        echo "Error deleting row.: " . $conn->error;
    } else {
        echo "Xoá thành công!";
        header("Location: ad_loaicongviec_ds.php");
    }
}
