<?php

include_once '../condb/condb.php';
$request = $_POST['request'];
$cv_ma = $_POST['cv_ma'];
$date = $_POST['date'];
$response = $_POST['response'];

global $conn;
request_handling($request, $cv_ma, $date, $response);


function remove_request($request)
{
    global $conn;
    $sql  = "DELETE FROM giahancongviec WHERE GH_MA = '$request'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        return;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return;
    }
}
function request_handling($request, $cv_ma, $date, $response)
{
    global $conn;

    if ($response == 0) {
        remove_request($request);
        return false;
    }

    $sql = "UPDATE congviec
            SET CV_NGAYKETTHUC = '$date'
            WHERE CV_MA = '$cv_ma'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        remove_request($request);
        return;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return;
    }


}
