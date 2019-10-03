<?php

if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} }
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
if(isset($_POST['numls'])){$numls=$_POST['numls'];if ($numls==''){unset($numls);} }
if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} }


if (empty($login) or empty($password) or empty($email) or empty($numls))
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
Вы ввели не всю    информацию, вернитесь назад и заполните все поля!<br>
<a href='reg.php'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>	"); 
}
if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)) 
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
Неверно введен е-mail!<br>
<a href='reg.php'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>	
");}

$login = stripslashes($login);
$login = htmlspecialchars($login);

$numls = stripslashes($numls);
$numls = htmlspecialchars($numls);

$password = stripslashes($password);
$password = htmlspecialchars($password);

$login = trim($login);
$password = trim($password);
$numls = trim($numls);

if (strlen($login) < 3 or strlen($login) > 15) {

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
Логин должен состоять не менее чем из 3 символов и не более чем из 15.<br>
<a href='reg.php'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");

}
if(strlen($numls)>11 or strlen($numls)<9) {exit("
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
Неверный формат личного счёта!<br>
<a href='reg.php'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");}

if (strlen($password) < 3 or strlen($password) > 15) {

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
Пароль должен состоять не менее чем из 3 символов и не более чем из 15.<br>
<a href='reg.php'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
"); 

}

if (empty($_FILES['fupload']['name']))
{
$avatar = "avatars/net-avatara.jpg"; 
}

else 
{

$path_to_90_directory = 'avatars/';

	
if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['fupload']['name']))
	 {	
	 	 	
		$filename = $_FILES['fupload']['name'];
		$source = $_FILES['fupload']['tmp_name'];	
		$target = $path_to_90_directory . $filename;
		move_uploaded_file($source, $target);

	if(preg_match('/[.](GIF)|(gif)$/', $filename)) {
	$im = imagecreatefromgif($path_to_90_directory.$filename) ; 
	}
	if(preg_match('/[.](PNG)|(png)$/', $filename)) {
	$im = imagecreatefrompng($path_to_90_directory.$filename) ;
	}
	
	if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename)) {
		$im = imagecreatefromjpeg($path_to_90_directory.$filename);
	}
	
$w = 150;  

$w_src = imagesx($im); 
$h_src = imagesy($im); 

         $dest = imagecreatetruecolor($w,$w); 

         if ($w_src>$h_src) 
         imagecopyresampled($dest, $im, 0, 0,
                          round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                          0, $w, $w, min($w_src,$h_src), min($w_src,$h_src)); 

         if ($w_src<$h_src) 
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w,
                          min($w_src,$h_src), min($w_src,$h_src)); 

         if ($w_src==$h_src) 
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src); 
		 

$date=time();
imagejpeg($dest, $path_to_90_directory.$date.".jpg");


$avatar = $path_to_90_directory.$date.".jpg";

$delfull = $path_to_90_directory.$filename; 
unlink ($delfull);
}
else 
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
Аватар должен быть в формате <strong>JPG,GIF или PNG</strong><br>
<a href='reg.php'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>

"); 
	     }
}

$password = md5($password);

$password = strrev($password);

$password = $password."123";

include ("bd.php");

$result = mysqli_query($db,"SELECT id FROM users WHERE login='$login'");
$myrow = mysqli_fetch_array($result);
if (!empty($myrow['id'])) {

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
Извините, введённый вами логин уже зарегистрирован. Введите другой логин.!<br>
<a href='reg.php'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");

}

$resnumls= mysqli_query($db,"select num_ls from kvar where num_ls='$numls'");
$myrownumls=mysqli_fetch_array($resnumls);
if(empty($myrownumls['num_ls'])){
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
	Такого личного счёта не существует<br>
<a href='reg.php'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");
}

$numlsidac=mysqli_query($db,"SELECT id_account FROM kvar WHERE num_ls=$numls");
$myrownumls = mysqli_fetch_array($numlsidac);
if (!empty($myrownumls['id_account'])) {

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
Данный личный счёт уже используется в другой учётной записи<br>
<a href='reg.php'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");

}

$result2 = mysqli_query ($db,"INSERT INTO users (login,password,avatar,email,date) VALUES('$login','$password','$avatar','$email',NOW())");

$resultid = mysqli_query($db,"select id from users where login='$login'");
$myrowid = mysqli_fetch_array($resultid);
$myrowidconvert=$myrowid['id'];
$resultnumls = mysqli_query($db,"UPDATE kvar set id_account='$myrowidconvert' where num_ls='$numls'");
if ($result2=='TRUE')
{

$result3 = mysqli_query ($db,"SELECT id FROM users WHERE login='$login'");
$myrow3 = mysqli_fetch_array($result3);
$activation = md5($myrow3['id']).md5($login);

$subject = "Подтверждение регистрации";
$message = "Здравствуйте! Спасибо за регистрацию на SWEET HOME\nВаш логин: ".$login."\n
Перейдите по ссылке, чтобы активировать ваш аккаунт:\nhttp://localhost:8080/activation.php?login=".$login."&code=".$activation."\nС уважением,\n
Администрация";
mail($email, $subject, $message);
	
echo "
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
Вам на почту выслано письмо, перейдите по ссылке что бы активировать ваш акаунт<br>
<a href='index.php'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>";
}

else {
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
Ошибка! Вы не зарегистрированы.<br>
<a href='reg.php'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");

     }
?>