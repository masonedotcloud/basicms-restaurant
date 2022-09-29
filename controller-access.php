<?php
#funzione che restituisce l'indirizzo IP da cui si effettua la visualizzazione del sito
function get_client_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$ip = get_client_ip();
#inserimento nel DB degli accessi attraverso un controllo, se non è presente un accesso da quell'indirizzo nella giornata attuale viene aggiunto 
#non si gestiscono gli errori perchè non è fondamentale per il funzionamento del sito
$temp_date = date("Y-n-j");
$sql_ip = "SELECT * FROM access_table WHERE ip = " . "\"$ip\"" . "AND date = " . "\"$temp_date\"" . "ORDER BY ID DESC";
$result_ip = mysqli_query($conn, $sql_ip);
if ($result_ip) {
    if (mysqli_num_rows($result_ip) == 0) { #se non è presente
        $date = date("Y-m-d");
        $sql_ip = "INSERT INTO access_table(ip, date) VALUES (" . "\"$ip\"" . ", " . "\"$date\"" . ")";
        $result_ip = mysqli_query($conn, $sql_ip);
    } else if (mysqli_num_rows($result_ip) > 0) { #se è presente all'interno della tabella si verifca se la data è diversa dal giorno di oggi, se è diversa si aggiunge alla tabella
        $fetch_ip = mysqli_fetch_assoc($result_ip);
        if ($fetch_ip['date'] != date("Y-m-d")) {
            $date = date("Y-m-d");
            $sql_ip = "INSERT INTO access_table(ip, date) VALUES (" . "\"$ip\"" . ", " . "\"$date\"" . ")";
            $result_ip = mysqli_query($conn, $sql_ip);
        }
    }
}
#NOTA: la data viene inserita manualmente perchè il DB di altervista non supportava quel formato data in automatico