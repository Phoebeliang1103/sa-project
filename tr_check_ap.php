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
                <div class="sa-box-content">
                    <div class="sa-box-left">
                        <?php
                        $leave_id = $_GET['leave_id'];
                        $i = 1;

                        $link = mysqli_connect('localhost','root');
                        mysqli_select_db($link,'sa');
                        mysqli_set_charset($link, 'utf8');
                        $sql = "select * from record inner join information using(class_id) inner join personal using(account) where leave_id = '$leave_id'";
                        $result = mysqli_query($link,$sql);
                        while($row = mysqli_fetch_assoc($result))
                        {
                            
                            echo'
                                <p><b>申請編號：</b>', $row['leave_id'] ,'</p>
                                <p><b>學號：</b>', $row['account'] ,'</p>
                                <p><b>假別：</b>', $row['leave_category'] ,'</p>
                                <p><b>申請日期：</b>', $row['leave_apply_date'] ,'</p>
                            </div>
                            <div class="sa-box-right">
                                <p><b>系級：</b>', $row['department'] ,'</p>
                                <p><b>姓名：</b>', $row['name'] ,'</p>
                                <p><b>請假日期：</b>', $row['leave_date'] ,'</p>
                            </div>
                        </div>
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
                                    <tr>
                                        <td>', $i ,'</td>
                                        <td>', $row['class_name'] ,'</td>
                                        <td>', $row['class_teacher'] ,'</td>
                                        <td>';
                                            $leaveD = $row['leave_D'];
                                            $leave_D_length = strlen($row["leave_D"]);
                                            $array = [];
                                            $k = 0;
                                            for( $j = 0 ; $j <= $leave_D_length/2 ; $j++){
                                                array_push($array, substr($leaveD, $k , 2));
                                                $k+=2;
                                            }

                                            if (!empty($array)) {
                                                $last_element = array_pop($array); // 移除並返回陣列中的最後一個元素
                                                $arrayprint = implode(' / ', $array);// 使用' / '將陣列元素連接為字串
                                                echo "$arrayprint</td>";
                                                if (!empty($last_element)) {
                                                    echo "$last_element</td>";
                                                }
                                            }
                                        $i++ ;?>
                                    <?php
                                    echo '
                                    </tr>
                                </tbody>
                            </table>
                        </div><br>
                        <div>
                            <p><b>事由：</b>', $row['leave_reason'] ,'</p>
                    
               
                        <p><b>證明文件：</b><a href="prove_view.php?id='. $row['leave_id'] .'" target="_blank"><u><i class="fa-solid fa-file-pdf"></i>請假證明.pdf</u></a></p>

                        </div><br>
                        <hr class="hr"/><br>
                        <form method="post" action="update_state.php" class="" enctype="multipart/form-data">
                            <input name="leave_id" value="', $leave_id ,'" hidden>
                            <!--單選框-->
                            <div class="flex-row record-left">
                                <div class="whether" style="margin-right: 10px;"><b>是否接受請假：</b></div>
                                <label class="ratio-custom">'; 
                                if($row['leave_state'] == "option1")
                                {
                                    $check1 = "checked";
                                    $check2 = "";
                                }
                                else if($row['leave_state'] == "option2")
                                {
                                    $check1 = "";
                                    $check2 = "checked";
                                }
                                else
                                {
                                    $check1 = "";
                                    $check2 = "";
                                }
                                echo '
                                    <input type="radio" id="option1" name="option" value="option1" onchange="showTextarea()"', $check1 ,'>批准&nbsp;&nbsp;
                                </label>
                                <label class="ratio-custom">
                                    <input type="radio" id="option2" name="option" value="option2" onchange="showTextarea()"', $check2 ,'>駁回
                                </label><br>
                            </div><br>';
                            if($row['leave_state'] == "option2")
                            {
                                $visibility = "visibility:visible;";
                            }
                            else
                            {
                                $visibility = "visibility:hidden;";
                            }
                            echo '
                            <!--事由（文字輸入框）-->
                            <div style="', $visibility ,'" id="leave_reason_textarea" class="flex-row record-left">
                                <p class="font-black-d"><b>原因：</b></p>
                                <textarea class="input-text-large" name="leave_denied_reason" rows="4" cols="50">', $row['leave_denied_reason'] ,'</textarea>
                            </div><br>
                            <!--送出按鈕-->
                            <div class="flex">
                                <input class="btn-blue" type="submit" value="提交">
                            </div>
                        </form>
                    </div>
                </div>
            </div>';
        }?>
</body> 


<script>
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    })
    $('#myModal').modal('toggle')

    function showTextarea() {
    var denied = document.getElementById("option2");
    var leave_reason_ta = document.getElementById("leave_reason_textarea");

    if (denied.checked) {
        leave_reason_ta.style.visibility = "visible";
    } else {
        leave_reason_ta.style.visibility = "hidden";
    }
}
</script>
</html>