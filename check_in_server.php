<?php
    //codice per operazione di check-in

    include 'dbconfig.php';

    header('Content-Type: application/json');

    if (!empty($_GET["codiceFiscale"]) && !empty($_GET["flightID"])){
        //Se CodiceFiscale e flightID sono stati inviati, eseguo connessione al DB
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        //Preparazione 
        $codiceFiscale = mysqli_real_escape_string($conn, $_GET['codiceFiscale']);
        $flightID = mysqli_real_escape_string($conn, $_GET['flightID']);
        //Seleziono username per sessione, password per controllo
        $query = "SELECT ticketID FROM checkin WHERE codiceFiscale = '$codiceFiscale' AND flightID = '$flightID'";
        //Esecuzione della query
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0) {
            // Ritorna una sola riga...
            $data = mysqli_fetch_assoc($res);
            if ($data['ticketID'] !== NULL) { /* il check-in era già stato effettuato dall'utente
                                                 ed era già stato generato un ticketID */
                //output
                
                    $arr = array('existed' => true,
                                'ticketID' => $data['ticketID']);
                    echo json_encode($arr); 

                
            }
            else { /* il check-in non era ancora stato effettuato dall'utente e
                      non era ancora stato generato un ticketID */

                do{
                    $newTicketID = rand(100, 999) . rand(100, 999) . rand(10, 99); //genero un nuovo ticketID
    
                    $query = "SELECT ticketID FROM checkin WHERE ticketID = '$newTicketID'";
                    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
                } while (mysqli_num_rows($res) > 0);

                $query = "UPDATE checkin SET ticketID = $newTicketID WHERE codiceFiscale = '$codiceFiscale' AND flightID = '$flightID'";
                
                //output
                $arr = array('exists' => false,
                             'ticketID' => $newTicketID);
                echo json_encode($arr); 
                
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
        }
    }
    else {
        // Manca o Codice Fiscale e/o flightID...
        $error = "Devi inserire sia il Codice Fiscale sia il flightID.";
        header("Location: check_in.php");
    }
?>