<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>輔仁大學線上請假系統－老師端首頁</title>
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
        <div class="sa-main-header font-XL font-black"><b>112-2課程清單</b></div>
        <div class="sa-main-content">
            <div class="tr-container">
                <table class="sa-table" cellpadding="10" cellspacing="8">
                    <thead class="sa-thead">
                        <th>
                            <td width="15.5%">開課單位</td>
                            <td width="15.5%">課程名稱</td>
                            <td width="15.5%">學分</td>
                            <td width="15.5%">上課時間</td>
                            <td width="15.5%">上課地點</td>
                            <td width="15.5%">請假規則</td>
                        </th>
                    </thead>
                    <tbody class="sa-tbody">
                    <?php
                        
                        session_start();
                        $account=$_SESSION['account'];
                        $name=$_SESSION['name'];
                        $link=mysqli_connect('localhost','root');
                        mysqli_select_db($link,'sa');
                        $sql="select class_id,class_boss,class_name,week,class_room,(SELECT count(*) FROM `period` a2 where a2.class_id=a.class_id) as credit ,(SELECT MIN(D) FROM `period` a2 where a2.class_id=a.class_id) as LD ,(SELECT MAX(D) FROM `period` a2 where a2.class_id=a.class_id) as UD from information a where class_teacher='$name';
                        ";
                        $result=mysqli_query($link,$sql);
                        $count=1;
                        
                        

                        while($row=mysqli_fetch_assoc($result))
                        {   
                            $credit=$row['credit'];
                            $class_id=$row['class_id'];
                            $class_boss=$row['class_boss'];
                            $class_name=$row['class_name'];
                            $class_room=$row['class_room'];
                            $LD=$row['LD'];
                            $UD=$row['UD'];
                            $week=$row['week'];
                            //處理每周幾
                            $numbers = [1, 2, 3, 4, 5, 6];
                            $weekdays = ['每週一', '每周二', '每周三', '每周四', '每周五', '每周六'];
                            $i= array_search($week, $numbers);
                            if ($i!== false) {
                                $weekday = $weekdays[$i];
                            }
                            
                            echo "<tr><td style='color:#fff; background-color: #ff6a00;'><b>",$count,"</b></td><td><div>",$class_boss,"</div></td><td><div>",$class_name,"</div></td><td>",$credit,"</td><td><div>",$weekday,"<br></div><div>",$LD,"-",$UD,"</div></td><td>",$class_room,"</td><td><div><a href=tr_rule.php?class_id=", $class_id,"><i class='fa-regular fa-pen-to-square fa-lg' style='color: #3872e5;'></i></a></div></tr>";
                            $count++;
                        }
                        mysqli_close($link);
                    ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    })
    $('#myModal').modal('toggle')
</script>
</html>