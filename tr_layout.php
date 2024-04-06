<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>這裡是navbar模組</title>
    <link rel="stylesheet" href="layout.css">
    <script src="https://kit.fontawesome.com/fda66bcbf6.js" crossorigin="anonymous"></script>
    <style>
        a{text-decoration: none;}
        a:hover{text-decoration:underline;}
    </style>
</head>
<body>
    <!--學生端的導覽列
    <header class="l-main-header font-size-mid">
        <nav class="l-container flex-row">
            <div class="flex-row">
                <a href="index.html" target="_parent"><nav class="flex-row main-nav1">
                    <img src="pic/1_5_19_1.jpg" height="70px" style="padding-right: 15px;">
                    <img src="pic/輔仁大學線上請假系統.JPG" height="70px">
                </nav></a>
                <nav class="flex-row main-nav2">
                    <a href="#" target="_parent" class="blackkk" style="margin-right: 20px;"><b>請假申請</b></a>
                    <a href="stu_record.html" target="_parent" class="blackkk"><b>請假紀錄</b></a>
                </nav>
            </div>
            <div>
                <nav class="flex-row main-nav3">
                    <p class="blackkk"><b>王小明  學生</b><p>
                    <a href="login.html" target="_parent"><button class="btn" id="logout">登出</button></a>
                </nav>
            </div>
        </nav>
    </header>
    -->

    <!--老師端的導覽列-->
    <header class="l-main-header font-size-mid">
        <div class="l-container flex-row">
            <div class="flex-row">
                <a href="tr_index.html" target="_parent"><nav class="flex-row main-nav1">
                    <img src="pic/1_5_19_1.jpg" height="70px" style="padding-right: 15px;">
                    <img src="pic/輔仁大學線上請假系統.JPG" height="70px">
                </nav></a>
                <nav class="flex-row main-nav2">
                    <a href="#" target="_parent" class="blackkk" style="margin-right: 20px;"><b>批准請假</b></a>
                </nav>
            </div>
            <div>
                <nav class="flex-row main-nav3">
                    <?php
                        session_start();
                        echo "<p class='blackkk'><b>",$_SESSION['name'],"，  老師</b><p>";
                        echo "<a class='nav-link' target='_parent' href=logout.php><button class='btn' id='logout'>登出</button></a>";
                    
                    ?>
                </nav>
            </div>
        </div>
    </header>
    
</body>
</html>