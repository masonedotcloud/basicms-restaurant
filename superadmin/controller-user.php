<?php
require_once 'db.php';
require_once 'middleware.php';
$errors = array();
#validazione dell'inserimento di nuovi utenti
function validateUser($post)
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
    #se la password è mancante
    if (empty($post['password'])) {
        array_push($errors, 'Password necessaria');
    }
    #per controllare se è presente gia un utente con quel nome
    $username = $post['username'];
    $sql = "SELECT * FROM admin_table WHERE username = " . "\"$username\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, 'Username già esistente',);
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
    return $errors;
}
#validazione dell'aggionamento del profilo di altri
function validateUser_update($post)
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
    return $errors;
}
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
#se è presente l'id come passaggio di parametri prendi i dati dell'utente riferente a quell'id
if (isset($_GET['id'])) {
    superadminOnly();
    $id = $_GET['id'];
    $sql = "SELECT * FROM admin_table WHERE id = " . "\"$id\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $fetch = mysqli_fetch_assoc($result);
            #variabili che poi vengono utilizzate per le stampe a video dei valori attuali della persona
            $username = $fetch['username'];
            $password = $fetch['password'];
            $status = $fetch['status'];
            $admin_type = $fetch['admin_type'];
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
}
#se è presente delete_id provvede ad eliminare quell'utente
if (isset($_GET['delete_id'])) {
    superadminOnly();
    $id = $_GET['delete_id'];
    if ($_SESSION['id_superadmin'] != $id) {
        $sql = "DELETE FROM `admin_table` WHERE id = " . "\"$id\"";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            array_push($errors, 'Errore con il collegamento nel Database',);
        }
    }
    header("location: user-index.php");
    exit(0);
}
#se è presente status_id è stata richiesta l'attivazione o la disattivazione di un utente
if (isset($_GET['status_id'])) {
    superadminOnly();
    $id = $_GET['status_id'];
    $sql = "SELECT * FROM admin_table WHERE id = " . "\"$id\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $fetch = mysqli_fetch_assoc($result);
        $status = $fetch['status'];
        $status = ($status) ? 0 : 1;
        $sql = "UPDATE admin_table SET status =". "\"$status\"". " WHERE id = " . "\"$id\"";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: user-index.php");
            exit(0);
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
}
#se viene richiesto di aggiungere un utente si entra nella condizione
if (isset($_POST['add-user'])) {
    superadminOnly();
    $errors = validateUser($_POST);
    #variabili prese dal form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $admin_type = $_POST['admin_type'];
    if (count($errors) == 0) {
        $password = md5($password); #crypt della password
        $sql = "INSERT INTO admin_table (username, password, status, admin_type) VALUES (" . "\"$username\"" . "," . "\"$password\"" . "," . "\"0\"" . "," . "\"$admin_type\"" . ")";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: user-index.php");
            exit(0);
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    }
}
#se viene richiesto di aggiornare i dati di un utente
if (isset($_POST['update-user'])) {
    superadminOnly();
    $errors = validateUser_update($_POST);
    #variabili prese dal form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $id = $_POST['id'];
    $admin_type = $_POST['admin_type'];
    if (count($errors) == 0) {
        if (empty($password)) { #se la password non la si vuole aggiornare
            $sql = "UPDATE admin_table SET username= " . "\"$username\"" . ", admin_type=" ."\"$admin_type\"" . "WHERE id=" . "\"$id\"";
        } else {
            $password = md5($password); #crypt della password
            $sql = "UPDATE admin_table SET username="."\"$username\"" . ",password=" . "\"$password\"" . ",admin_type=" . "\"$admin_type\"" . " WHERE id=" . "\"$id\"";
        }
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: user-index.php");
            exit(0);
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    }
}
#se viene richiesto di modificare il proprio profilo
if (isset($_POST['update-profile'])) {
    superadminOnly();
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
                $_SESSION['username_superadmin'] = $username;
                if (!empty($_COOKIE['username_superadmin'])) {
                    setcookie("password_superadmin", $_SESSION['password_superadmin'], time() + 3600);
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
                        $_SESSION['username_superadmin'] = $username;
                        $_SESSION['password_superadmin'] = $password;
                        if (!empty($_COOKIE['username_superadmin']) && !empty($_COOKIE['password_superadmin'])) {
                            setcookie("username_superadmin", $_SESSION['username_admin'], time() + 3600);
                            setcookie("password_superadmin", $_SESSION['password_admin'], time() + 3600);
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
