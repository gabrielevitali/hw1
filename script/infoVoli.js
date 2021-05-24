//credenziali ottenute in seguito alla registrazione al servizio di Amadeus.com
const client_id = 'OlD4Z6GmBYXUpi23jSUPvCAfZQNniv0z';
const client_secret = 'SGNujg2Wwa1XdeAA';

//variabili globali
let token;

//funzione che calcola la data attuale
function calculateDate(){
    let date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    if(month < 10){
        month = '0' + month;
    }
    let year = date.getFullYear();
    dateValue = year + '-' + month + '-' + day;

    return dateValue;
}

//funzione che calcola l'orario
function calculateTime(){
    let data = new Date();
    let hours = data.getHours()
    let minutes = data.getMinutes()
    let time = hours + ':' + minutes;

    return time;
}

/* funzione che, in base alla data e all'orario correnti, aggiorna l'informazione 
   sullo stato di un volo, il quale è invece memorizzata nel database */
function updateStatus(dataPartenza, oraArrivo, stato){
    let status;

    let currentTime = new Date();
    currentTime = calculateTime();
    //console.log("Current time: " + currentTime); 

    let expectedArrivalTime = new Date();
    expectedArrivalTime = oraArrivo;
    //console.log("Expected arrival time: " + expectedArrivalTime);

    let dbDepartureDate = new Date();
    dbDepartureDate = dataPartenza;
    console.log("departureDate: " + dbDepartureDate);

    let currentDate = new Date();
    currentDate = calculateDate();
    console.log("Current date: " + currentDate);

    if (dataPartenza === calculateDate()){
        if(currentTime > expectedArrivalTime){
            status = 'atterrato';
        }
        else {
            status = stato;
        }
    }
    else if(currentDate > dbDepartureDate){
        status = 'atterrato';
    }
    else{
        status = stato;
    }

    return status;
}

//funzione che elimina messaggio di errore
function hideError(string){
    const error = document.querySelector('.testoRosso');
    error.textContent = string;
    error.classList.add('hidden');
}

//funzione che genera messaggio di errore
function showError(string){
    const error = document.querySelector('.testoRosso');
    error.textContent = string;
    error.classList.remove('hidden');
    /* Nascondo l'intestazione della tabella */
    const heading = document.querySelector('#heading');
    heading.style.display = 'none';
    const rows = document.querySelectorAll('#flightTable tr');
    for(row of rows){
        if(row.dataset.type !== 'heading'){
            row.innerHTML = '';
        }
    }

}


//funzione che riceve un flight e lo aggiunge dinamicamente nella tabella dei voli, inizialmente nascosta
function addFlight(json){
    //console.log('La funzione addFlight() è stata chiamata.\n');
    hideError("");

    /* Se tale funzione viene chiamata, significa che è stata trovata almeno una corrispondenza,
       dunque rendo visibile l'intestazione della tabella */
    const heading = document.querySelector('#heading');
    heading.style.display = 'table-row';

    const flightTable = document.querySelector('#flightTable');
    
    //creo una nuova riga (vuota) e la aggiungo alla tabella
    const flightRow = document.createElement('tr');
    flightRow.style.backgroundColor = 'rgba(13, 40, 121, 0.856)';
    flightRow.style.color = 'white';
    flightTable.appendChild(flightRow);

    //creo cella per N. Volo
    const flightID = document.createElement('td');
    flightID.classList.add('td');
    flightID.textContent = json.flightID;
    flightRow.appendChild(flightID);

    //creo cella per Aeroporto di Partenza
    const departureAirport = document.createElement('td');
    departureAirport.classList.add('td');
    departureAirport.textContent = airportNames[json.aeroportoPartenza].nome;
    flightRow.appendChild(departureAirport);

    //creo cella per Aeroporto di Arrivo
    const arrivalAirport = document.createElement('td');
    arrivalAirport.classList.add('td');
    arrivalAirport.textContent = airportNames[json.aeroportoArrivo].nome;
    flightRow.appendChild(arrivalAirport);

    //creo cella per Data di Partenza
    const departureDate = document.createElement('td');
    departureDate.classList.add('td');
    departureDate.textContent = json.dataPartenza;
    flightRow.appendChild(departureDate);

    //creo cella per Orario di Partenza
    const departureTime = document.createElement('td');
    departureTime.classList.add('td');
    departureTime.textContent = json.oraPartenza;
    flightRow.appendChild(departureTime);

    //creo cella per Data di Arrivo
    const arrivalDate = document.createElement('td');
    arrivalDate.classList.add('td');
    arrivalDate.textContent = json.dataArrivo;
    flightRow.appendChild(arrivalDate);

    //creo cella per Orario di Arrivo
    const arrivalTime = document.createElement('td');
    arrivalTime.classList.add('td');
    arrivalTime.textContent = json.oraArrivo;
    flightRow.appendChild(arrivalTime);

    //creo p per Stato Volo
    const status = document.createElement('td');
    status.classList.add('td');
    status.textContent = updateStatus(json.dataPartenza, json.oraArrivo, json.stato);
    flightRow.appendChild(status);
    
    return;
}

