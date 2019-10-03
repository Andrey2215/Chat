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
Вход на эту страницу разрешен только зарегистрированным пользователям!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");
}}
else
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
Вход на эту страницу разрешен только зарегистрированным пользователям!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>			
"); }
			
if (isset($_POST['poluchatel'])) { $koddom = $_POST['poluchatel']; if ($koddom == '') { unset($koddom);} }
if (isset($_POST['id'])) { $idotpr = $_POST['id']; if ($idotpr == '') { unset($idotpr);} }
if (isset($_POST['text'])) { $text = $_POST['text']; if ($text == '') { unset($text);} }
if (empty($koddom) or empty($idotpr) or    empty($text)) {
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
<a href='domchat.php?id=$_SESSION[id]'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>	
");}
$text = stripslashes($text);
$text =    htmlspecialchars($text);
$result = mysqli_query($db,"insert into domchat(otpr,massege,nzp_domchat,data) values('$idotpr','$text','$koddom',NOW())");
if ($result=='TRUE'){
	echo "<html><head><meta    http-equiv='Refresh' content='0;    URL=domchat.php?id=".$_SESSION['id']."'></head></html>";
}
else{exit("
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
Произошла ошибка<br>
<a href='domchat.php?id=$_SESSION[id]'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>	");}
			