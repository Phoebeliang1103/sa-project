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
        <div class="sa-main-header font-XL font-black"><b>請假申請批准區</b></div>
        <div class="sa-main-content">
            <div class="tr-container">
                <table class="sa-table" cellpadding="10" cellspacing="8">
                    <thead class="sa-thead">
                            <td width="16%">申請編號</td>
                            <td width="16%">開課單位</td>
                            <td width="20%">課程名稱</td>
                            <td width="16%">上課時間</td>
                            <td width="16%">申請文件</td>
                            <td width="16%">狀態</td>
                    </thead>
                    <tbody class="sa-tbody">
                        <?php
                        $link = mysqli_connect('localhost','root');
                        mysqli_select_db($link,'sa');
                        mysqli_set_charset($link,'utf8');
                        $sql = "select * from record inner join information using(class_id)";
                        $result = mysqli_query($link,$sql);
                        while($row = mysqli_fetch_assoc($result))
                        { 
                            echo
                            '<tr>
                                <td>
                                    <div>', $row["leave_id"] ,'</div>
                                </td>
                                <td>
                                    <div>', $row["class_boss"] ,'</div>
                                </td>
                                <td>
                                    <div>', $row["class_name"] ,'</div>
                                </td>
                                <td>
                                    <div>';
                                    $weekdays = [1 => "星期一", 2 => "星期二", 3 => "星期三", 4 => "星期四", 5 => "星期五", 6 => "星期六", 7 => "星期日"];

                                    if (isset($weekdays[$row["week"]])) {
                                        echo $weekdays[$row["week"]]."</div>";
                                    } else {
                                        echo "錯誤(不在預設星期數內)</div>";
                                    }
                                    echo '
                                </td>
                                <td><a href="tr_check_ap.php?leave_id=', $row['leave_id'] ,'"><i class="fa-solid fa-eye fa-lg"></i></a></td>
                                <td>
                                    <b>';
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
                                        echo '<div class="font-blue">未審核</div>';
                                    }
                                    echo
                                    '</b>
                                </td>
                            </tr>';
                             }
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