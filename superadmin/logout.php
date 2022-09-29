<?php
session_start();
$redirect = 'login.php';
setcookie("username_superadmin", "");
setcookie("password_superadmin", "");
setcookie("id_superadmin", "");
setcookie("admin_type_superadmin", "");
unset($_SESSION['username_superadmin']);
unset($_SESSION['password_superadmin']);
unset($_SESSION['id_superadmin']);
unset($_SESSION['admin_type_superadmin']);
header('Location: '. $redirect);
exit(0);
?>