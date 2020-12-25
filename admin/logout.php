<?php
session_start();
require_once('includes/config.php'); 
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 60*60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
$ret="truncate table overdue";
$query= $dbh -> prepare($ret);
$query-> execute();
unset($_SESSION['login']);
session_destroy(); // destroy session
header("location:../adminlogin.php"); 
?>

