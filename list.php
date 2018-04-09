<?php
require_once 'functions.php';
if (empty($_SESSION['userName'])) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
  header("Refresh: 2; url='index.php'");
  echo 'Авторизуйтесь!'; 
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Тест</title>
</head>
<body>
<h1>Тесты</h1>
<?php
	$tests_file = file_get_contents('tests.json');
	$json = json_decode($tests_file, true); // из файла json получаем структуры php
	foreach ($json as $index => $test) {
		echo "<p><a href='test.php?test={$index}'>{$test['test_name']}</a></p>";
		if (isAuthorizedUser()) {
            echo "<a href='delete.php?test={$index}' style='text-decoration: none; color: black'>удалить тест</a>";
        }
	}
?>

 <?php 
 if (isAuthorizedUser()) {
          echo "<p><a href='admin.php'><input type='button' value='загрузить еще тесты'></a></p>";
 }
?>
</body>
</html>