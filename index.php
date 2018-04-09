<?php
error_reporting(E_ALL);
require_once 'functions.php';
if (isPost()) {
  if ($_POST['user'] === 'admin') {
  	if ( login( getPostParam('login'), getPostParam('password') ) ) {
  		$_SESSION['userName'] = getAuthorizedUser()['username'];
  		$_SESSION['admin'] = true;
  		redirect('admin');
  	}
  } else {
  	$_SESSION['userName'] = $_POST['guest'];
  	redirect('list');
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
	<form method="POST">
		<ul>
			<li><label><input type="radio" name="user" value="admin">
				Авторизоваться как админ
				  <ul>
			<li><input placeholder="Логин" name="login" type="text"></li>
			<li><input placeholder="Пароль" name="password" type="password"></li>
		</ul></label></li>
			<li><label><input type="radio" name="user" value="guest">
				Войти как гость
				  <ul>
			<li><input  placeholder="Имя" name="guest" type="text"></li>
		</ul></label></li></ul>
		<input type="submit" value="Войти">
	</form>
</body>
</html>