<?php include_once '../condb/condb.php';
$query_thongbao = "SELECT * FROM thongbaond INNER JOIN congviec on thongbaond.CV_MA = congviec.CV_MA INNER JOIN nguoidung on thongbaond.ND_MA = nguoidung.ND_MA WHERE thongbaond.ND_MA = '$nd_ma'";
$ds_thongbao = $conn->query($query_thongbao);
$query_chuadoc = "SELECT * FROM thongbaond WHERE TB_XEM = '0' AND ND_MA='$nd_ma'";
$soluong_chuadoc = $conn->query($query_chuadoc);
$soluong_thongbao = mysqli_num_rows($soluong_chuadoc);
function timeAgo($time_ago)
{
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "mới đây";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "một phút trước";
        }
        else{
            return "$minutes phút trước";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "một tiếng trước";
        }else{
            return "$hours tiếng trước";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "hôm qua";
        }else{
            return "$days ngày trước";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "một tuần trước";
        }else{
            return "$weeks tuần trước";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "một tháng trước";
        }else{
            return "$months tháng trước";
        }
    }
    //Years
    else{
        if($years==1){
            return "một năm trước";
        }else{
            return "$years năm trước";
        }
    }
}
if (isset($_POST['dochet'])) {
    
    
        $sql = "UPDATE thongbaond
                SET TB_XEM = '1'
                WHERE TB_XEM = '0'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            header('Location: nguoidung.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        
    }
}
?>