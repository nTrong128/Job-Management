<?php include_once '../condb/condb.php'; 
$ma = $_GET['thongbao_ma']; 
$sql = "UPDATE thongbaond
        SET TB_XEM = '0'
        WHERE TB_MA = '$ma'";
$query = mysqli_query($conn, $sql);
if ($query) {
    header('Location: nguoidung.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;  
}

?>