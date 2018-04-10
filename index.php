<?php
error_reporting(E_ALL);
require_once 'functions.php';
if (isPost()) {
  if ($_POST['user'] === 'admin') {
  	if ( login( getPostParam('login'), getPostParam('password') ) ) {
  		redirect('admin.php');
  	}
  } else {
  	login_guest($_POST['guest']);
  	redirect('list.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Панель</title>
	<style type="text/css">
		li {
			list-style-type: none;
		}
	</style>
</head>
<body>
	<form method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>">
		<ul>
			<li>
				<label for="auth_admin">
					<input type="radio" name="user" value="admin" id="auth_admin">
					Авторизоваться как админ
				</label>
				<ul>
					<li><input placeholder="Логин" name="login" type="text"></li>
					<li><input placeholder="Пароль" name="password" type="password"></li>
				</ul>
			</li>
			<li>
				<label for="auth_guest">
					<input type="radio" name="user" value="guest" id="auth_guest" checked>
					Войти как гость
				</label>
				<ul>
					<li><input  placeholder="Имя" name="guest" type="text"></li>
				</ul>
			</li>
		</ul>
		<input type="submit" value="Войти">
	</form>
</body>
</html>
