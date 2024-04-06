<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>輔仁大學線上請假系統－學生端首頁</title>
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
        <div class="sa-main-header font-XL font-black"><b>112-2課程表</b></div>
        <div class="sa-main-content">
            <table class="sa-table" cellpadding="10" cellspacing="8">
                <thead class="sa-thead">
                    <th>
                        <?php
                        session_start();
                        $account=$_SESSION['account'];
                    $link = mysqli_connect('localhost','root');
                    mysqli_select_db ($link, 'sa');
                    foreach (array('星期一', '星期二', '星期三','星期四','星期五','星期六') as $v) 
                            {
                                echo "<td width=15.5%>",$v,"</td>";
                            }
                            ?>
                    </th>
                </thead>
                <tbody class="sa-tbody">
                    <?php
                    $Mcount=0;
                    foreach (array('D1', 'D2', 'D3','D4','DN','D5','D6','D7','D8') as $D) {                     
                    ?>
                    <tr>
                        <td style="color:#fff; background-color: #ff6a00;"><b><?php echo $D;?></b></td>
                        <?php
                        for ($week=1;$week<=6;$week++){
                            $sql = "SELECT * FROM choose c join information i on i.class_id=c.class_id join period p on p.class_id=c.class_id where account='$account' and week=".$week." and D='".$D."'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_assoc($result);
                            if (!$row){
                                $class_name="";
                                $class_teacher="";
                                $class_room="";
                                $class_leave="";
                                $class_rule="";
                                $flag=0;
                            }
                            else
                            {
                                $class_name=$row['class_name'];
                                $class_teacher=$row['class_teacher'];
                                $class_room=$row['class_room'];
                                $class_leave=$row['class_leave'];
                                $class_rule=$row['class_rule'];
                                $flag=1;
                            }
                            $Mcount=$Mcount+1;
                            ?>
                            <td>
                            <button type="button" class="btn-underline" style="background-color: transparent; border: 0cap;" data-toggle="modal" data-target="#exampleModal_<?php echo $Mcount ?>">
                                <b><?php echo $class_name ?></b>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal_<?php echo $Mcount ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div><br>
                                        <div class="modal-body">
                                            <div class="font-blue font-L"><?php echo $class_name ?></div><br>
                                            <div class="font-orange font-M"><?php echo $class_teacher ?>｜<?php echo $class_room ?></div><br>
                                            <div class="font-black-d font-S modal-body-content">
                                            <?php
                                            if($class_rule==''){
                                                echo "無資料";
                                            ?>
                                            <?php
                                            }
                                            else{
                                                echo $class_rule;
                                            }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if($flag==1)
                            { 
                            ?>
                                <div>———————</div>
                                <div><?php echo $class_teacher ?></div>
                                <div><?php echo $class_room ?></div>
                            <?php
                            if($class_leave=='yes')
                            {
                            ?>
                                <i class="fa-solid fa-circle-check fa-lg" style="color: #337cb8;"></i>
                            <?php
                            }
                            if($class_leave=='no')
                            {
                                ?>
                                <i class="fa-solid fa-circle-xmark fa-lg" style="color: #ff6a00;"></i>
                                <?php
                            }
                            }
                            ?>
                            
                        </td>
                        <?php
                        }
                        ?>
                    </tr>      
                    <?php
                    }
                    ?>
                </tbody>
            </table>
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