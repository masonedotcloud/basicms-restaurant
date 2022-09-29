<?php
require_once 'db.php';
require_once 'middleware.php';
$errors = array();
#validazione dell'inserimento di nuovi cibi
function validateFood($post)
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
    #se la categoria è mancante
    if (empty($post['category'])) {
        array_push($errors, 'Categoria mancante');
    }
    #se la categoria è troppo lunga
    if (strlen($post['category']) > 255) {
        array_push($errors, 'Categoria troppo lunga');
    }
    #se il prezzo è mancante
    if (empty($post['price'])) {
        array_push($errors, 'Prezzo mancante');
    }
    #per controllare se è già presente un cibo con il nomne inserito
    $search = $post['name'];
    $sql = "SELECT * FROM food_table WHERE name = " . "\"$search\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, 'Cibo già presente',);
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
    return $errors;
}
function validateFood_update($post)
{
    include("connect.php");
    $errors = array();
    #se il nome è mancante
    if (empty($post['name'])) {
        array_push($errors, 'Nome mancante');
    }
    #se il nome è troppo lungo
    if (strlen($post['name']) > 255) {
        array_push($errors, 'Email troppo lunga');
    }
    #se la categoria è mancante
    if (empty($post['category'])) {
        array_push($errors, 'Categoria mancante');
    }
    #se la categoria è troppo lunga
    if (strlen($post['categopry']) > 255) {
        array_push($errors, 'Categoria troppo lunga');
    }
    #se il prezzo è mancante
    if (empty($post['price'])) {
        array_push($errors, 'Prezzo mancante');
    }
    #per controllare se è già presente un cibo con il nomne inserito
    $search = $post['name'];
    $sql = "SELECT * FROM food_table WHERE name = " . "\"$search\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 1) {
            array_push($errors, 'Cibo già presente',);
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
    return $errors;
}
#se è presente l'id come passaggio di parametri prendi i dati delcibo riferente a quell'id
if (isset($_GET['id'])) {
    adminOnly();
    $id = $_GET['id'];
    $sql = "SELECT * FROM food_table WHERE id = " . "\"$id\"";
    $result = mysqli_query($conn, $sql);
    #controlli degli errori
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $fetch = mysqli_fetch_assoc($result);
            if (!isset($fetch['id'])) {
                array_push($errors, 'Errore con il collegamento nel Database');
            } else {
                $id = $fetch['id'];
            }
            if (!isset($fetch['name'])) {
                array_push($errors, 'Errore con il collegamento nel Database');
            } else {
                $name = $fetch['name'];
            }
            if (!isset($fetch['category'])) {
                array_push($errors, 'Errore con il collegamento nel Database');
            } else {
                $category = $fetch['category'];
            }
            if (!isset($fetch['price'])) {
                array_push($errors, 'Errore con il collegamento nel Database');
            } else {
                $price = $fetch['price'];
            }
            if (!isset($fetch['description'])) {
                array_push($errors, 'Errore con il collegamento nel Database');
            } else {
                $description = $fetch['description'];
            }
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
}
#se è presente delete_id provvede ad eliminare quel cibo
if (isset($_GET['delete_id'])) {
    adminOnly();
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM food_table WHERE id = " . "\"$id\"";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $sql = "SELECT * FROM food_table WHERE id = " . "\"$id\"";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $image_old = mysqli_fetch_assoc($result);
            unlink("assets/images/food/cover/" . $image_old['image']);
            header("location: food-index.php");
            exit(0);
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
}
#se è presente status_id è stata richiesta l'attivazione o la disattivazione di un cibo
if (isset($_GET['status_id'])) {
    adminOnly();
    $id = $_GET['status_id'];
    $check_status = "SELECT * FROM food_table WHERE id = " . "\"$id\"";
    $result = mysqli_query($conn, $check_status);
    if ($result) {
        $fetch = mysqli_fetch_assoc($result);
        $status = $fetch['status'] ? 0 : 1;
        $sql = "UPDATE food_table SET status= " . "\"$status\"" . " WHERE id= " . "\"$id\"";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: food-index.php");
            exit(0);
        } else {
            array_push($errors, 'Errore con il collegamento nel Database');
        }
    } else {
        array_push($errors, 'Errore con il collegamento nel Database');
    }
}
#se viene richiesto di aggiungere del cibo si entra nella condizione
if (isset($_POST['add-food'])) {
    adminOnly();
    $errors = validateFood($_POST);
    if (count($errors) == 0) {
        if (!empty($_FILES['image']['name'])) {
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $allowed_image_extension = array(
                "png",
                "jpg",
                "jpeg"
            );
            if (!in_array($file_extension, $allowed_image_extension)) {
                array_push($errors, "Estensione non supportata");
            } else {
                $image = time() . '_' . $_FILES['image']['name'];
                $destination = "assets/images/food/cover/" . $image;
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                if ($result) {
                    $_POST['image'] = $image;
                } else {
                    array_push($errors, "Errore nel caricamento dell'immagine");
                }
                $name = trim($_POST['name']);
                $status = isset($_POST['status']) ? 1 : 0;
                $description = trim($_POST['description']);
                $price = $_POST['price'];
                $category = $_POST['category'];
                $image = str_replace(' ', '', $_POST['image']);
                $sql = "INSERT INTO food_table(name, status, category, price, description, image) VALUES (" . "\"$name\"" . " , " . "\"$status\"" . ", " . "\"$category\"" . ", " . "\"$price\"" . ", " . "\"$description\"" . ", " . "\"$image\"" . ")";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header("location: food-index.php");
                    exit(0);
                } else {
                    array_push($errors, 'Errore con il collegamento nel Database');
                }
            }
        } else {
            array_push($errors, "Immagine mancante");
        }
    }
}
#se viene richiesto di aggiornare i dati di un cibo
if (isset($_POST['edit-food'])) {
    adminOnly();
    $errors = validateFood_update($_POST);
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = trim($_POST['description']);
    if (count($errors) == 0) {
        if (!empty($_FILES['image']['name'])) { #se il file è presente
            #controllo dell'estensione
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $allowed_image_extension = array(
                "png",
                "jpg",
                "jpeg"
            );
            if (!in_array($file_extension, $allowed_image_extension)) {
                array_push($errors, "Estensione non supportata");
            } else {
                #upload immagine e caricamento nel DB
                $image_name = time() . '_' . $_FILES['image']['name'];
                $destination = "assets/images/food/cover/" . $image_name;
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                if ($result) {
                    $sql = "SELECT * FROM food_table WHERE id = " . "\"$id\"";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $image_old = mysqli_fetch_assoc($result);
                        $result = unlink("assets/images/food/cover/" . $image_old['image']);
                        if ($result) {
                            $sql = "UPDATE food_table SET image=" . "\"$image_name\"" . " WHERE id = " . "\"$id\"";
                            $result = mysqli_query($conn, $sql);
                            if (!$result) {
                                array_push($errors, 'Errore con il collegamento nel Database');
                            } else {
                                $id = $_POST['id'];
                                $name = $_POST['name'];
                                $status = isset($_POST['status']) ? 1 : 0;
                                $description = $_POST['description'];
                                $price = $_POST['price'];
                                $category = $_POST['category'];
                                $sql = "UPDATE food_table SET name=" . "\"$name\"" . ", category=" . "\"$category\"" . ", price=" . "\"$price\"" . ", description=" . "\"$description\"" . " WHERE id = " . "\"$id\"";
                                $result = mysqli_query($conn, $sql);
                                if ($result) {
                                    header("location: food-index.php");
                                    exit(0);
                                } else {
                                    array_push($errors, 'Errore con il collegamento nel Database');
                                }
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
    }
}
