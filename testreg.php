<?php
session_start();
if (isset($_POST['login'])) 
{ 
$login = $_POST['login']; 
if ($login == '') 
{
	unset($login);
}}
if (isset($_POST['password'])) 
{ 
$password=$_POST['password'];
 if ($password =='')
{ 
unset($password);
}}
if (empty($login) or empty($password))
{
print <<<HERE
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="Error.css">
</head>
<body>
<div class="mainHelloHead">SWEET HOME</div>
<div class="mainDivLog">
<div class='mes'>
Вы не заполнили все поля.
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class="mainbottom"></div>
</body>
</html>
HERE;
exit;
}
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$login = trim($login);
$password = trim($password);
include ("bd.php");
$result = mysqli_query($db,"SELECT * FROM    users WHERE login='$login' AND    password='$password'    AND    activation='1'");
$myrow = mysqli_fetch_array($result);
	   
$password    = md5($password);
            $password    = strrev($password);
            $password    = $password."123";

$result = mysqli_query($db,"SELECT * FROM    users WHERE login='$login' AND    password='$password'");
            $myrow    = mysqli_fetch_array($result);
            if (empty($myrow['id']))
            {
print <<<HERE
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="Error.css">
</head>
<body>
<div class="mainHelloHead">SWEET HOME</div>
<div class="mainDivLog">
<div class="mes">
Введённый логин или пароль неверный.
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class="mainbottom"></div>
</body>
</html>
HERE;
exit;
            }
            else {          
                    $_SESSION['password']=$myrow['password']; 
                    $_SESSION['login']=$myrow['login']; 
                    $_SESSION['id']=$myrow['id'];
					$_SESSION['activation']=$myrow['activation'];
					$resultdom=mysqli_query($db,"select nzp_dom from kvar where id_account=$_SESSION[id]");
					$rowdom=mysqli_fetch_array($resultdom);
					$_SESSION['dom']=$rowdom['nzp_dom'];
			if (isset($_POST['checkbox'])){
					$cb=$_POST['checkbox'];
					if($cb!=""){
            if ($_POST['checkbox'] == '1') {
            setcookie("login",    $_POST["login"], time()+172800);
            setcookie("password",    $_POST["password"], time()+172800);
            }}}}                 
            echo "<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>";          
?>
</body>