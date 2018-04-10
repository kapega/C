<?php
// Для того чтобы выводить все ошибки и предупреждения
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Инициируем сессию
session_start();

//Получение параметра POST
function getPostParam($name) {
    return isset($_POST[$name]) ? $_POST[$name] : null;
}

define('USERS_FILE', __DIR__ . '/users.json');
function isPost() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

//Механизм login в систему
function login($login, $password) {
    $user = getUser($login);
    // В реальных условиях пароли в базе хранят не в открытом виде для пущей безопасности.
    if ($user && $user['password'] == $password) {
        unset($user['password']);
        $_SESSION['user'] = $user;
		$_SESSION['admin'] = true;
        return true;
    }
    return false;
}

function login_guest($name) {
	$_SESSION['guest'] = $name;
	$_SESSION['admin'] = false;
}

//Получение пользователя по логину
function getUser($login) {
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['login'] == $login) {
            return $user;
        }
    }
    return null;
}

//Получение списка пользователей
function getUsers()
{
    $file = file_get_contents(__DIR__ . '/users.json');
    $data = json_decode($file, true);
    if (empty($data)) {
        return [];
    }
    return $data;
}

//Перенаправление на нужную страницу
function redirect($page) {
    header("Location: $page");
    die;
}

//Проверка является ли пользователь авторизованным
function isAuthorizedUser()
{
    return !empty($_SESSION['admin']);
}

function isAuthorizedUserOrGuest()
{
    return !empty($_SESSION['user']) || !empty($_SESSION['guest']);
}

function getAuthorizedUser() {
    return $_SESSION['admin'] ? $_SESSION['user'] : null;
}

/*function logout() {
  session_destroy();
  redirect('index.php');
}*/

function redirect403($location) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
	header("Refresh: 2; url='$location'");
	echo 'Авторизуйтесь!'; 
	exit;
}

function userOrGuestName() {
	return $_SESSION['admin'] ? $_SESSION['user']['username'] : $_SESSION['guest'];
}
