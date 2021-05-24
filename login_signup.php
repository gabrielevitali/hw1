<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Infinity Airways </title>
        <link rel="stylesheet" href="style/homepage.css" />
        <link rel="stylesheet" href="style/destinazioni.css" />
        <link rel="stylesheet" href="style/login_signup.css" />
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet"> <!-- importo il font Raleway da Google Fonts -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="script/login_signup.js" defer> </script>
    </head>
    
    <body>
        <header>
            <nav>
                <a href="homepage.html"> Home </a>
                <a href="chiSiamo.html"> Chi Siamo </a>
                <a href="destinazioni.html"> Destinazioni </a>
                <a href="infoVoli.html"> Info Voli </a>
                <a href="acquista.html"> Acquista </a>
            </nav>
            <a href="homepage.html" id="title"> <h1> INFINITY AIRWAYS </h1> </a>
            <div class="overlay"> </div>   
        </header>
        <main>
            <!-- Accedi -->
            <section class = 'mainLeft'>
                <p> Accedi alla tua Area Riservata </p>
                <!-- form di accesso all'area riservata -->
                <form name='login' action="login.php" method='post' autocomplete="off">
                    <input type = 'text' name = 'loginUsername' placeholder = 'Il tuo username' <?php if(isset($_POST["loginUsername"])){echo "value=".$_POST["loginUsername"];}?>>
                    <input type = 'password' name = 'loginPassword' placeholder = 'La tua password' <?php if(isset($_POST["loginPassword"])){echo "value=".$_POST["loginPassword"];} ?> >

                    <!-- Bottone per inviare i dati e accedere -->
                    <input type="submit" name="login" value="Accedi">
                </form>
            </section>

            <!-- Registrati -->
            <section class = 'mainRight'>
                <p> Non hai ancora un account? </p>
                <p> Registrati! Gestisci le tue prenotazioni e visualizza contenuti personalizzati per te </p>
                
                <!-- Bottone per creare un nuovo account  -->
                <button type='button' id="createAccount"> Crea un nuovo account </button>
            </section>
        </main>

        <!-- Form di Registrazione -->
        <section class = 'signup'> <!-- Inizialmente nascosta -->
            <p class = 'testoBlu'> Compila il form e completa la registrazione ad Infinity Airways! </p>
            <form name='signup' action="signup.php" method='post' autocomplete="off">
                        <input type = 'text' name = 'signupUsername' placeholder = 'Inserisci username' <?php if(isset($_POST["signupUsername"])){echo "value=".$_POST["signupUsername"];} ?>>
                        <input type = 'text' name = 'email' placeholder = 'Inserisci email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                        <input type = 'password' name = 'signupPassword' placeholder = 'Inserisci password' <?php if(isset($_POST["signupPassword"])){echo "value=".$_POST["signupPassword"];} ?>>
                        <input type = 'password' name = 'confirmPassword' placeholder = 'Conferma password' <?php if(isset($_POST["confirmPassword"])){echo "value=".$_POST["confirmPassword"];} ?>>

                        <!-- Bottone per inviare i dati e accedere -->
                        <input type="submit" name="signup" value="Registrati">
            </form>
        </section>


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