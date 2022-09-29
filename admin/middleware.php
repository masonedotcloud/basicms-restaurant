<?php
#funzione per il controllo dei permessi per accedere alle pagine
function adminOnly($redirect = 'login.php') {
    if (!isset($_SESSION['id_admin'])) {
        header('Location: '. $redirect);
        exit(0);
    }
    else {
        if ($_SESSION['admin_type_admin'] != 1) { #solo i superadmin vi possono accedere
            header('Location: '. $redirect);
            exit(0);
        }
    }
}
?>