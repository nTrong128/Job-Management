<?php
include_once '../condb/condb.php';

if (!isset($_SESSION['nguoidung'])) {
    session_destroy();
    unset($_SESSION['nguoidung']);
    header("location: ../index.php");
    exit; // Ensure no further code is executed after redirection
    
}
$email = $_SESSION['nguoidung'];
$query = "select * from nguoidung where ND_EMAIL ='$email'";
$sql = mysqli_query($conn, $query);
$nguoidung = mysqli_fetch_assoc($sql);
$nd_ma = $nguoidung['ND_MA'];

$nguoithuchien = $_GET['nd_ma'];
$congviecnhacnho  = $_GET['chitiet_ma'];
try {
        $result = $conn->execute_query("SELECT * FROM thongbao WHERE ND_MA=? AND CV_MA=?", [$nguoidung_tb, $ma]);

        if ($result->num_rows == 1) {
            $sql_thongbao = "UPDATE thongbaond
                            SET TB_XEM = '0',
                                TB_TG = NOW(),
                                TB_NOIDUNG = 'Nhắc nhở công việc'
                            WHERE ND_MA=? AND CV_MA=?";
        } else {
            $sql_thongbao = "INSERT INTO thongbaond
                            (ND_MA, CV_MA,TB_NOIDUNG, TB_TG, TB_XEM)
                            VALUES (?, ?, 'Nhắc nhở công việc', NOW(), '0')";
        }

        $query_thongbao = $conn->execute_query($sql_thongbao, [$nguoithuchien, $congviecnhacnho]);

        if ($query_thongbao) {
            alert_and_redirect("Đã gửi thông báo nhắc nhở","nd_cv_giamsat.php");
            // header('Location: nd_cv_giamsat.php');

            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    } catch (mysqli_sql_exception $e) {
        var_dump($e);
        exit;
    }
?>
