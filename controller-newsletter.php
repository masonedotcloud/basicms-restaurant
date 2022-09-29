<?php
$errors = array();
$success = array();
function validateNewsletter($post)
{
    include 'connect.php';
    $errors = array();
    #se l'email non è presente
    if (empty($post['email'])) {
        array_push($errors, 'Email mancante');
    }
    #se l'email è troppo lunga
    if (strlen($post['email']) > 255) {
        array_push($errors, 'Email troppo lunga');
    }
    #ricerca per verificare se l'email è gia presente, se è presente la elimina
    $search = $post['email'];
    $sql = "SELECT * FROM newsletter_table WHERE email = " . "\"$search\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $sql = "DELETE FROM newsletter_table WHERE email = " . "\"$search\"";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                array_push($errors, 'Errore con il collegamento nel Database');
            }
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
    return $errors;
}
#se viene richesta l'aggiunta alla newsletter
if (isset($_POST['add-newsletter'])) {
    $errors = validateNewsletter($_POST); #validazione senza errori
    if (count($errors) == 0) { #se non sono presenti errori
        $email = trim($_POST['email']); #rimuove gli spazi prima e dopo
        $sql = "INSERT INTO newsletter_table (email) VALUES (" . "\"$email\""  . ")";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            array_push($success, 'Sottoscrizione avvenuta con successo');
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    }
}
#se è riechiesta l'eliminazione della newsletter dal punti di vista pubblico attraverso il passaggio di parametri
#sarebbe da implementare in un link che arriva all'email del soggetto
if (isset($_GET['delete_id']) && isset($_GET['email'])) {
    $id = $_GET['delete_id'];
    $email = $_GET['email'];
    $sql = "DELETE FROM newsletter_table WHERE id = " . "\"$id\"" . " AND email = " . "\"$email\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Disiscrizione avvenuta con successo";
        exit(0);
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
}
