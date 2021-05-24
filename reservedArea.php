<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login_signup.php");
        exit;
    }

    $username = $_SESSION["_infinity_airways_username"];
    echo "<p color='blue'> Benvenuto $username </p>";
?>

<html>
    <head>
        <meta charset="utf-8">
        <title> Infinity Airways </title>
        <link rel="stylesheet" href="style/homepage.css" />
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet"> <!-- importo il font Raleway da Google Fonts -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>
        <header>
            <nav>
                <a href="chiSiamo.html"> Chi Siamo </a>
                <a href="destinazioni.html"> Destinazioni </a>
                <a href="infoVoli.html"> Info Voli </a>
                <a href="acquista.html"> Acquista </a>
                <a href="logout.php" class="button"> Logout </a>
            </nav>
            <a href="homepage.html" id="title"> <h1> INFINITY AIRWAYS </h1> </a>
            <div class="overlay"> </div>   
        </header>





        <!-- Apertura footer -->
        <footer>
            <div class="footerContent">
                <!-- Chi siamo? -->
                <div class="footerItem">
                    <p> Chi Siamo </p>
                    <a href="storia.html"> La nostra Storia </a>
                    <a href="mission.html"> La nostra Mission </a>
                    <a href="flotta.html"> La nostra Flotta </a>
                    <a href="recensioni.html"> Dicono di Noi </a>
                </div>
                <!-- Dove voliamo? -->
                <div class="footerItem">
                    <p> Dove voliamo? </p>
                    <a href="destinazioni.html"> Destinazioni </a>
                    <a href="infoVoli.html"> Info Voli </a>
                    <a href="promozioni.html"> Promozioni </a>
                    <a href="proposteViaggio.html"> Proposte di Viaggio </a>
                </div>
                <!-- Privilege Club -->
                <div class="footerItem">
                    <p> Privilege Club </p>
                    <a href="clubServizi.html"> Servizi </a>
                    <a href="clubAbbonamenti.html"> Abbonamenti </a>
                    <a href="clubLounge.html"> Lounge </a>
                    <a href="clubIscriviti.html"> Iscriviti al Club </a>
                </div>
                <!-- Link Utili -->
                <div class="footerItem">
                    <p> Link Utili </p>
                    <a href="checkOnline.html"> Check-in Online </a>
                    <a href="bagagli.html"> Info Bagagli </a>
                    <a href="login_signup.php"> Area Riservata </a>
                    <a href="contatti.html"> Contatti </a>
                </div>
            </div>
            <p> Gabriele Vitali 1000010255 </p>
        </footer> 
        <!-- Chiusura footer -->    
    </body>
</html>


