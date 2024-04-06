<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>輔仁大學線上請假系統－學生端請假紀錄</title>
    <link rel="icon" type="image/x-icon" href="pic/1_5_19_1.jpg" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fda66bcbf6.js" crossorigin="anonymous"></script>
</head>

<body style="margin:0">
    <!--導覽列-->
    <nav class="fixed-top">


        <iframe src="layout.php" width="100%" height="100px" frameBorder="0"
            style="box-shadow: 0px 2px 5px 1px #bdbdbd;"></iframe>
    </nav>
    <!--主要頁面-->
    <?php

    $class_id=$_GET['class_id'];
     $link = mysqli_connect('localhost','root');
     mysqli_select_db ($link, 'sa');
     $sql="select class_leave,class_rule from information where class_id='$class_id'";
     $result=mysqli_query($link,$sql);
     if($row=mysqli_fetch_assoc($result))
         {
            $class_leave=$row['class_leave'];
            $class_rule=$row['class_rule'];
         } 
    else
         {
            $class_leave='';
            $class_rule='';           
         }
    ?>
    <div class="sa-container flex-column">
        <div class="sa-main-header font-XL font-black"><b>請假規則</b></div>
        <div class="sa-main-content font-black-d">
            <div class="sa-box">
                <div class="sa-box-content-rule">
                    <div class="sa-box-up font-M flex-row">
                        <form method="post" action="tr_rule_db.php" class="" enctype="multipart/form-data">
                            <!--單選框-->
                            <input type="hidden" name="class_id" value="<?php echo $class_id ?>">
                            <div class="flex-row record-left">
                                <div class="whether" style="margin-right: 10px;"><b>是否接受請假：</b></div>
                                <label class="ratio-custom">
                                <input type="radio" id="option1" name="class_leave" value="yes" <?php echo IsChecked($class_leave,"yes");?>>是&nbsp;&nbsp;
                                </label>
                                <label class="ratio-custom">
                                    <input type="radio" id="option2" name="class_leave" value="no" <?php echo IsChecked($class_leave,"no");?>>否
                                </label>                                
                            <br>
                            </div><br>
                            <!--事由（文字輸入框）-->
                            <div class="flex-row record-left">
                                <p class="font-black-d"><b>事由：</b></p>
                                <textarea class="input-text-large" name="class_rule" rows="4" cols="50"><?php echo $class_rule; ?></textarea>
                            </div><br>
                            <!--送出按鈕-->
                            <div class="flex">
                                <input class="btn-blue" type="submit" value="送出">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>

<?php
function IsChecked($class_id,$YesNo){
    $IsChk='';
    if (($class_id=='yes' and $YesNo=='yes') or ($class_id=='no' and $YesNo=='no')) $IsChk='checked';
    return $IsChk;
}
?>