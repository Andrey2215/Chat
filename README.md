# Чат для общения в границах дома
Данный проект разработан в ходе выполнения курсовой работы по Web-разработке.
## Реализованные фичи:
- Авторизация пользователя;
- Регистрация пользователя;
- Активация аккаунта через email;
- Личные страницы пользователей;
- Изменение логина или пароля;
- Пользовательские аватары;
- Отправка сообщений пользователям;
- Общая беседа жителей дома;
- Удаление сообщений.

## Содержание проекта:
Основные страницы сайта  | Содержание страницы  
----------------|---------------------------------------------------
avatars         | Директория хранения аватаров пользователя 
index.php       | Страница авторизации <br> Если пользователь авторизирован страница приветствия пользователя
page.php        | Главная страница пользователя(Смена аватара/логина/пароля) <br> Если страница принадлежит другому жильцу то страница является чатом с этим пользователем
domchat.php     | Страница общего чата зарегистрированных жильцов дома 
all_users.php   | Страница со списком всех зарегистрированных жильцов дома
reg.html        | Страница с формой регистрации

<br>

Основные модули сайта  | Содержание модуля 
----------------|---------------------------------------------------
activation.php  | Модуль активации аккаунта пользователя
bd.php          | Модуль хранящий в себе подключение к БД
domchatsend.php | Модуль отправки сообщения в общий чат дома
drop_post.php   | Модуль удаления сообщения в личном чате
dropchatdom.php | Модуль удаления сообщения в общем чате
exit.php        | Модуль выхода из аккаунта
post.php        | Модуль отправки сообщения в личном чате
save_user.php   | Модуль создания пользователя и отправка письма на почту для активации аккаунта
testreg.php     | Модуль авторизации пользователя
update_user.php | Модуль обновления данных пользователя (Логин/Пароль/Аватар)

<br>

Таблицы стилей (CSS) | Содержание таблицы стилей (CSS) 
----------------|---------------------------------------------------
Error.css       | Стили для ошибок
cssIndex.css    | Стиль для главной страницы (index.php)
cssall_users.css| Стили для страницы со всеми пользователями
cssdomchat.css  | Стиль для общего чата дома
csspage.css     | Стиль для страницы пользователей
cssreg.css      | Стиль страницы регистрации
