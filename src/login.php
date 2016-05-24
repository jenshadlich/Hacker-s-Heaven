<?php
$username = "";
$loginAttemptFailed = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordMD5 = md5($password);

    $hostname = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['PHP_SELF']);

    $db = mysql_connect('localhost:3306', 'root');
    if (!$db) {
        die('DB connection error: ' . mysql_error());
    }
    mysql_select_db('hackers_heaven', $db) or die('Could not select database.');

    $sql = "SELECT (COUNT(id) > 0) as authorized FROM users WHERE username = '$username' AND password_md5 = '$passwordMD5'";
    $result = mysql_query($sql);

    echo "<!-- $sql -->";

    $row = mysql_fetch_assoc($result);

    mysql_free_result($result);
    mysql_close($db);

    if ($row['authorized']) {
        $_SESSION['authorized'] = true;
        header('Location: http://' . $hostname . ($path == '/' ? '' : $path) . '/index.php');
        exit;
    } else {
        $loginAttemptFailed = true;
    }
}

require('libs/smarty/Smarty.class.php');

$smarty = new Smarty;
$smarty->setCompileDir('../tmp/templates_c');
$smarty->assign('username', $username);
$smarty->assign('loginErrorMessage', ($loginAttemptFailed === true) ? "Failed to login user '$username'." : '');
$smarty->display('login.tpl');

?>
