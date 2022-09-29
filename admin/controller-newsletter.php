<?php
#se è presente delete_id provvede ad eliminare l'utente della newsletter
if (isset($_GET['delete_id'])) {
    adminOnly();
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM newsletter_table WHERE id = " . "\"$id\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("location: newsletter-index.php");
            exit(0);
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
}