<?php
          session_start();
          include ("bd.php");
if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
            {
            $login = $_SESSION['login'];
            $password = $_SESSION['password'];
            $result2 = mysqli_query($db,"SELECT id FROM    users WHERE login='$login' AND password='$password'"); 
            $myrow2 = mysqli_fetch_array($result2); 
            if (empty($myrow2['id']))
               {
                exit("<!DOCTYPE html>
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
</html>");
               }
            }
            else {
            exit("<!DOCTYPE html>
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
</html>"); }
$old_login =    $_SESSION['login'];
            $id = $_SESSION['id'];
            $ava =    "avatars/net-avatara.jpg";
if (isset($_POST['login']))
                  {
            $login = $_POST['login'];
            $login = stripslashes($login); $login =    htmlspecialchars($login); $login = trim($login);
            if ($login == '') {    exit("
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
Вы не ввели логин<br>
<a href='page.php?id=$id'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
			");} 
if (strlen($login) < 3 or strlen($login)    > 15) {
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
Логин должен    состоять не менее чем из 3 символов и не более чем из 15.<br>
<a href='page.php?id=$id'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
			"); 

            }
            $result = mysqli_query($db,"SELECT id FROM    users WHERE login='$login'");
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
Извините,    введённый вами логин уже зарегистрирован. Введите другой логин.<br>
<a href='page.php?id=$id'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
			");

            }
$result4 = mysqli_query($db,"UPDATE users SET    login='$login' WHERE login='$old_login'");

            if ($result4=='TRUE') {
            mysqli_query($db,"UPDATE messages SET    author='$login' WHERE author='$old_login'");
            $_SESSION['login'] = $login;
            echo "<html><head><meta    http-equiv='Refresh' content='5;    URL=page.php?id=".$_SESSION['id']."'></head><body>Ваш логин изменен! Вы    будете перемещены через 5 сек. Если не хотите ждать, то <a    href='page.php?id=".$_SESSION['id']."'>нажмите    сюда.</a></body></html>";}//отправляем    пользователя назад
      } 

else if    (isset($_POST['password']))
                  {
            $password = $_POST['password'];
            $password = stripslashes($password);$password    = htmlspecialchars($password);$password = trim($password);
            if ($password == '') {    exit("Вы не ввели пароль");} 
if (strlen($password) < 3    or strlen($password) > 15) {
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
Пароль должен    состоять не менее чем из 3 символов и не более чем из 15.<br>
<a href='page.php?id=$id'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
			");

            }
$password = md5($password);
            $password = strrev($password);
            $password = $password."123";
$result4 = mysqli_query($db,"UPDATE users SET    password='$password' WHERE login='$old_login'");

            if ($result4=='TRUE') {
            $_SESSION['password'] = $password;
            echo "<html><head><meta    http-equiv='Refresh' content='5;    URL=page.php?id=".$_SESSION['id']."'></head><body>Ваш пароль изменен! Вы    будете перемещены через 5 сек. Если не хотите ждать, то <a    href='page.php?id=".$_SESSION['id']."'>нажмите    сюда.</a></body></html>";}//отправляем    обратно на его страницу
                 } 
            else if    (isset($_FILES['fupload']['name']))
                  {
if (empty($_FILES['fupload']['name']))
            {
            $avatar =    "avatars/net-avatara.jpg"; 
            $result7 = mysqli_query($db,"SELECT avatar    FROM users WHERE login='$old_login'");
            $myrow7 = mysqli_fetch_array($result7);
            if ($myrow7['avatar'] == $ava)    {
            $ava = 1;
            }
            else {unlink    ($myrow7['avatar']);}
            }
else 
            {
            $path_to_90_directory =    'avatars/';  
            if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['fupload']['name']))

                             {             
                                           $filename    = $_FILES['fupload']['name'];
                                           $source    = $_FILES['fupload']['tmp_name'];        
                                           $target    = $path_to_90_directory . $filename;
                                           move_uploaded_file($source, $target);
                if(preg_match('/[.](GIF)|(gif)$/',    $filename)) {
                            $im    = imagecreatefromgif($path_to_90_directory.$filename) ;
                            }
                            if(preg_match('/[.](PNG)|(png)$/', $filename)) {

                            $im =    imagecreatefrompng($path_to_90_directory.$filename) ;
                            }
                            
                            if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/',    $filename)) {
                                           $im =    imagecreatefromjpeg($path_to_90_directory.$filename);
                            }                    
$w = 150;

            $w_src = imagesx($im);
            $h_src = imagesy($im);
                     $dest = imagecreatetruecolor($w,$w); 
                     if ($w_src>$h_src) 
                        imagecopyresampled($dest, $im, 0, 0,
                                         round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                                     0, $w, $w,    min($w_src,$h_src), min($w_src,$h_src)); 
                     if ($w_src<$h_src) 
                        imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w,
                                      min($w_src,$h_src),    min($w_src,$h_src)); 
                     if ($w_src==$h_src) 
                     imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src); 
                                            
$date=time();
            imagejpeg($dest, $path_to_90_directory.$date.".jpg");
$avatar =    $path_to_90_directory.$date.".jpg";
$delfull = $path_to_90_directory.$filename; 
            unlink ($delfull);
$result7 =    mysqli_query($db,"SELECT avatar FROM users WHERE    login='$old_login'");

            $myrow7 = mysqli_fetch_array($result7);
if ($myrow7['avatar'] == $ava)    {
            $ava = 1;
            }
            else {unlink    ($myrow7['avatar']);}
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
Аватар должен быть в    формате JPG,GIF или PNG<br>
<a href='page.php?id=$id'> Назад </a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
					");
                                          }
}
$result4 = mysqli_query($db,"UPDATE users SET    avatar='$avatar' WHERE login='$old_login'");

            if ($result4=='TRUE') {
            echo "<html><head><meta    http-equiv='Refresh' content='5;    URL=page.php?id=".$_SESSION['id']."'></head><body>Ваша аватарка изменена! Вы    будете перемещены через 5 сек. Если не хотите ждать, то <a href='page.php?id=".$_SESSION['id']."'>нажмите    сюда.</a></body></html>";}
      } 
            ?>