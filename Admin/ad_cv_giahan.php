<?php
include_once '../condb/condb.php';

$request = $_POST['request'];
$cv_ma = $_POST['cv_ma'];
$date = $_POST['date'];
$response = $_POST['response'];

$requestHandlingResult = request_handling($request, $cv_ma, $date, $response);

if ($requestHandlingResult === true) {
    echo "Request handled successfully!";
} else {
    echo "Error: " . $requestHandlingResult;
}

function remove_request($request)
{
    global $conn;
    $sql = "DELETE FROM giahancongviec WHERE GH_MA = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $request);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        return "Error: " . $stmt->error;
    }
}

function request_handling($request, $cv_ma, $date, $response)
{
    global $conn;
    $sql = "INSERT INTO thongbaond(ND_MA, CV_MA, TB_NOIDUNG, TB_TG, TB_XEM)
            VALUES (?, ?, ?, NOW(), '0')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $nd_ma, $cv_ma, $tb_noidung);

    if ($response == 0) {
        $tb_noidung = "Yêu cầu gia hạn của bạn không được chấp nhận";
    } else {
        $tb_noidung = "Yêu cầu gia hạn của bạn được chấp nhận";
        $sql_update = "UPDATE congviec
                       SET CV_NGAYKETTHUC = ?
                       WHERE CV_MA = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param('ss', $date, $cv_ma);
        $stmt_update->execute();
    }

    $nd_ma = get_nd_ma($request);

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        return remove_request($request);
    } else {
        return "Error: " . $stmt->error;
    }
}

function get_nd_ma($request)
{
    global $conn;
    $sql = "SELECT ND_MA FROM giahancongviec WHERE GH_MA = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $request);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['ND_MA'];
}
?>