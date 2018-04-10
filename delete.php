<?php 
require_once 'functions.php';
if (!isAuthorizedUser())
{
    redirect403('index.php');
}

//print_r($_GET);
if(isset($_GET['test']))
{
        $myFile = "tests.json";
        $num = $_GET['test'];
        $arr = json_decode(file_get_contents($myFile),true);
        unset($arr[$num]);
		$arr = json_encode($arr);
		file_put_contents($myFile, $arr);
		redirect('list.php');
} else {
	echo "GET[test] is empty!";
}
?>
