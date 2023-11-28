<?php include_once '../condb/condb.php'; 
$ma = $_GET['thongbao_ma']; 
$sql = "DELETE FROM thongbao
        WHERE TB_MA = '$ma'";
$query = mysqli_query($conn, $sql);
if ($query) {
    header('Location: ad_trangchu.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;  
}

?>