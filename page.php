<?php
            session_start();
include ("bd.php");
            if (isset($_GET['id'])) {$id =$_GET['id']; } 
            else
            { exit("
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
Вы зашли на    страницу без параметра!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");}
            if (!preg_match("|^[\d]+$|", $id))    {
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
Неверный    формат запроса! Проверьте URL<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>
");
            }
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
"); }
            $result = mysqli_query($db,"SELECT * FROM    users WHERE id='$id'"); 
            $myrow =    mysqli_fetch_array($result);
if (empty($myrow['login'])) {    exit("
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
											Пользователя не существует! Возможно он был удален.<br>
											<a href='index.php'>Главная    страница</a>
											</div>
											</div>
											<div class='mainbottom'></div>
											</body>
											</html>
");}
?>
			<!DOCTYPE html>
            <html lang="ru">
            <head>
			<meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="CssPage.css">
            <title><?php echo $myrow['login'];    ?></title>
            </head>
            <body>
			<div class="mainHelloHead">SWEET HOME</div>
			<div class="mainBody">
			<div class="mainBodyIn">
<?php
print <<<HERE
<div class="linkbox">
<div class="link"><a  href='page.php?id=$_SESSION[id]'>Моя страница</a></div>
<div class="link"><a  href='index.php'>Главная страница</a></div>
<div class="link"><a  href='all_users.php'>Чатик</a></div>
<div class="link"><a href='domchat.php?id=$_SESSION[id]'>Чат дома</a></div>
<div class="link"><a  href='exit.php'>Выход</a></div>
</div>
<div class="info">
HERE;
if($myrow['activation']==1 and $myrow['id']=$_SESSION['id']){
print <<<HERE
Пользователь активирован<br>
Код вашего дома: $_SESSION[dom]<br>
HERE;
}
else{
print <<<HERE
HERE;
}
if ($myrow['login'] == $login) {
print <<<HERE
<form action='update_user.php'    method='post' enctype='multipart/form-data'>
            Ваш аватар:<br>
            <img alt='аватар' src='$myrow[avatar]'><br>
            Изображение должно быть    формата jpg, gif или png. Изменить аватар:<br>
            <input class="butv" type="FILE"    name="fupload">
            <input class="butv" type='submit' name='submit' value='изменить'>
            </form>
<form action='update_user.php'    method='post'>
            Ваш логин    <strong>$myrow[login]</strong>.<br> Изменить логин:<br>
            <input name='login' type='text'>
            <input class="butv" type='submit' name='submit' value='изменить'>
            </form>
            <br>
<form action='update_user.php'    method='post'>
            Изменить пароль:<br>
            <input name='password' type='password'>
            <input class="butv" type='submit' name='submit' value='изменить'>
            </form>
            <br>

            </div>
			<div class='hide'>
				 <div class='mesbody'>
HERE;
$tmp = mysqli_query($db,"SELECT * FROM    messages WHERE poluchatel='$login' ORDER BY id DESC"); 
            $messages =    mysqli_fetch_array($tmp);
if (!empty($messages['id'])) {
            do 
              {
            $author = $messages['author'];
            $result4 = mysqli_query($db,"SELECT avatar,id    FROM users WHERE login='$author'"); 
            $myrow4 = mysqli_fetch_array($result4);
if (!empty($myrow4['avatar']))    {
            $avatar = $myrow4['avatar'];
            }
            else {$avatar =    "avatars/net-avatara.jpg";}
     printf("
	 <div class='meskont'>
	 <div class='mesbox'>
                <div class='mesimg'><a href='page.php?id=%s'><img alt='аватар'    src='%s'></a></div>
                <div class='fl cont'>Автор:<a href='page.php?id=%s'>%s</a>  </div>
                <div class='fr'>%s</div>
                <div>Сообщение:</div>
                <div class='fl text'>%s</div>
				<div class='fr'><a href='drop_post.php?id=%s'>Удалить</a></div>
</div></div>
                 ",$myrow4['id'],$avatar,$myrow4['id'],$author,$messages['date'],$messages['text'],$messages['id']);
              }
                 while($messages = mysqli_fetch_array($tmp));
                    echo("</div></div>");}
					
else    {
echo    ("	 <div class='meskont'>
	 <div class='mesbox'><div class='mn'>Сообщений нет</div></div></div>");
}
}
else
            {
print <<<HERE
			Данная страничка принадлежит: <br> $myrow[login]<br>
            <img alt='аватар' src='$myrow[avatar]'><br>
			</div>
			<div class='hide'>
			<div class='mesbodysend'>
HERE;
			
			$tmp = mysqli_query($db,"SELECT * FROM    messages WHERE (poluchatel='$myrow[login]' and author='$_SESSION[login]') or(poluchatel='$_SESSION[login]' and author='$myrow[login]') ORDER BY id DESC"); 
            $messages =    mysqli_fetch_array($tmp);
if (!empty($messages['id'])) {
            do 
              {
            $author = $messages['author'];
            $result4 = mysqli_query($db,"SELECT avatar,id FROM users WHERE login='$author'");
            $myrow4 = mysqli_fetch_array($result4);
if (!empty($myrow4['avatar']))    {
            $avatar = $myrow4['avatar'];
            }
            else {$avatar =    "avatars/net-avatara.jpg";}
     printf("
	 <div class='meskont'>
	 <div class='mesbox'>
                <div class='mesimg'><a href='page.php?id=%s'><img alt='аватар'    src='%s'></a></div>
                <div class='fl cont'>Автор:<a href='page.php?id=%s'>%s</a>  </div>
                <div class='fr'>%s</div>
                <div>Сообщение:</div>
                <div class='fl text'>%s</div>
				<div class='fr'><a href='drop_post.php?id=%s'>Удалить</a></div>
</div></div>
                 ",$myrow4['id'],$avatar,$myrow4['id'],$author,$messages['date'],$messages['text'],$messages['id']);
              }
                 while($messages = mysqli_fetch_array($tmp));
                    }
					else    {
echo    ("	 <div class='meskont'>
	 <div class='mesbox'><div class='mn'>Сообщений с этим пользователем нет</div></div></div>");
}
print<<<HERE
			</div>
            <form action='post.php' method='post'>
            Отправить Ваше    сообщение:
            <textarea style="resize: none;" cols='43' rows='4'    name='text'></textarea><br>
            <input type='hidden' name='poluchatel'    value='$myrow[login]'>
            <input type='hidden' name='id'    value='$myrow[id]'>
            <input type='submit' name='submit' value='Отправить'>
            </form>
			</div></div>
HERE;
}		
?>
</div></div></div></div>
<div class="mainbottom"></div>
            </body>
            </html>