function onAmadeusJson(json){
    const num = json.data.length;

    //controllo che la sezione delle attrazioni preferite dai clienti non sia già presente in viewport
    if(document.querySelector('.attractions') === null){
        //creo una nuova sezione nella viewport, al di sotto della tabella dei voli
        const box = document.createElement('div');
        box.classList.add('attractions');
        document.querySelector('section').appendChild(box);

        const p = document.createElement('p');
        p.textContent = 'Alcune delle attrazioni a Londra preferite dai nostri viaggiatori...';
        p.classList.add('testoBlu');
        box.appendChild(p);

        const boxContent = document.createElement('div');
        boxContent.style.display = 'flex';
        boxContent.style.alignItems = 'center';
        boxContent.style.justifyContent = 'center';
        box.appendChild(boxContent);
        
        const image1 = document.createElement('img');
        image1.src = 'https://i1.wp.com/alessandrosicurocomunication.com/wp-content/uploads/2020/10/https___www.history.com_.image_MTYyNDg1MjE3MTI1Mjc5Mzk4_topic-london-gettyimages-760251843-promo.jpg?fit=1920%2C1080&ssl=1';
        image1.classList.add('attractionsImage');
        boxContent.appendChild(image1);

        const image2 = document.createElement('img');
        image2.src = 'https://media.tacdn.com/media/attractions-splice-spp-674x446/09/93/6a/89.jpg';
        image2.classList.add('attractionsImage');
        boxContent.appendChild(image2);

        const ul = document.createElement('ul');
        boxContent.appendChild(ul);
        
        for(let i=0; i < num; i++){
            doc = json.data[i];
            const li = document.createElement('li');
            li.textContent = doc.name;
            li.classList.add('testoBlu');
            li.style.fontSize = '18px';
            ul.appendChild(li);

            console.log(doc.name); 
        } 
    }
}

function onAmadeusResponse(response){
    console.log('Amadeus status: ' + response.status);
    return response.json();
}

/*
                const params = 'north=51.520180&west=-0.169882&south=51.484703&east=-0.061048';
                //effettuo richiesta ad Amadeus.com
                fetch('https://test.api.amadeus.com/v1/reference-data/locations/pois/by-square?' + params, {
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(onAmadeusResponse).then(onAmadeusJson);
*/

function onTokenJson(json){
    token = json.access_token; //memorizzo il token ricevuto da Amadeus.com
    console.log(json.application_name + '\n');
    console.log(json.access_token);
}

function onTokenResponse(response){
    return response.json();
}

//Richiesta del token al servizio di Amadeus.com
fetch('https://test.api.amadeus.com/v1/security/oauth2/token', {
    method: 'post',
    body: 'grant_type=client_credentials&client_id=' + client_id + '&client_secret=' + client_secret,
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    }
}).then(onTokenResponse).then(onTokenJson);


//funzione che gestisce la risposta in formato .json restituita dalla pagina 'searchByAirportsDate.php' in seguito a richiesta
function onJsonAirportsDate(json){
    console.log(json);

    if(json[0]){
        console.log("La ricerca tramite Aeroporto di Partenza, Aeroporto di Arrivo e Data è avvenuta con esito positivo");

        const rows = document.querySelectorAll('#flightTable tr');
        for(row of rows){
            if(row.dataset.type !== 'heading'){
                row.innerHTML = '';
            }
        }
        for(let i=1; i < json.length; i++){
            let doc = json[i];
            console.log('Ho trovato la seguente corrispondenza: ');
            console.log('Numero di volo: ' + doc.flightID + '\n');
            console.log('Aeroporto di Partenza: ' + doc.aeroportoPartenza + '\n');
            console.log('Aeroporto di Arrivo: ' + doc.aeroportoArrivo + '\n');
            console.log('Data Partenza: ' + doc.dataPartenza + '\n');
            console.log('Ora Partenza: ' + doc.oraPartenza + '\n');
            console.log('Data Arrivo: ' + doc.dataArrivo + '\n');
            console.log('Ora Arrivo: ' + doc.oraArrivo + '\n');
            console.log('Stato: ' + doc.stato + '\n');
        
            //aggiungo dinamicamente il volo per cui ho trovato una corrispondenza
            addFlight(doc); //chiamata alla funzione che gestisce l'inserimento di una nuova riga (volo) in tabella

            const params = 'north=51.520180&west=-0.169882&south=51.484703&east=-0.061048';
            //effettuo richiesta ad Amadeus.com
            fetch('https://test.api.amadeus.com/v1/reference-data/locations/pois/by-square?' + params, {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            }).then(onAmadeusResponse).then(onAmadeusJson);
        }
    }
    else if (json.exists === false){
        const string = 'Non è stato trovato nessun volo corrispondente ai parametri specificati. Si prega di riprovare inserendo altri valori!';
        showError(string);
    }
}

function onResponseAirportsDate (response){
    console.log(response.status);
    return response.json();
}

