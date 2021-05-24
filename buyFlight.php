<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login_signup.php");
        exit;
    }
    $username = $_SESSION["_infinity_airways_username"];
?>

<?php
    //codice per operazione di check-in

    include 'dbconfig.php';

    header('Content-Type: application/json');

    if (!empty($_GET["codiceFiscale"]) && !empty($_GET["nome"]) && !empty($_GET["cognome"]) && !empty($_GET["nazione"])
        && !empty($_GET["dataNascita"]) && !empty($_GET["via"]) && !empty($_GET["numero"]) && !empty($_GET["CAP"])
        && !empty($_GET["documento"]) && !empty($_GET["telefono"])){
        //Se tutti i dati del form sono stati inviati, eseguo connessione al DB
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        //Preparazione 
        $codiceFiscale = mysqli_real_escape_string($conn, $_GET['codiceFiscale']);
        $nome = mysqli_real_escape_string($conn, $_GET['nome']);
        $cognome = mysqli_real_escape_string($conn, $_GET['cognome']);
        $nazione = mysqli_real_escape_string($conn, $_GET['nazione']);
        $dataNascita = mysqli_real_escape_string($conn, $_GET['dataNascita']);
        $via = mysqli_real_escape_string($conn, $_GET['via']);
        $numero = mysqli_real_escape_string($conn, $_GET['numero']);
        $CAP = mysqli_real_escape_string($conn, $_GET['CAP']);
        $documento = mysqli_real_escape_string($conn, $_GET['documento']);
        $telefono = mysqli_real_escape_string($conn, $_GET['telefono']);

        $query = "UPDATE passeggero SET codiceFiscale = $codiceFiscale, nome = $nome, cognome = $cognome,
                  nazione = $nazione, $dataNascita = $dataNascita, $via = via, $numero = numero, $CAP = CAP,
                  documento = $documento, telefono = $telefono";
        
        //eseguo query e verifico esito
        if (mysqli_query($conn, $query)) {
            //header("Location: check_in.php");
            mysqli_free_result($res);
            mysqli_close($conn);
            exit;
        } else {
            $error[] = "Errore di connessione al Database";
        }
    }
    else {
        // Mancano alcuni dati del form...
        $error = "Mancano dei dati.";
        header("Location: acquista.php");
    }
?>