function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
  }

//funzione che elimina messaggio di errore
function hideDisclaimer(){
    const disclaimer = document.querySelector('.disclaimer');
    disclaimer.classList.add('hidden');
}

//funzione che genera messaggio di errore
function showDisclaimer(string){
    const disclaimer = document.querySelector('.disclaimer');
    disclaimer.textContent = string;
    disclaimer.classList.remove('hidden');

    const mainLeft = document.querySelector('.mainLeft');
    const mainRight = document.querySelector('.mainRight');
    mainLeft.style.borderRight = 'none';
    mainRight.style.borderLeft = 'solid rgb(6, 20, 61) 3px';
}

function checkCodiceFiscale(event){
    const input = event.currentTarget;
    //console.log(input.value);

    const codiceFiscaleError = document.querySelector('.codiceFiscaleError');
    if(!/^[a-zA-Z]{6}[0-9]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9]{2}([a-zA-Z]{1}[0-9]{3})[a-zA-Z]{1}$/.test(input.value)) { //caso di errore
        //console.log('Il formato del Codice Fiscale è errato');
        event.currentTarget.style.border = '2px solid red';
        if(codiceFiscaleError === null){
            let codiceFiscaleErrorDisclaimer = document.createElement('span');
            codiceFiscaleErrorDisclaimer.textContent = "Occorre inserire esattamente 16 caratteri"
            codiceFiscaleErrorDisclaimer.classList.add('codiceFiscaleError');
            insertAfter(input, codiceFiscaleErrorDisclaimer);
        }
    } else { //caso di successo
        //console.log('Il formato del flightID è corretto');
        if(codiceFiscaleError !== null){
            codiceFiscaleError.remove();
        }
        event.currentTarget.style.border = '2px solid green';
    }  
}

function checkflightID(event){
    const input = event.currentTarget;
    //console.log(input.value);

    const flightIDError = document.querySelector('.flightIDError');
    if(!/^[0-9]{4}$/.test(input.value)) { //caso di errore
        //console.log('Il formato del flightID è errato');
        event.currentTarget.style.border = '2px solid red';
        if(flightIDError === null){
            let flightIDErrorDisclaimer = document.createElement('span');
            flightIDErrorDisclaimer.textContent = "Occorre inserire esattamente 4 cifre (es. 4015)"
            flightIDErrorDisclaimer.classList.add('flightIDError');
            insertAfter(input, flightIDErrorDisclaimer);
            checkForm.check_in.style.marginTop = "10px";
        }
    } else { //caso di successo
        //console.log('Il formato del flightID è corretto');
        if(flightIDError !== null){
            flightIDError.remove();
            checkForm.check_in.style.marginTop = "0px";
        }

        event.currentTarget.style.border = '2px solid green';
    }  
    
}

function onJsonSubmit(json){
    console.log(json);

    if(json.existed){
        string = 'Avevi già effettuato il check-in per il volo indicato. Il tuo ticketID è il seguente: ' + json.ticketID + '. Ti aspettiamo a bordo!';
        showDisclaimer(string);
    }
    else {
        string = 'Il check-in è andato a buon fine. Il tuo ticketID è il seguente: ' + json.ticketID + '. Ti aspettiamo a bordo!';
        showDisclaimer(string);
    }
}

function onResponseSubmit (response){
    console.log(response.status);
    return response.json();
}

function onSubmit(event){
    event.preventDefault();
    hideDisclaimer();

    const codiceFiscale = checkForm.codiceFiscale.value;
    const flightID = checkForm.flightID.value;
    //console.log(codiceFiscale);
    //console.log(flightID);
    const url = "check_in_server.php?codiceFiscale=" + codiceFiscale + '&flightID=' + flightID;
    fetch(url).then(onResponseSubmit).then(onJsonSubmit);
}

//seleziono il form di registrazione
const checkForm = document.forms['check_in'];
checkForm.codiceFiscale.addEventListener('blur', checkCodiceFiscale);
checkForm.flightID.addEventListener('blur', checkflightID);
checkForm.addEventListener('submit', onSubmit);