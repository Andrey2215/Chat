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
Вход на эту страницу разрешен только зарегистрированным пользователям!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>	");
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
Вход на эту страницу разрешен только зарегистрированным пользователям!<br>
<a href='index.php'>Главная    страница</a>
</div>
</div>
<div class='mainbottom'></div>
</body>
</html>	"); }
print<<<HERE
<!DOCTYPE html>
<html lang="ru">
<head>
<title>Чат дома</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="CssDomchat.css">
</head>
<body>
<script type="text/javascript">
 window.onload = function(){
 document.getElementById('scroll').scrollTop = 9999;
}
</script>
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
				 <div id="scroll" class='mesbody'>
HERE;
			
            $result = mysqli_query($db,"SELECT * FROM    users WHERE id='$id'"); 
            $myrow =    mysqli_fetch_array($result);
if (empty($myrow['login'])) {    exit("Пользователя не существует! Возможно он был удален.");}
if ($myrow['login'] == $_SESSION['login']) {
$tmp = mysqli_query($db,"SELECT otpr,massege,nzp_domchat,data,id_account,id_mes FROM domchat join kvar on domchat.otpr=kvar.id_account WHERE nzp_dom=$_SESSION[dom] ORDER BY data ASC"); 
            $messages =    mysqli_fetch_array($tmp);
if (!empty($messages['otpr'])) {
            do 
              {
            $author = $messages['otpr'];
            $result4 = mysqli_query($db,"SELECT avatar,id,login    FROM users WHERE id='$author'"); 
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
				<div class='fr'><a href='dropchatdom.php?id=%s'>Удалить</a></div>
</div></div>
                 ",$myrow4['id'],$avatar,$myrow4['id'],$myrow4['login'],$messages['data'],$messages['massege'],$messages['id_mes']);
              }
                 while($messages = mysqli_fetch_array($tmp));
                }
					
else    {
echo    "<div class='meskont'>
	 <div class='mesbox'><div class='mn'>Сообщений нет</div></div></div>";
}
}
print <<<HERE
</div>
            <form action='domchatsend.php' method='post'>
            Отправить Ваше    сообщение:<br>
            <textarea style="resize: none;" cols='43' rows='4'    name='text'></textarea><br>
            <input type='hidden' name='poluchatel'    value='$_SESSION[dom]'>
            <input type='hidden' name='id'    value='$_SESSION[id]'>
            <input type='submit' name='submit' value='Отправить'>
            </form>
			</div>
			</div>
			</div>
			<div class="mainbottom"></div>

			</body>
</html>
HERE;

?>
			