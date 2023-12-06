<?php
// Xoá user
include_once('../condb/condb.php');
if(isset($_REQUEST['xoa_ma']) and $_REQUEST['xoa_ma'] != "") {
    try {
    $id = $_GET['xoa_ma'];
    $sql = "DELETE FROM loaicongviec WHERE LCV_MA='$id'";
        $query = mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception $e) {
        alert_and_redirect("Không thể xoá loại này!!!","ad_loaicongviec_ds.php");
        exit;
    }
    if ($query) {
        echo "Xoá thành công!";
        header("Location: ad_loaicongviec_ds.php");
    } else {
        header("Location: ad_loaicongviec_ds.php");
        echo "Error deleting row.: " . $conn->error;
    }
}