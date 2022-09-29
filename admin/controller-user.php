<?php
require_once 'db.php';
require_once 'middleware.php';
$errors = array();
#validazione dell'aggionamento persone del profilo
function validateUser_profile($post)
{
    include 'connect.php';
    $errors = array();
    #se l'username è mancante
    if (empty($post['username'])) {
        array_push($errors, 'Username mancante');
    }
    if (strlen($post['username']) > 255) {
        array_push($errors, 'Username troppo lunga');
    }
    #per controllare se è presente gia un utente con quel nome
    $username = $post['username'];
    $sql = "SELECT * FROM admin_table WHERE username = " . "\"$username\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 1) {
            array_push($errors, 'Username già esistente',);
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
    #controllo della password vecchia
    if (!empty($post['oldpassword'])) {
        $old_password = $post['oldpassword'];
        $id = $post['id'];
        $sql = "SELECT * FROM admin_table WHERE id = " . "\"$id\"";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $value = mysqli_fetch_assoc($result);
            if (isset($value['password'])) {
                if ($value['password'] != md5($old_password)) {
                    array_push($errors, 'Password vecchia sbagliata');
                }
            } else {
                array_push($errors, 'Errore con il collegamento nel Database');
            }
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    }
    return $errors;
}
#se viene richiesto di modificare il proprio profilo
if (isset($_POST['update-profile'])) {
    adminOnly();
    $errors = validateUser_profile($_POST);
    #variaibli prese dal form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $old_password = trim($_POST['oldpassword']);
    $id = $_POST['id'];
    if (count($errors) == 0) {
        if (empty($password)) { #se la password non la si vuole aggiornare
            $sql = "UPDATE admin_table SET username=" . "\"$username\"" . " WHERE id=" . "\"$id\"";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['username_admin'] = $username;
                if (!empty($_COOKIE['username_admin'])) {
                    setcookie("password_admin", $_SESSION['password_admin'], time() + 3600);
                }
                header("location: edit-profile.php");
                exit(0);
            } else {
                array_push($errors, 'Errore con il collegamento nel Database');
            }
        } else {
            #crypt delle diue password e la vecchia messa a paragone con quella nel database prima di cambiarla
            $password = md5($password);
            $old_password = md5($old_password);
            $sql = "SELECT * FROM admin_table WHERE id =" . "\"$id\"";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $old_password_check = mysqli_fetch_assoc($result);
                if ($old_password_check['password'] == $old_password) {
                    $sql = "UPDATE admin_table SET username=" . "\"$username\"" . ",password=" . "\"$password\"" . " WHERE id=" . "\"$id\"";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $_SESSION['username_admin'] = $username;
                        $_SESSION['password_admin'] = $password;
                        if (!empty($_COOKIE['username_admin']) && !empty($_COOKIE['password_admin'])) {
                            setcookie("username_admin", $_SESSION['username_admin'], time() + 3600);
                            setcookie("password_admin", $_SESSION['password_admin'], time() + 3600);
                        }
                        header("location: edit-profile.php");
                        exit(0);
                    } else {
                        array_push($errors, 'Errore con il collegamento nel Database');
                    }
                } else {
                    array_push($errors, 'Password vecchia errata');
                }
            } else {
                array_push($errors, 'Errore con il collegamento nel Database');
            }
        }
    }
}
