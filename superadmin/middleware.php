<?php
#funzione per il controllo dei permessi per accedere alle pagine
function superadminOnly($redirect = 'login.php') {
    if (!isset($_SESSION['id_superadmin'])) {
        header('Location: '. $redirect);
        exit(0);
    }
    else {
        if ($_SESSION['admin_type_superadmin'] != 0) { #solo i superadmin vi possono accedere
            header('Location: '. $redirect);
            exit(0);
        }
    }
}
?>