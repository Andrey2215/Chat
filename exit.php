<?php
          session_start();
          if    (empty($_SESSION['login']) or empty($_SESSION['password'])) 
          {
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
Вход на эту страницу разрешен    только зарегистрированным пользователям!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");}
          
			unset($_SESSION['password']);
            unset($_SESSION['login']); 
            unset($_SESSION['id']);
			unset($_SESSION['activation']);//    уничтожаем переменные в сессиях
        exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");
            // отправляем пользователя на главную страницу.
            ?>