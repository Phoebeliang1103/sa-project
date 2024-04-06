<?php
$leave_category = $_POST['leave_category'];
$leave_date = $_POST['leave_date'];
$leave_reason = $_POST['leave_reason'];
$leave_D = ($_POST['time_1'] ?? '') . ($_POST['time_2'] ?? '') . ($_POST['time_3'] ?? '');
$leave_prove = $_FILES['leave_prove'] ?? null;

$link = mysqli_connect('localhost', 'root');
mysqli_select_db($link, "sa");
mysqli_set_charset($link, 'utf8mb4');

//file
if (isset($_FILES["leave_prove"]) && $_FILES["leave_prove"]["error"] == UPLOAD_ERR_OK) {
    $file_content = addslashes(file_get_contents($_FILES["leave_prove"]["tmp_name"]));
} else {
    $file_content = '';
}

//leave_id
$sql_max_leave_id = "SELECT MAX(CAST(leave_id AS UNSIGNED)) AS max_leave_id FROM record";
$result_max_leave_id = mysqli_query($link, $sql_max_leave_id);
$row = mysqli_fetch_assoc($result_max_leave_id);
$max_leave_id = $row['max_leave_id'];

$leave_id = $max_leave_id + 1;

//account
session_start();

$account = $_SESSION['account'];

//申請日期
$apply_date = date("Y-m-d");

//課程

$dayOfWeek = date('w', strtotime($leave_date));
$sql = "SELECT * FROM information WHERE week = '$dayOfWeek'";
$result = mysqli_query($link, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['class_name'] = $row['class_name'];
    $_SESSION['class_id'] = $row['class_id'];
}
$class_name = $_SESSION['class_name'];
$class_id = $_SESSION['class_id'];

// Ensure unique leave_id
$sql_check = "SELECT leave_id FROM record WHERE leave_id != -1";
$result_check = mysqli_query($link, $sql_check);
$count = mysqli_num_rows($result_check);

if ($count > -1) {
    // Insert record into database
    $sql_insert = "INSERT INTO record (leave_id, account, leave_category, leave_date, leave_reason, leave_prove, leave_state, leave_D, class_id, class_name, leave_apply_date, leave_denied_reason) 
                    VALUES ('$leave_id','$account', '$leave_category', '$leave_date', '$leave_reason', '$file_content', '審核中','$leave_D','$class_id','$class_name','$apply_date','')";
    if (mysqli_query($link, $sql_insert)) {
        echo "<script>alert('申請已送出');location.href = 'stu_record.php';</script>";
    } else {
        echo "<script>alert('申請失敗');location.href = 'stu_apply.html';</script>";
    }
} else {
    echo "<script>alert('leave_id 無法插入新記錄');</script>";
}
?>