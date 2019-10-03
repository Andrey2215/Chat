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
}}
else {
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
");}
            $id2 = $_SESSION['id'];
if (isset($_GET['id'])) { $id    = $_GET['id'];}
$result = mysqli_query($db,"SELECT poluchatel    FROM messages WHERE id='$id'"); 
            $myrow =    mysqli_fetch_array($result);
if ($login ==    $myrow['poluchatel']) {
$result = mysqli_query ($db,"DELETE FROM    messages WHERE id = '$id' LIMIT 1");
            if ($result == 'true') {
            echo "
<!DOCTYPE html>
<html lang='ru'>
<head>
<meta    http-equiv='Refresh' content='5;    URL=page.php?id=".$id2."'>
<meta charset='utf-8'>
<link rel='stylesheet' type='text/css' href='Error.css'>
</head>
<body>
<div class='mainHelloHead'>SWEET HOME</div>
<div class='mainDivLog'>
<div class='mes'>
Ваше сообщение удалено<br>
<a href='page.php?id=".$id2."'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
";}
            else {
            echo "
<!DOCTYPE html>
<html lang='ru'>
<head>
<meta    http-equiv='Refresh' content='5;    URL=page.php?id=".$id2."'>
<meta charset='utf-8'>
<link rel='stylesheet' type='text/css' href='Error.css'>
</head>
<body>
<div class='mainHelloHead'>SWEET HOME</div>
<div class='mainDivLog'>
<div class='mes'>
Ваше сообщение не удалено<br>
<a href='page.php?id=".$id2."'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
";}
}
            else {exit("
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
Вы пытаетесь    удалить сообщение, отправленное не вам!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");}
            ?>