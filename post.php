<?php
          session_start();
          include ("bd.php");
if (!empty($_SESSION['login']) and    !empty($_SESSION['password']))
            {
            $login = $_SESSION['login'];
            $password = $_SESSION['password'];
            $result2 = mysqli_query($db,"SELECT id FROM    users WHERE login='$login' AND password='$password'"); 
            $myrow2 = mysqli_fetch_array($result2); 
            if (empty($myrow2['id']))

               {
                exit("
<!DOCTYPE html>
<html lang='ru'>
<head>
<meta charset='utf-8'>
<link rel='stylesheet' type='text/css' href='Error.css'>
</head>
<body>
<div class='mainHelloHead'>SWEET HOME</div>
<div class='mainDivLog'>
<div class='mes'>
Вход на эту страницу разрешен    только зарегистрированным пользователям!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");
               }
            }
            else {
            exit("
!DOCTYPE html>
<html lang='ru'>
<head>
<meta charset='utf-8'>
<link rel='stylesheet' type='text/css' href='Error.css'>
</head>
<body>
<div class='mainHelloHead'>SWEET HOME</div>
<div class='mainDivLog'>
<div class='mes'>
Вход на эту страницу разрешен    только зарегистрированным пользователям!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
"); }
if (isset($_POST['id'])) { $id    = $_POST['id'];}
            if (isset($_POST['text'])) { $text =    $_POST['text'];}
            if (isset($_POST['poluchatel'])) {    $poluchatel = $_POST['poluchatel'];} 
            $author = $_SESSION['login'];
            $date = date("Y-m-d");
if (empty($author) or empty($text) or    empty($poluchatel) or empty($date)) {
            exit ("
<!DOCTYPE html>
<html lang='ru'>
<head>
<meta charset='utf-8'>
<link rel='stylesheet' type='text/css' href='Error.css'>
</head>
<body>
<div class='mainHelloHead'>SWEET HOME</div>
<div class='mainDivLog'>
<div class='mes'>
Вы ввели не всю    информацию, вернитесь назад и заполните все поля!<br>
<a href='page.php?id=$author'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");}
$text = stripslashes($text);
            $text =    htmlspecialchars($text);

            $result2 = mysqli_query($db,"INSERT INTO    messages (author, poluchatel, date, text) VALUES    ('$author','$poluchatel','$date','$text')");
echo "<html><head><meta    http-equiv='Refresh' content='0;    URL=page.php?id=".$id."'></head></html>";
            ?>