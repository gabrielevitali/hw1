<?php 
    /************************************************************************************************************************************
        Mediante il codice IATA ricevuto recupero tramite query a DB le informazioni (città, denominazione) sull'aeroporto corrispondente 
    ************************************************************************************************************************************/
    require_once 'dbconfig.php';

    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    header('Content-Type: application/json');
    
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $airportIATA = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT città, denominazione FROM aeroporto WHERE airportID = '$airportIATA'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($res) > 0) { //Se è stato trovato l'aeroporto cercato in base al codice IATA passato...
        $data = mysqli_fetch_assoc($res);
        $arr = array('exists' => true,
                     'città' => $data['città'], 
                     "denominazione" => $data['denominazione']);
        echo json_encode($arr); 
    }
    else {
        // Nessun aeroporto avente il codice IATA passato è stato trovato...
        $error = "Nessun volo trovato in base ai parametri di ricerca inseriti. Riprova con altri parametri.";
        echo json_encode(array('exists' => false));
    }
    mysqli_close($conn);
?>