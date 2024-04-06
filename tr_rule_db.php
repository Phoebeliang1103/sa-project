<?php
    $class_id=$_POST['class_id'];
    $class_leave=$_POST['class_leave'];
    $class_rule=$_POST['class_rule'];

    $link=mysqli_connect('localhost','root');
    mysqli_select_db($link,'sa');
    $sql="update information set class_id='$class_id', class_leave='$class_leave', class_rule='$class_rule' where class_id='$class_id'";
    $res = mysqli_query($link, $sql);
    
    if($res)
        {
            //echo "成功";
           
            echo "<script>alert('修改成功');location.href = 'tr_index.php';</script>";

        }
        else{
            //echo "失敗";
            
            echo "<script>alert('修改失敗');location.href = 'tr_index.php';</script>";
       
        }
        mysqli_close($link);
?>