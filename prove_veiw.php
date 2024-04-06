<?php
$link = mysqli_connect('localhost','root');
mysqli_select_db($link,"sa");
mysqli_set_charset($link,'utf8mb4');

$leave_id = $_GET['id'];

$sql = "SELECT leave_prove FROM record WHERE leave_id = $leave_id";
$result = mysqli_query($link, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $leave_prove = $row['leave_prove'];

    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="leave_prove_'.$leave_id.'.pdf"'); 
    echo $leave_prove; 
} else {
    echo "未找到檔案";
}
?>