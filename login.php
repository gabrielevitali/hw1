<?php
    # codice per operazione di login

    // Verifica che l'utente sia già loggato, in caso positivo va direttamente alla home
    include 'auth.php';
    if (checkAuth()) {
        header("Location: reservedArea.php");
        exit;
    }

    if (!empty($_POST["loginUsername"]) && !empty($_POST["loginPassword"]) )
    {
        # Se username e password sono stati inviati, eseguo connessione al DB
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        # Preparazione 
        $username = mysqli_real_escape_string($conn, $_POST['loginUsername']);
        $password = mysqli_real_escape_string($conn, $_POST['loginPassword']);
        # Seleziono username per sessione, password per controllo
        $query = "SELECT username, pwd FROM utente WHERE username = '$username'";
        # Esecuzione della query
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0) {
            // Ritorna una sola riga, il che ci basta perché l'utente autenticato è solo uno
            $entry = mysqli_fetch_assoc($res);
            
            //if(base64_encode(hash('sha256', $_POST["loginPassword"])) == $data['pwd']){ //modalità alternativa usando hash() e base64_encode
            if (password_verify($_POST['loginPassword'], $entry['pwd'])) {
                // Imposto una sessione dell'utente
                $_SESSION["_infinity_airways_username"] = $entry['username'];
                header('Location: reservedArea.php');
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
            else {
                $error = "Password errata.";
                echo "<p> $error </p>";
            }
        }
        // Se l'utente non è stato trovato o la password non ha passato la verifica
        $error = "Username e/o password errati.";
        echo "<p> $error </p>";
    }
    else { // Se solo uno dei due è impostato
        $error = "Inserisci username e password.";
    }
?>