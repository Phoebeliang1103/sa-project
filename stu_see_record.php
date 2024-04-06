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
        <div class="sa-main-header font-XL font-black"><b>檢視請假申請</b></div>
        <div class="sa-main-content font-S font-black-d">
            <div class="sa-box">
                <!--此請假申請的基本資訊-->
                <div class="sa-box-content">
                <?php
                    $leave_id = $_GET['leave_id'];        
                    session_start();
                    $name=$_SESSION['name'];    
                    $department=$_SESSION['department'];     
                               
                    $link = mysqli_connect('localhost','root');
                    mysqli_select_db($link,"sa");
                    mysqli_set_charset($link,'utf8mb4');    
                    $sql="select * from record where leave_id='$leave_id'";
                    $result=mysqli_query($link,$sql);
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $class_id=$row['class_id'];
                        echo '<div class="sa-box-left">'; 
                        echo '<p><b>申請編號：</b>' . $row['leave_id'] . '</p>'; 
                        echo '<p><b>學號：</b>' . $row['account'] . '</p>';
                        echo '<p><b>假別：</b>'. $row['leave_category'] .'</p>';
                        echo '<p><b>申請日期：</b>' . $row['leave_apply_date'] . '</p>'; 
                        echo '</div>'; 
                        echo '<div class="sa-box-right">'; 
                        echo '<p><b>系級：</b>' . $department . '</p>';
                        echo '<p><b>姓名：</b>' . $name . '</p>';
                        echo '<p><b>請假日期：</b>' . $row['leave_date'] . '</p>';
                        echo '</div>'; 
                        $sql_info="select class_teacher from information where class_id='$class_id'";
                        $result_info = mysqli_query($link, $sql_info);
                        while ($row_info = mysqli_fetch_assoc($result_info)) {
                           $teacher=$row_info['class_teacher']; 
                            
                        }
                    ?>
                    
                    </div>
                <!--此請假申請的課堂-->
                <div>
                    <table class="sa-table" cellpadding="10" cellspacing="8">
                        <thead class="sa-thead">
                            <th>
                                <td width="35%">課程名稱</td>
                                <td width="20%">任課老師</td>
                                <td width="35%">請假節數</td>
                            </th>
                        </thead>
                        <tbody class="sa-tbody">
                            <?php
                            echo '<tr>';
                            echo '<td>1</td>'; 
                            echo '<td>' . $row['class_name'] . '</td>'; 
                            echo '<td>' . $teacher . '</td>'; 
                            echo '<td>' . $row['leave_D'] . '</td>';
                            echo '</tr>';
                            ?>
                        </tbody>
                    </table>
                </div><br>
                <div>
                    <?php
                    echo '<p><b>事由：</b>'. $row['leave_category'] .'</p>';
                    echo '<p><b>事由：</b><a href="prove_view.php?id=' . $row['leave_id'] . '"><u>請假證明.pdf</u></a></p>';
                    ?>
                </div><br>

                <!--若尚未審核或被駁回，會出現編輯鍵及刪除鍵；反之則不會出現-->
                <div class="flex-row btn-center">
                <?php
                    echo '<a href="update.php?id=' . $row['leave_id'] . '"><button type="button" class="btn-blue-light">編輯</button></a>'; ?>
                                    
                    <div>
                        <button type="button" class="btn-orange-light" data-toggle="modal" data-target="#exampleModal">
                            刪除
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title" id="exampleModalLabel"></div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <div class="font-black font-ML flex" style="padding: 20px 0;"><b>確定是否刪除此申請？</b></div>
                                <div class="flex-column">
                                    <?php
                                    echo '<a href="delete.php?id=' . $row['leave_id'] . '"><button  type="button" class="btn-blue-light" style="margin-bottom:10px">是</button></a>'; }?>
                                    <button type="button" class="btn-orange-light" style="margin-bottom:30px;" data-dismiss="modal">否</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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