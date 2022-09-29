<?php
require_once 'db.php';
require_once 'middleware.php';
$errors = array();
#validazione dell'inserimento di nuove categorie
function validateCategory($post)
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
    #per controllare se è presente gia un utente con quel nome
    $search = $post['name'];
    $sql = "SELECT * FROM category_table WHERE name = " . "\"$search\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        #se la categoria gia essite
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, 'Categoria già esistenete');
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
    return $errors;
}
#validazione dell'aggiornamento delle categorie
function validateCategory_update($post)
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
    #per controllare se è presente gia un utente con quel nome
    $search = $post['name'];
    $sql = "SELECT * FROM category_table WHERE name = " . "\"$search\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        #se la categoria gia essite
        if (mysqli_num_rows($result) > 1) {
            array_push($errors, 'Categoria già esistenete');
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
    return $errors;
}
#se è presente l'id come passaggio di parametri prendi i dati della categoria riferente a quell'id
if (isset($_GET['id'])) {
    adminOnly();
    $id = $_GET['id'];
    $sql = "SELECT * FROM category_table WHERE id = " . "\"$id\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $fetch = mysqli_fetch_assoc($result);
            #variabili che poi vengono utilizzate per le stampe a video dei valori attuali della categoria
            $id = $fetch['id'];
            $name = $fetch['name'];
            $status = $fetch['status'];
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
}
#se è presente delete_id provvede ad eliminare quella categoria
if (isset($_GET['delete_id'])) {
    adminOnly();
    $id = $_GET['delete_id'];
    $sql = "SELECT * FROM food_table WHERE category = " . "\"$id\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $result2 = unlink("assets/images/food/cover/" . $row['image']);
            }
        }
        $sql = "DELETE FROM food_table WHERE category = " . "\"$id\"";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $sql = "DELETE FROM category_table WHERE id = " . "\"$id\"";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("location: category-index.php");
                exit();
            } else {
                array_push($errors, 'Errore con il collegamento nel Database');
            }
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
}
#se è presente status_id è stata richiesta l'attivazione o la disattivazione di una categoria
if (isset($_GET['status_id'])) {
    adminOnly();
    $id = $_GET['status_id'];
    $sql = "SELECT * FROM category_table WHERE id = " . "\"$id\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $fetch = mysqli_fetch_assoc($result);
        if (isset($fetch['status'])) {
            $status = $fetch['status'] ? 0 : 1;
            $sql = "UPDATE category_table SET status = " . "\"$status\"" . " WHERE id= " . "\"$id\"";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("location: category-index.php");
                exit();
            } else {
                array_push($errors, 'Errore con il collegamento nel Database');
            }
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
}
#se viene richiesto di aggiungere una categoria si entra nella condizione
if (isset($_POST['add-category'])) {
    adminOnly();
    $errors = validateCategory($_POST);
    if (count($errors) == 0) {
        $name = trim($_POST['name']);
        $status = isset($_POST['status']) ? 1 : 0;
        $sql = "INSERT INTO category_table (name, status) VALUES (" . "\"$name\"" . ", " . "\"$status\"" . ")";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: category-index.php");
            exit(0);
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    }
}
#se viene richiesto di aggiornare i dati di una categoria
if (isset($_POST['update-category'])) {
    adminOnly();
    $errors = validateCategory_update($_POST);
    if (count($errors) == 0) {
        $id = $_POST['id'];
        $name = trim($_POST['name']);
        $status = isset($_POST['status']) ? 1 : 0;
        $sql = "UPDATE category_table SET name =" . "\"$name\"" . ", status" . "=\"$status\"" . " WHERE  id = " . "\"$id\"";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: category-index.php");
            exit(0);
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    }
}
