<?php  
    session_start();
    $ldap = $_POST['ldap'];
    $pass = $_POST['pass'];

    $link = mysqli_connect('localhost','root');
    mysqli_select_db($link,"sa");
    mysqli_set_charset($link,'utf8mb4');
    $sql = "select * from personal where account ='$ldap' and password ='$pass'";
    $result = mysqli_query($link,$sql);
    if($row = mysqli_fetch_assoc($result))
    {
       $_SESSION['account']=$ldap;
       $_SESSION['password']=$pass;
       $_SESSION['name']=$row['name'];
       $_SESSION['department']=$row['department'];
       $_SESSION['level']=$row['level'];
       $_SESSION['class_id'] = $row['class_id'];
       $_SESSION['class_ratio'] = $row['class_ratio'];
       
        header("Location: index.php");

    }
    else
    {
        echo '<script> alert("帳號或密碼錯誤，請重新輸入"); location.href="login.html" </script>'; 
    }
?>