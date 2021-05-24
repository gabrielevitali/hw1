<html>
    <head>
        <meta charset="utf-8">
        <title> Infinity Airways </title>
        <link rel="stylesheet" href="style/homepage.css" />
        <link rel="stylesheet" href="style/destinazioni.css" />
        <link rel="stylesheet" href="style/infoVoli.css" />
        <link rel="stylesheet" href="style/acquista.css" />
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet"> <!-- importo il font Raleway da Google Fonts -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="script/acquista.js" defer> </script>
        <script src="script/airportNames.js" defer> </script>
    </head>
    
    <body>
        <header>
            <nav>
                <a href="homepage.html"> Home </a>
                <a href="chiSiamo.html"> Chi Siamo </a>
                <a href="destinazioni.html"> Destinazioni </a>
                <a href="acquista.html"> Acquista </a>
                <a href="login_signup.php" class="button"> Area Riservata </a>
            </nav>
            <a href="homepage.html" id="title"> <h1> INFINITY AIRWAYS </h1> </a>
            <div class="overlay"> </div>   
        </header>

        <section>
            <p class="testoBlu"> Resta aggiornato sui voli di tuo interesse: effettua una ricerca in base ai parametri di tuo interesse! </p>
            <div class ='searchOptions'>
                <p class="testoBianco"> Cerca in base a: </p>
                <input type='radio' name='option' value='departureAirportDate'> Aeroporto di Partenza, Data
                <input type='radio' name='option' value='date'> Data
                <input type='radio' name='option' value='airportsDate'> Aeroporto di Partenza, Aeroporto di Arrivo, Data
            </div>
            <form name='searchBydepartureAirportDate' class='form' method='post'> <!-- Invio dati a questa stessa pagina - Inizialmente nascosto -->
            <label> Aeroporto di Partenza
                    <select name = 'departureAirport'> 
                        <option value = 'MAD'> Madrid (Spagna) Barajas MAD </option>
                        <option value = 'MXP'> Milano (Italia) Malpensa MXP </option>
                        <option value = 'LHR'> Londra (UK) Heathrow LHR </option>
                        <option value = 'CPH'> Copenaghen (Danimarca) Kastrup CPH </option>
                        <option value = 'CDG'> Parigi (Francia) Charles de Gaulle CDG </option>
                    </select>
                    <!-- Selezione Data -->
                    <input type="date" name="date" required>
                    <!-- Bottone per inviare -->
                    <input type="submit" name="searchBydepartureAirportDate" value="Cerca Volo">
            </label>
            </form>
            <form name='searchByDate' class='form' method='post'> <!-- Invio dati a questa stessa pagina - Inizialmente nascosto -->
            <label> Data di Partenza
                    <!-- Selezione Data -->
                    <input type="date" name="date" required>
                    <!-- Bottone per inviare -->
                    <input type="submit" name="searchByDate" value="Cerca Volo">
            </label>
            </form>
            <form name="searchByAirportsDate" class='form' method='post' action = 'searchByAirportsDate.php'> <!-- Invio dati a questa stessa pagina - Inizialmente nascosto -->
                <!-- Scelta Aeroporto di Partenza -->
                <label> Aeroporto di Partenza
                    <select name = 'departureAirport'> 
                        <option value = 'MAD'> Madrid (Spagna) Barajas MAD </option>
                        <option value = 'MXP'> Milano (Italia) Malpensa MXP </option>
                        <option value = 'LHR'> Londra (UK) Heathrow LHR </option>
                        <option value = 'CPH'> Copenaghen (Danimarca) Kastrup CPH </option>
                        <option value = 'CDG'> Parigi (Francia) Charles de Gaulle CDG </option>
                    </select>
                </label>
                <!-- Scelta Aeroporto di Arrivo -->
                <label> Aeroporto di Arrivo
                    <select name = 'arrivalAirport'> 
                        <option value = 'MAD'> Madrid (Spagna) Barajas MAD </option>
                        <option value = 'MXP'> Milano (Italia) Malpensa MXP </option>
                        <option value = 'LHR'> Londra (UK) Heathrow LHR </option>
                        <option value = 'CPH'> Copenaghen (Danimarca) Kastrup CPH </option>
                        <option value = 'CDG'> Parigi (Francia) Charles de Gaulle CDG </option>
                    </select>
                </label>
                <!-- Selezione Data -->
                <input type="date" name="date" required>
                <!-- Bottone per inviare -->
                <input type="submit" name="searchByAirportsDate" value="Cerca Volo">
            </form>
            
            <!-- Tabella inizialmente non visibile e contenente solo l'intestazione;
                 viene riempita dinamicamente in seguito a richiesta a endpoint di AviationStack-->
            <table id = 'flightTable'>
                <tr data-type ="heading" id = heading> <!-- Apertura Intestazione -->
                    <th> N. Volo </th>
                    <th id = 'from'> 
                      Da
                      <img src="https://image.flaticon.com/icons/png/512/68/68380.png">
                    </th> 
                    <th id = 'to'> 
                      A
                      <img src="https://image.flaticon.com/icons/png/512/68/68542.png">
                    </th> 
                    <th> Data Partenza </th> 
                    <th> Ora Partenza </th> 
                    <th> Data Arrivo </th>
                    <th> Ora Arrivo </th> 
                    <th> Stato </th>
                </tr> <!-- Chiusura Intestazione -->
            </table>
            <span class='testoRosso hidden'>  </span>
            <!-- Form di Registrazione -->
            <section class = 'buy'> <!-- Inizialmente nascosta -->
            <p class = 'testoBlu'> Compila il form e completa l'acquisto del volo da te selezionato! </p>
            <form name='buy' action="buy.php" method='post' autocomplete="off">
                        <input type = 'text' name = 'codiceFiscale' placeholder = 'Inserisci Codice Fiscale (16 cifre)' <?php if(isset($_POST["codiceFiscale"])){echo "value=".$_POST["codiceFiscale"];} ?>>
                        <input type = 'text' name = 'nome' placeholder = 'Inserisci Nome' <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?>>
                        <input type = 'text' name = 'cognome' placeholder = 'Inserisci Cognome' <?php if(isset($_POST["Cognome"])){echo "value=".$_POST["Cognome"];} ?>>
                        <input type = 'text' name = 'nazione' placeholder = 'Inserisci Nazione' <?php if(isset($_POST["Nazione"])){echo "value=".$_POST["Nazione"];} ?>>
                        <input type="date" name="dataNascita" required <?php if(isset($_POST["dataNascita"])){echo "value=".$_POST["dataNascita"];} ?>>
                        <input type = 'text' name = 'via' placeholder = 'Inserisci Via' <?php if(isset($_POST["via"])){echo "value=".$_POST["via"];} ?>>
                        <input type = 'text' name = 'numero' placeholder = 'Inserisci numero' <?php if(isset($_POST["numero"])){echo "value=".$_POST["numero"];} ?>>
                        <input type = 'text' name = 'CAP' placeholder = 'Inserisci CAP (5 cifre)' <?php if(isset($_POST["CAP"])){echo "value=".$_POST["CAP"];} ?>>
                        <input type = 'text' name = 'documento' placeholder = 'Inserisci documento' <?php if(isset($_POST["documento"])){echo "value=".$_POST["documento"];} ?>>
                        <input type = 'text' name = 'telefono' placeholder = 'Inserisci numero di telefono' <?php if(isset($_POST["telefono"])){echo "value=".$_POST["telefono"];} ?>>
                        <!-- Bottone per inviare i dati e procedere con l'acquisto -->
                        <input type="submit" name="signup" value="Acquista">
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
                    <a href="infoVoli.php"> Info Voli </a>
                    <a href="promozioni.html"> Promozioni </a>
                    <a href="proposteViaggio.html"> Proposte di Viaggio </a>
                </div>
                <!-- Privilege Club -->
                <div class="footerItem">
                    <p> Privilege Club </p>
                    <a href="clubServizi.html"> Servizi </a>
                    <a href="clubAbbonamenti.html"> Abbonamenti </a>
                    <a href="clubLounge.html"> Lounge </a>
                    <a href="clubIscriviti.php"> Iscriviti al Club </a>
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