//funzione di ricerca dei voli in base ad aeroporto di partenza, aeroporto di arrivo e data
function searchByAirportsDate(event){
    event.preventDefault();
    
    const departureAirport = encodeURIComponent(searchByAirportsDate_form.departureAirport.value);
    console.log(departureAirport);
    const arrivalAirport = encodeURIComponent(searchByAirportsDate_form.arrivalAirport.value);
    console.log(arrivalAirport);
    const date = encodeURIComponent(searchByAirportsDate_form.date.value);
    console.log(date);

     //Se aeroporto di partenza e aeroporto di arrivo coincidono...
     if(departureAirport === arrivalAirport){
        const string = "Aeroporto di Partenza ed Aeroporto di Arrivo devono essere diversi fra loro. Si prega di riprovare con un'altra coppia di aeroporti.";
        showError(string);
    }
    else{
        hideError(""); 
        //Preparo richiesta
        const url = "searchByAirportsDate.php?departureAirport=" + departureAirport + '&arrivalAirport=' + arrivalAirport + '&date=' + date;
        //Effettuo richiesta alla pagina 'searchByAirportsDate.php'
        fetch(url).then(onResponseAirportsDate).then(onJsonAirportsDate);
    }
    
    /* Al fine di verificare che l'utente selezioni una data nel form di ricerca,
       non effettuo il controllo che segue, bensì in HTML specifico che
       l'elemento input  di tipo "date" è required */
}





//funzione che gestisce la risposta in formato .json restituita dalla pagina 'searchByID.php' in seguito a richiesta
function onJsonID (json){
    if(json.exists){
        //console.log("La ricerca tramite flightID è avvenuta con esito positivo";

        const rows = document.querySelectorAll('#flightTable tr');
        for(row of rows){
            if(row.dataset.type !== 'heading'){
                row.innerHTML = '';
            }
        }
        console.log(json);
        console.log('Ho trovato la seguente corrispondenza: ');
        console.log('Numero di volo: ' + json.numeroVolo + '\n');
        console.log('Aeroporto di Partenza: ' + json.aeroportoPartenza + '\n');
        console.log('Aeroporto di Arrivo: ' + json.aeroportoArrivo + '\n');
        console.log('Data Partenza: ' + json.dataPartenza + '\n');
        console.log('Ora Partenza: ' + json.oraPartenza + '\n');
        console.log('Data Arrivo: ' + json.dataArrivo + '\n');
        console.log('Ora Arrivo: ' + json.oraArrivo + '\n');
        console.log('Stato: ' + json.stato + '\n');
            
        //aggiungo dinamicamente il volo per cui ho trovato una corrispondenza
        addFlight(json); //chiamata alla funzione che gestisce l'inserimento di una nuova riga (volo) in tabella

        const params = 'north=51.520180&west=-0.169882&south=51.484703&east=-0.061048';
        //effettuo richiesta ad Amadeus.com
        fetch('https://test.api.amadeus.com/v1/reference-data/locations/pois/by-square?' + params, {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        }).then(onAmadeusResponse).then(onAmadeusJson);
    }
    else if (json.exists === false){
        const string = 'Non è stato trovato nessun volo avente il flightID inserito. Si prega di riprovare con un altro flightID!';
        showError(string);
    }
}

function onResponseID (response){
    console.log(response.status);
    return response.json();
}

//funzione di ricerca dei voli in base al flightID
function searchByID(event){
    event.preventDefault();
    
    const flightID = encodeURIComponent(searchByID_form.flightID.value);
    //console.log(flightID);

    //Controllo di validazione del flightID inserito dall'utente
    if(flightID.length < 4){
        const string = 'Il formato del flightID inserito è errato. Si prega di inserire un flightID composto da 4 cifre!';
        showError(string);
    } 
    else{
        hideError(""); 
        //Effettuo richiesta alla pagina 'searchByID.php'
        fetch("searchByID.php?q="+flightID).then(onResponseID).then(onJsonID);
    }
}

//seleziono i due form di ricerca e associo loro il relativo handler di ricerca dei voli
const searchByID_form = document.forms['searchByID'];
const searchByAirportsDate_form = document.forms['searchByAirportsDate'];
//searchByID_button.addEventListener('click', searchByID);
searchByID_form.addEventListener('submit', searchByID);
searchByAirportsDate_form.addEventListener('submit', searchByAirportsDate);

function onSelectedOption(event){
    const option = event.currentTarget;

    const heading = document.querySelector('#heading');
    heading.style.display = 'none';

    const rows = document.querySelectorAll('#flightTable tr');
    for(row of rows){
        if(row.dataset.type !== 'heading'){
            row.innerHTML = '';
        }
    }

    //console.log(value);
    if(option.value === 'id'){
        searchByID_form.style.display = 'flex';
        searchByAirportsDate_form.style.display = 'none';
    }
    else if (option.value === 'airportsDate'){
        searchByAirportsDate_form.style.display = 'flex';
        searchByID_form.style.display = 'none';
    }
}

const searchOptions = document.querySelectorAll('input[type=radio]');
for(searchOption of searchOptions){
    searchOption.addEventListener('click', onSelectedOption);
}

