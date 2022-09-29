<?php
include('db.php');
$errors = array();
if (isset($_POST['login'])) { #click sul bottone di login
    #presa dei dati fal form della pagine
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password_raw = mysqli_real_escape_string($conn, $_POST['password']);
    #interrogazione del database per ottenere tutto sull'utente
    $sql = "SELECT * FROM admin_table WHERE username = " . "\"$username\"";
    $result = mysqli_query($conn, $sql);
    if ($result) { #controllo se l'interrogazione è avvenuta con successo
        if (mysqli_num_rows($result) > 0) { #se è presente l'utente inserito
            #presa dei valori dalle colonne
            $fetch = mysqli_fetch_assoc($result);
            $fetch_pass = $fetch['password'];
            $admin_type = $fetch['admin_type'];
            $status = $fetch['status'];
            $password_crypt = md5($password_raw);
            if ($password_crypt == $fetch_pass) { #se la password combacia con quella nel DB cripatata
                if ($status) { #se l'account risulta attivato
                    if ($admin_type == 1) { #se l'account è autorizzato
                        if ($result) {
                            #salvataggio nelle variabili di sessione
                            $_SESSION['id_admin'] = $fetch['id'];
                            $_SESSION['username_admin'] = $username;
                            $_SESSION['admin_type_admin'] = $admin_type;
                            $_SESSION['password_admin'] = $password;
                            if (!empty($_POST["remember_me"])) {
                                #salvataggio nei cookie
                                setcookie("username_admin", $_SESSION['username_admin'], time() + 3600);
                                setcookie("password_admin", $_SESSION['password_admin'], time() + 3600);
                                setcookie("id_admin", $_SESSION['id_admin'], time() + 3600);
                                setcookie("admin_type_admin", $_SESSION['admin_type_admin'], time() + 3600);
                            } else {
                                setcookie("username_admin", "");
                                setcookie("password_admin", "");
                                setcookie("id_admin", "");
                                setcookie("admin_type_admin", "");
                            }
                            header('location: index.php');
                            exit(0);
                        } else {
                            $errors['database'] = "Errore del database!";
                        }
                    } else {
                        $errors['username-password'] = "Username o password errati!";
                    }
                } else {
                    $errors['username-password'] = "Username o password errati!";
                }
            } else {
                $errors['username-password'] = "Username o password errati!";
            }
        } else {
            $errors['username-password'] = "Username o password errati!";
        }
    } else {
        $errors['database'] = "Errore del database!";
    }
}
