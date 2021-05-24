<?php 
    /*******************************************************
        Controlla che l'username sia unico
    ********************************************************/
    require_once 'dbconfig.php';

    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    header('Content-Type: application/json');
    
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $username = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT username FROM utente
                WHERE username = '$username'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($res) > 0){
        echo json_encode(array('exists' => true));
    }
    
    mysqli_free_result($res);
    mysqli_close($conn);
?>