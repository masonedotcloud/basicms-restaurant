<?php
session_start();
$redirect = 'login.php';
setcookie("username_admin", "");
setcookie("password_admin", "");
setcookie("id_admin", "");
setcookie("admin_type_admin", "");
unset($_SESSION['username_admin']);
unset($_SESSION['password_admin']);
unset($_SESSION['id_admin']);
unset($_SESSION['admin_type_admin']);
header('Location: '. $redirect);
exit(0);
?>