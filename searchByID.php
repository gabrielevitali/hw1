<?php
    # Ricerca volo in base al flightID
    # interrogo database sulla base dei dati inseriti dall'utente e restituisco un elenco di voli

    require_once 'dbconfig.php';

    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    header('Content-Type: application/json');

    //Se il flightID è stato inviato, eseguo connessione al DB
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    //Preparazione 
    $flightID = mysqli_real_escape_string($conn, $_GET["q"]);
    $query = "SELECT flightID, aeroportoPartenza, aeroportoArrivo, dataPartenza, oraPartenza, dataArrivo, oraArrivo, stato  FROM voli WHERE flightID = '$flightID'";
    //Esecuzione della query
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($res) > 0) { //Se è stato trovato almeno un volo in base ai parametri di ricerca inseriti...
        //echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));
        $data = mysqli_fetch_assoc($res);
        $arr = array('exists' => true,
                     'flightID' => $data['flightID'], 
                     "aeroportoPartenza" => $data['aeroportoPartenza'],
                     "aeroportoArrivo" => $data['aeroportoArrivo'],
                     "dataPartenza" => $data['dataPartenza'],
                     "oraPartenza" => $data['oraPartenza'],
                     "dataArrivo" => $data['dataArrivo'],
                     "oraArrivo" => $data['oraArrivo'],
                     "stato" => $data['stato']);
        echo json_encode($arr);

        mysqli_free_result($res);
    }
    else {
        // Nessun volo trovato in base ai parametri di ricerca inseriti...
        $error = "Nessun volo trovato in base ai parametri di ricerca inseriti. Riprova con altri parametri.";
        echo json_encode(array('exists' => false));
    }
    mysqli_close($conn);
?>