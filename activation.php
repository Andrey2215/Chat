<?php
          include ("bd.php");
          $result4 =    mysqli_query    ($db,"SELECT avatar FROM    users WHERE activation='0'    AND    UNIX_TIMESTAMP()    - UNIX_TIMESTAMP(date)    > 172800");
 if    (mysqli_num_rows($result4) > 0) {
            $myrow4    = mysqli_fetch_array($result4);  
            do 
            {
            if    ($myrow4['avatar'] == "avatars/net-avatara.jpg") {$a = "Ничего    не делать";}
            else    {
                     unlink ($myrow4['avatar']);
                     }
            }

            while($myrow4    = mysqli_fetch_array($result4));
            }
            mysqli_query    ($db,"DELETE FROM users WHERE activation='0' AND UNIX_TIMESTAMP() -    UNIX_TIMESTAMP(date) > 172800");
 if    (isset($_GET['code'])) {$code =$_GET['code']; }
            else 
            {    exit("
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
Вы    зашли на страницу без кода подтверждения!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
		");} 
 if (isset($_GET['login'])) {$login=$_GET['login'];    } 
            else 
            {    exit("
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
Вы    зашли на страницу без логина!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
		");} 
 $result = mysqli_query($db,"SELECT    id    FROM    users WHERE login='$login'"); 
            $myrow    = mysqli_fetch_array($result); 
 $activation    = md5($myrow['id']).md5($login);
 if ($activation == $code) {
                     mysqli_query($db,"UPDATE    users SET activation='1' WHERE login='$login'");
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
Ваш Е-мейл подтвержден! Теперь вы можете    зайти на сайт под своим логином!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
";
                     }
            else {echo "
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
Ошибка при активации акаунта.<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
";
            }
            ?>