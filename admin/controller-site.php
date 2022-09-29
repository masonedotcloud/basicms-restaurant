<?php
require_once 'db.php';
require_once 'middleware.php';
$errors = array();
function validateSite($post)
{
    include("connect.php");
    $errors = array();
    #se il nome è mancante
    if (empty($post['name'])) {
        array_push($errors, 'Nome mancante');
    }
    #se il nome è troppo lungo
    if (strlen($post['name']) > 255) {
        array_push($errors, 'Nome troppo lunga');
    }
    #se l'email è mancante
    if (empty($post['email'])) {
        array_push($errors, 'Email mancante');
    }
    #se lìemail è troppo lunga
    if (strlen($post['email']) > 255) {
        array_push($errors, 'Email troppo lunga');
    }
    #se la descrizione è mancante
    if (empty($post['description'])) {
        array_push($errors, 'Descrizione mancante');
    }
    return $errors;
}
#se viene richiesto di aggiornare i dati del sito
if (isset($_POST['update-site'])) {
    adminOnly();
    $errors = validateSite($_POST);
    if (count($errors) == 0) {
        #presa dei dati dal form
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $description = trim($_POST['description']);
        if (!empty($_FILES['image']['name'])) { #se è presente l'mmagine
            #verifca delle estensioni
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $allowed_image_extension = array(
                "png",
                "jpg",
                "jpeg",
                "svg",
                "icon"
            );
            if (!in_array($file_extension, $allowed_image_extension)) {
                array_push($errors, "Estensione non supportata"); #messaggio di errore
            } else {
                #se è valida upload e inserimento nel DB
                $path = $_FILES['image']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $image_name = "icon." . $ext;
                $destination = "../admin/assets/images/site/" . $image_name;
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                if ($result) {
                    $sql = "SELECT * FROM setting_table LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $image_old = mysqli_fetch_assoc($result);
                        $result = unlink("../admin/assets/images/site/" . $image_old['image']);                  
                        if ($result) {
                            $sql = "UPDATE setting_table SET image=" . "\"$image_name\"" . " WHERE 1";
                            $result = mysqli_query($conn, $sql);
                            if (!$result) {
                                array_push($errors, 'Errore con il collegamento nel Database');
                            }
                        } else {
                            array_push($errors, 'Errore nell\'eliminazione dell\'immagine precedente');
                        }
                    } else {
                        array_push($errors, 'Errore con il collegamento nel Database');
                    }
                } else {
                    array_push($errors, 'Errore nel caricamento dell\'immagine');
                }
            }
        }
        $sql = "UPDATE setting_table SET name =" . "\"$name\"" . ", email" . "=\"$email\"" . ", description" . "=\"$description\"" . " WHERE 1";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: site-edit.php");
            exit(0);
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    }
}
