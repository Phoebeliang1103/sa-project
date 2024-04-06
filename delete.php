<?php
    $id=$_GET['id'];
    

    $link = mysqli_connect('localhost','root');
    mysqli_select_db($link,"sa");
    mysqli_set_charset($link,'utf8mb4');
    $sql="delete from record where leave_id='$id'";
    if(mysqli_query($link,$sql)){
        echo "<script>location.href = 'stu_record.php';</script>";

    }
    else{
        echo "<script>alert('刪除失敗');</script>";

    }
    mysqli_close($link);
    ?>