<?php
    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }   

    // Verifica l'esistenza di dati POST
    if (!empty($_POST["signupUsername"]) && !empty($_POST["email"]) && !empty($_POST["signupPassword"]) &&
        !empty($_POST["confirmPassword"])){
            $error = array();
            $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

            # USERNAME
            // Controlla che l'username rispetti il pattern specificato
            if(!preg_match('/^[a-zA-Z0-9_]{5,15}$/', $_POST['signupUsername'])) {
                $error[] = "Username non valido";
            } else {
                $username = mysqli_real_escape_string($conn, $_POST['signupUsername']);
                // Cerco se l'username esiste già o se appartiene a una delle 3 parole chiave indicate
                $query = "SELECT username FROM utente WHERE username = '$username'";
                $res = mysqli_query($conn, $query);
                if (mysqli_num_rows($res) > 0) {
                    $error[] = "Username già utilizzato";
                }
            }
            # PASSWORD
            if (strlen($_POST["signupPassword"]) < 5) {
                $error[] = "Caratteri password insufficienti";
            } 
            # CONFERMA PASSWORD
            if (strcmp($_POST["signupPassword"], $_POST["confirmPassword"]) != 0) {
                $error[] = "Le password non coincidono";
            }
            # EMAIL
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
                
            # REGISTRAZIONE NEL DATABASE
            if (count($error) == 0) {
                $username = mysqli_real_escape_string($conn, $_POST['signupUsername']);
                $password = mysqli_real_escape_string($conn, $_POST['signupPassword']);

                //$password = base64_encode(hash('sha256', $password)); //modalità alternativa per criptare la password dell'utente
                //memorizzazione in db della password criptata con password_hash
                $password = password_hash($password, PASSWORD_BCRYPT);
                $query = "INSERT INTO utente(username, pwd, email) VALUES('$username', '$password', '$email')";
                
                if (mysqli_query($conn, $query)) {
                    $_SESSION["_infinity_airways_username"] = $_POST["signupUsername"];
                    mysqli_close($conn);
                    //$message = "Benvenuto $username! E' stata inviata una mail di conferma all'indirizzo email" . $_POST['email'];
                    header("Location: reservedArea.php");
                    exit;
                } else {
                    $error[] = "Errore di connessione al Database";
                }
            }
            mysqli_close($conn);
    }
    else {
        $error = array("Riempi tutti i campi");
    }
?>