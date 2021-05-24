<?php
    # Ricerca volo in base ad aeroporto di partenza, aeroporto di arrivo
    # interrogo database sulla base dei dati inseriti dall'utente e restituisco un elenco di voli

    require_once 'dbconfig.php';
    
    if (!empty($_POST["departureAirport"]) && !empty($_POST["date"])){
        echo "Non dovresti essere qui";
        exit;
    }

    header('Content-Type: application/json');
    
    //Se l'aeroporto di partenza, l'aeroporto di arrivo e la data sono stati inviati, eseguo connessione al DB
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    //Preparazione 
    $departureAirport = mysqli_real_escape_string($conn, $_GET["departureAirport"]);
    $date = mysqli_real_escape_string($conn, $_GET["date"]);
    $query = "SELECT flightID, aeroportoPartenza, aeroportoArrivo, dataPartenza, oraPartenza, dataArrivo, oraArrivo, stato  FROM voli WHERE aeroportoPartenza = '$departureAirport' AND dataPartenza = '$date'";
    //Esecuzione della query
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($res) > 0) { //Se è stato trovato almeno un volo in base ai parametri di ricerca inseriti...
        //echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));
        $i = 1;
        $arr = array();
        while($data = mysqli_fetch_assoc($res)){
            $arr[0] = true;
            $arr[$i] = $data;
            $i++;
        }
        echo json_encode($arr); 

        mysqli_free_result($res);
    }
    else {
        // Nessun volo trovato in base ai parametri di ricerca inseriti...
        $error = "Nessun volo trovato in base ai parametri di ricerca inseriti. Riprova con altri parametri.";
    }
    mysqli_close($conn);
?>