<html>
    <head>
        <meta charset="utf-8">
        <title> Infinity Airways </title>
        <link rel="stylesheet" href="style/homepage.css" />
        <link rel="stylesheet" href="style/destinazioni.css" />
        <link rel="stylesheet" href="style/login_signup.css" />
        <link rel="stylesheet" href="style/check_in.css" />
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet"> <!-- importo il font Raleway da Google Fonts -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="script/check_in.js" defer> </script>
    </head>
    
    <body>
        <header>
            <nav>
                <a href="homepage.html"> Home </a>
                <a href="infoVoli.php"> Info Voli </a>
                <a href="acquista.php"> Acquista </a>
                <a href="login_signup.php" class="button"> Area Riservata </a>
            </nav>
            <a href="homepage.html" id="title"> <h1> INFINITY AIRWAYS </h1> </a>
            <div class="overlay"> </div>   
        </header>
        <main>
            <!-- Immagine -->
            <section class = 'mainLeft'>
                <p> Benvenuto nel servizio di Online Check-In di Infinity Airways! </p>
                <img src = 'images/check_in.jpg'>
            </section>

            <!-- Check-in -->
            <section class = 'mainRight'>
                <p> Mettiti comodo e risparmia tempo in aeroporto effettuando il check-in online, senza alcuna spesa aggiuntiva. </p>
                <p> Occorre solo inserire il proprio Codice Fiscale e il Codice del Volo per cui effettuare il Check-In </p>
                
                <!-- Bottone per creare un nuovo account  -->
                <form name='check_in' action='check_in_server.php'>
                    <input type = 'text' name = "codiceFiscale" placeholder = 'Il tuo codice fiscale' <?php if(isset($_POST["codiceFiscale"])){echo "value=".$_POST["codiceFiscale"];} ?>>
                    <input type = 'text' name = "flightID" placeholder = 'Il codice del volo (4 cifre)' <?php if(isset($_POST["flightID"])){echo "value=".$_POST["flightID"];} ?>>
                    <input type = 'submit' name = "check_in" value = 'Effettua il Check-In'>
                </form>
                <span class='disclaimer testoVerde hidden'>  </span>
            </section>
        </main>

        
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
                    <a href="infoVoli.php"> Info Voli </a>
                    <a href="promozioni.html"> Promozioni </a>
                    <a href="proposteViaggio.html"> Proposte di Viaggio </a>
                </div>
                <!-- Privilege Club -->
                <div class="footerItem">
                    <p> Privilege Club </p>
                    <a href="login_signup.php"> Servizi </a>
                    <a href="login_signup.php"> Abbonamenti </a>
                    <a href="login_signup.php"> Lounge </a>
                    <a href="login_signup.php"> Iscriviti al Club </a>
                </div>
                <!-- Link Utili -->
                <div class="footerItem">
                    <p> Link Utili </p>
                    <a href="check_in.php"> Check-in Online </a>
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