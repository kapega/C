<?php 
require_once 'functions.php';
if (!isAuthorizedUser())
{
    location('index');
}

//print_r($_GET);
if(isset($_GET['test']))
{
        $myFile = "tests.json";
        $num = $_GET['test'];
        $arr = json_decode(file_get_contents($myFile),true);
		foreach ($arr as $key => $list) { 
        unset($arr[$num]);
     	//echo "<pre>";
		//print_r($arr);
		//echo "</pre>";
}
        }
            $arr = json_encode($arr);
            file_put_contents($myFile,$arr);


?>