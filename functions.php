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
        return true;
    }
    return false;
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
    if (!$data) {
        return [];
    }
    return $data;
}

//Перенаправление на нужную страницу
function redirect($page) {
    header("Location: $page.php");
    die;
}

//Проверка является ли пользователь авторизованным
function isAuthorizedUser()
{
    return !empty($_SESSION['user']);
}

function getAuthorizedUser() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}
function logout() {
  session_destroy();
  redirect('index');
}