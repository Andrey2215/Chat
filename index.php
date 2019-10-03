<?php 
session_start();          
include ("bd.php");      
if    (!empty($_SESSION['login']) and !empty($_SESSION['password']))
            {
            $login    = $_SESSION['login'];
            $password    = $_SESSION['password'];
            $result    = mysqli_query($db,"SELECT id,avatar FROM users WHERE login='$login' AND    password='$password'"); 
            $myrow    = mysqli_fetch_array($result);
            }
            ?>
	<!DOCTYPE html>
    <html lang="ru">
    <head>
	<meta name="keywords" content="Дом,Чат,Общий,Групповой,Общение">
	<meta name="description" content="Sweet Home это ресурс позволяющий в любой момент времени связаться с соседями вашего дома.">
	<meta charset="utf-8">
	<title>Главная страница</title>
	<link rel="stylesheet" type="text/css" href="cssIndex.css">
    </head>
    <body>
<?php
if (!isset($myrow['avatar']) or $myrow['avatar']=='') {
print <<<HERE
<div class="mainHelloHead">SWEET HOME</div>
<div class="mainLog">
<form class='form' action="testreg.php" method="post">
  <div class="mainDivLog1">
  <div class="floatl">
    Ваш логин:
	</div>
	<div class="floatr">
    <input name="login" type="text" size="15" maxlength="15"
HERE;

	
if (isset($_COOKIE['login']))
{
echo ' value="'.$_COOKIE['login'].'"';
}


print <<<HERE
>
  </div>
  </div> 
  <div class="mainDivLog1">
  <div class="floatl">
    Ваш пароль:
	</div>
	<div class="floatr">
    <input name="password" type="password" size="15" maxlength="15"
HERE;

	
if (isset($_COOKIE['password']))
{
echo ' value="'.$_COOKIE['password'].'"';
}
print <<<HERE
  >
  </div>
  </div>
  <div class="mainDivLog2">
            <input    name="checkbox" type="checkbox" value=1>    Запомнить меня.
            </div>
		    <div class="mainDivLog2">
            <input type="submit" class="butv"    name="submit" value="Войти">
            </div>	
			<br>
			<div class="mainDivLog2">
            <a    href="reg.html">Зарегистрироваться</a> 
			</div>
			</form>
</div>
<div class="mainbottom"></div>
HERE;
}
else
{
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

<div class="info">Ваш логин   <br> <strong>$_SESSION[login]</strong><br><a href='page.php?id=$_SESSION[id]'><img alt='$_SESSION[login]' src='$myrow[avatar]'></a></div>
			<div class='hide'>
			<div class='mesbodysend'>
<div class="meskont"><h1>Здравствуйте $_SESSION[login]</h1>
Вас приветствует администрация сайта Sweet Home.
Мы очень рады что вы выбрали Sweet Home в качестве сервиса для общения с соседями вашего дома.
Мы стремимся обеспечить комфорт в общении с сожителями вашего дома.
Надеемся что наш сайт надолго засядет вам в душу.
Кроме этого Sweet Home предоставляет возможность группового чата что может быть полезно для решения групповых вопросов и организации мероприятий.</div>
</div></div>
</div></div>
<div class="mainbottom"></div>
HERE;
}
?>
</body>
</html>