<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>輔仁大學線上請假系統－學生端請假紀錄</title>
    <link rel="icon" type="image/x-icon" href="pic/1_5_19_1.jpg" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fda66bcbf6.js" crossorigin="anonymous"></script>
</head>
<body style="margin:0">
    <!--導覽列-->
    <nav class="fixed-top">
        <iframe src="layout.php" width="100%" height="100px" frameBorder="0" style="box-shadow: 0px 2px 5px 1px #bdbdbd;"></iframe>
    </nav>
    <!--主要頁面-->
    <div class="sa-container flex-column">
        <div class="sa-main-header font-XL font-black"><b>112-2請假紀錄</b></div>
        <div class="sa-main-content">
            <table class="sa-table" cellpadding="10" cellspacing="8">
                <thead class="sa-thead">
                    <th>
                        <td width="12%">申請編號</td>
                        <td width="10%">假別</td>
                        <td width="15%">課程名稱</td>
                        <td width="15%">開始日</td>
                        <td width="15%">結束日</td>
                        <td width="15%">申請日</td>
                        <td width="10%">狀態</td>
                        <td width="8%">檢視</td>
                    </th>
                </thead>
                <tbody class="sa-tbody">
                    
                    <?php
                    $link = mysqli_connect('localhost','root');
                    mysqli_select_db($link,"sa");
                    mysqli_set_charset($link,'utf8mb4');    
                    session_start();
                    $account=$_SESSION['account'];
                    $sql="select * from record where account='$account'";
                    $result=mysqli_query($link,$sql);
                    $row_count = mysqli_num_rows($result); 
                    if ($row_count > 0) {
                    $result=mysqli_query($link,$sql);
                    while($row=mysqli_fetch_assoc($result))
                    {
                        echo '<tr>'; 
                        echo '<td></td>'; 
                        echo '<td>' . $row['leave_id'] . '</td>';
                        echo '<td>' . $row['leave_category'] . '</td>';
                        echo '<td>' . $row['class_name'] . '</td>'; 
                        echo '<td>' . $row['leave_date'] . '</td>'; 
                        echo '<td>' . $row['leave_date'] . '</td>'; 
                        echo '<td>' . $row['leave_apply_date'] . '</td>'; 
                        echo '<td>';
                        if($row["leave_state"]=="option1")
                        {
                            echo '<div class="font-black-d">已批准</div>';
                        }
                        else if($row["leave_state"]=="option2")
                        {
                            echo '<div class="font-orange">已駁回</div>';
                        }
                        else
                        {
                            echo '<div class="font-blue">審核中</div>';
                        }
                        echo '<td><a href="stu_see_record.php?leave_id=' . $row['leave_id'] . '"><i class="fa-solid fa-file fa-lg" style="color: #337cb8;"></i></a></td>';
                        echo '</tr>'; 
                    }
                
                  ?>
                </tbody>
            </table>
        </div><br>
        <?php } else{
        echo '<div class="flex font-ML font-black-d">
            <p><b>目前無請假紀錄</b></p>
        </div>';
        }
        ?>
    </div>
</body>
<script>
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    })
    $('#myModal').modal('toggle')
</script>
</html>