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
print <<<HERE
<!DOCTYPE html>
<html lang="ru">
<head>
<title>Ошибка</title>
<meta charset="utf-8">
<meta    http-equiv='Refresh' content='5;    URL=index.php'>
<link rel="stylesheet" type="text/css" href="CssAll_users.css">
</head>
<body>
<div class="mainHelloHead">SWEET HOME</div>
<div class="mainDivLog">
<div class="error">
Для просмотра содержимого данной страницы необходимо зарегестрироваться
</div>
</div>
<div class="mainbottom"></div>
</body>
</html>
HERE;
exit;
}
else if(empty($_SESSION['login']) and ($_SESSION['password'])){
print <<<HERE
<html lang="ru">
<head>
<title>Ошибка</title>
<meta charset="utf-8">
<meta    http-equiv='Refresh' content='5;    URL=index.php'>
<link rel="stylesheet" type="text/css" href="CssAll_users.css">
</head>
<body>
<div class="mainHelloHead">SWEET HOME</div>
<div class="mainDivLog">
<div class="error">
Для просмотра содержимого данной страницы необходимо зарегестрироваться
</div>
</div>
<div class="mainbottom"></div>
</body>
</html>
HERE;
exit;
}
}
$result3 = mysqli_query($db,"SELECT id FROM    users WHERE login='$login' AND password='$password' and activation=1"); 
$myrow3 = mysqli_fetch_array($result3); 
if (empty($myrow3['id'])) {
print <<<HERE
<html lang="ru">
<head>
<title>Ошибка</title>
<meta charset="utf-8">
<meta    http-equiv='Refresh' content='5;    URL=page.php?id=$_SESSION[id]'>
<link rel="stylesheet" type="text/css" href="cssall_users.css">
</head>
<body>
<div class="mainHelloHead">SWEET HOME</div>
<div class="mainDivLog">
<div class="error">
<div>Для просмотра содержимого необходимо активировать ваш аккаунт</div>
</div>
</div>
<div class="mainbottom"></div>
</body>
</html>
HERE;
exit;}
?>
<html lang="ru">
<head>
<title>Все пользователи</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="Cssall_Users.css">
</head>
<body>
 <?php
print <<<HERE
<div class="mainHelloHead">SWEET HOME</div>
<div class="mainBody">
<div class="mainBodyIn">
<div class="linkbox">
<div class="link"><a  href='page.php?id=$_SESSION[id]'>Моя страница</a></div>
<div class="link"><a  href='index.php'>Главная страница</a></div>
<div class="link"><a  href='all_users.php'>Чатик</a></div>
<div class="link"><a href='domchat.php?id=$_SESSION[id]'>Чат дома</a></div>
<div class="link"><a  href='exit.php'>Выход</a></div>
</div>
<div class="info">Ваш логин   <br> <strong>$_SESSION[login]</strong></div>
			<div class='hide'>
			<div class='mesbody'>
HERE;

$result = mysqli_query($db,"SELECT login,id,nzp_dom,avatar    FROM users join kvar on users.id=kvar.id_account");
$myrow = mysqli_fetch_array($result);
if ($myrow['nzp_dom']==$_SESSION['dom'])
            do
            {
            printf("<div class='meskont'><div class='mesimg'><img src='%s'></div><div class='meslink'><a    href='page.php?id=%s'>%s</a></div></div>",$myrow['avatar'],	$myrow['id'],$myrow['login']);
            }
            while($myrow = mysqli_fetch_array($result));

 print <<<HERE
			</div>
			</div></div></div>
			<div class="mainbottom"></div>
            </body>
            </html>
HERE;
			 ?>