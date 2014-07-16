<?php
require('libs/smarty/Smarty.class.php');

session_start();
if ($_SESSION['authorized'] !== true) {
    $hostname = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['PHP_SELF']);

    header('Location: http://'.$hostname.($path == '\\' ? '' : $path).'/login.php');
    exit;
}

$smarty = new Smarty;
$smarty->display('index.tpl');
?>