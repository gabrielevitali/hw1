function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
  }

/* funzione che verifica la correttezza dell'username inserito dall'utente, in fase di login */
function checkUsernameLogin (event) {
    const input = event.currentTarget;
    //console.log(input.value);

    const usernameError = document.querySelector('.usernameError');
    if(!/^[a-zA-Z0-9_]{5,15}$/.test(input.value)) { //caso di errore
        //console.log('Il formato dell'username è errato');
        event.currentTarget.style.border = '2px solid red';
        if(usernameError === null){
            let usernameErrorDisclaimer = document.createElement('span');
            usernameErrorDisclaimer.textContent = "Sono ammesse lettere, numeri e underscore. min 5, MAX. 15"
            usernameErrorDisclaimer.classList.add('usernameError');
            insertAfter(input, usernameErrorDisclaimer);
        }
    } else { //caso di successo
        //console.log('Il formato dell'username è corretto');
        if(usernameError !== null){
            usernameError.remove();
        }
        event.currentTarget.style.border = '2px solid green';
    }  
}

function onJson(json) {
    // Controllo il campo exists ritornato dal JSON
    const usernameError = document.querySelector('.usernameError');
    if (json.exists) {
        signupForm.signupUsername.style.border = '2px solid red';
        if(usernameError === null){
            let usernameErrorDisclaimer = document.createElement('span');
            usernameErrorDisclaimer.textContent = "Username già in uso. Riprovare con un altro."
            usernameErrorDisclaimer.classList.add('usernameError');
            insertAfter(signupForm.signupUsername, usernameErrorDisclaimer);
        }
    } 
    else {
        if(usernameError !== null){
            usernameError.remove();
        }
        signupForm.signupUsername.style.border = '2px solid green';
    }
}

function onResponse(response) {
    console.log(response.status);
    return response.json();
}

/* funzione che verifica la correttezza dell'username inserito dall'utente, in fase di registrazione */
//faccio fetch() a login_signup.php
function checkUsernameSignup (event) {
    const input = event.currentTarget;
    //console.log(input.value);

    const usernameError = document.querySelector('.usernameError');
    if(!/^[a-zA-Z0-9_]{5,15}$/.test(input.value)) { //caso di errore
        //console.log('Il formato dell'username è errato');
        event.currentTarget.style.border = '2px solid red';
        if(usernameError === null){
            let usernameErrorDisclaimer = document.createElement('span');
            usernameErrorDisclaimer.textContent = "Sono ammesse lettere, numeri e underscore. min 5, MAX. 15"
            usernameErrorDisclaimer.classList.add('usernameError');
            insertAfter(input, usernameErrorDisclaimer);
        }
    } else { //caso di successo
        //console.log('Il formato dell'username è corretto');
        if(usernameError !== null){
            usernameError.remove();
        }

        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(onResponse).then(onJson);
        event.currentTarget.style.border = '2px solid green';
    }  
}

/* funzione che verifica la correttezza della password inserita dall'utente */
function checkPassword(event) {
    const input = event.currentTarget;
    //console.log(input.value);
    
    const passwordError = document.querySelector('.passwordError');
    if(!/^[a-zA-Z0-9@&]{5,15}$/.test(input.value)) { //caso di errore
        //console.log('Il formato della password è errato');
        event.currentTarget.style.border = '2px solid red';
        if(passwordError === null){
            let passwordErrorDisclaimer = document.createElement('span');
            passwordErrorDisclaimer.textContent = "Sono ammesse lettere, numeri, @&. min 5, MAX. 15"
            passwordErrorDisclaimer.classList.add('passwordError');
            insertAfter(input, passwordErrorDisclaimer);
            loginForm.login.style.marginTop = "10px";
        }
    } else { //caso di successo
        //console.log('Il formato della password è corretto');
        if(passwordError !== null){
            passwordError.remove();
            loginForm.login.style.marginTop = "0px";
        }
        event.currentTarget.style.border = '2px solid green';
    }
}

/* funzione che verifica la correttezza della password inserita dall'utente */
function checkConfirmPassword(event) {
    const input = event.currentTarget;
    //console.log(input.value);
    
    const confirmPasswordError = document.querySelector('.confirmPasswordError');
    if(!/^[a-zA-Z0-9@&]{5,15}$/.test(input.value)) { //caso di errore
        //console.log('Il formato della password è errato');
        event.currentTarget.style.border = '2px solid red';
        if(confirmPasswordError === null){
            let confirmPasswordErrorDisclaimer = document.createElement('span');
            confirmPasswordErrorDisclaimer.textContent = "Sono ammesse lettere, numeri, @&. min 5, MAX. 15"
            confirmPasswordErrorDisclaimer.classList.add('confirmPasswordError');
            insertAfter(input, confirmPasswordErrorDisclaimer);
            signupForm.signup.style.marginTop = "10px";
        }
    } else { // caso di successo
        //console.log('Il formato della password è corretto');
        if(confirmPasswordError !== null){
            confirmPasswordError.remove();
            signupForm.signup.style.marginTop = "0px";
        }
        event.currentTarget.style.border = '2px solid green';
    }

    //controllo che le password inserite nei campi password e confirmPassword coincidano
    if(input.value !== loginForm.loginPassword.value){ //caso di errore: le due password inserite non coincidono
        console.log("Le password inserite non coincidono");
        event.currentTarget.style.border = '2px solid red';
        if(confirmPasswordError === null){
            let confirmPasswordErrorDisclaimer = document.createElement('span');
            confirmPasswordErrorDisclaimer.textContent = "Le password inserite non coincidono"
            confirmPasswordErrorDisclaimer.classList.add('confirmPasswordError');
            insertAfter(input, confirmPasswordErrorDisclaimer);
            signupForm.signup.style.marginTop = "10px";
    }
    else { // caso di successo: le due password inserite coincidono
        console.log("Le password inserite coincidono");
        if(confirmPasswordError !== null){
            confirmPasswordError.remove();
            signupForm.signup.style.marginTop = "0px";
        }
        event.currentTarget.style.border = '2px solid green';
    }
    }
}

/* funzione che verifica la correttezza dell'email inserita dall'utente */
//FIXARE
function checkEmail(event) { /* posso avere la stessa mail associata allo stesso account, dunque non effettuo 
                                una fecth a login_signup.php per interrogare database e verificare la mail
                                inserita sia già stata inserita in esso */
    const input = event.currentTarget;
    console.log(input.value);

    const emailError = document.querySelector('.emailError');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test((input.value).toLowerCase())) { //caso di errore
        console.log("Il formato dell'email è errato");
        event.currentTarget.style.border = '2px solid red';
        if(emailError === null){
            let emailErrorDisclaimer = document.createElement('span');
            emailErrorDisclaimer.textContent = "Email non valida"
            emailErrorDisclaimer.classList.add('emailError');
            insertAfter(input, emailErrorDisclaimer);
        }
    } else { //caso di successo
        console.log("Il formato dell'email è corretto");
        if(emailError !== null){
            emailError.remove();
        }
        event.currentTarget.style.border = '2px solid green';
    }
}

//seleziono il form di login e gli associo l'handler login()
const loginForm = document.forms['login'];
//loginForm.addEventListener('submit', login);
loginForm.loginUsername.addEventListener('blur', checkUsernameLogin);
loginForm.loginPassword.addEventListener('blur', checkPassword);

//seleziono il form di registrazione
const signupForm = document.forms['signup'];
signupForm.signupUsername.addEventListener('blur', checkUsernameSignup);
signupForm.email.addEventListener('blur', checkEmail);
signupForm.signupPassword.addEventListener('blur', checkPassword);
signupForm.confirmPassword.addEventListener('blur', checkConfirmPassword);


function hideRegisterForm(event){
    event.currentTarget.removeEventListener('click', hideRegisterForm);

    const signup = document.querySelector('.signup');
    const main = document.querySelector('main');
    const mainLeft = document.querySelector('.mainLeft');
    const mainRight = document.querySelector('.mainRight');
    const imageContainer = document.querySelector('.imageContainer');

    //riporto il campo username del form di registrazione allo stato iniziale
    signupForm.signupUsername.value = '';
    signupForm.signupUsername.style.border = '2px solid rgba(112, 128, 144, 0.164)';
    //riporto il campo email del form di registrazione allo stato iniziale
    signupForm.email.value = '';
    signupForm.email.style.border = '2px solid rgba(112, 128, 144, 0.164)';
    //riporto il campo password del form di registrazione allo stato iniziale
    signupForm.signupPassword.value = '';
    signupForm.signupPassword.style.border = '2px solid rgba(112, 128, 144, 0.164)';
    //riporto il campo confirmPassword del form di registrazione allo stato iniziale
    signupForm.confirmPassword.value = '';
    signupForm.confirmPassword.style.border = '2px solid rgba(112, 128, 144, 0.164)';

    signup.style.display = 'none';
    main.style.minHeight = '420px';
    mainLeft.style.display = 'flex';
    mainRight.style.marginLeft = '50px';
    imageContainer.remove();

    const usernameError = document.querySelector('.usernameError');
    const emailError = document.querySelector('.emailError');
    const passwordError = document.querySelector('.passwordError');
    const confirmPasswordError = document.querySelector('.confirmPasswordError');

    if(usernameError !== null){
        usernameError.remove();
    }
    if(emailError !== null){
        emailError.remove();
    }
    if(passwordError !== null){
        passwordError.remove();
    }
    if(confirmPasswordError !== null){
        confirmPasswordError.remove();
    }

    event.currentTarget.textContent = 'Crea un nuovo account';

    event.currentTarget.addEventListener('click', showRegisterForm);
}

function showRegisterForm(event){
    event.currentTarget.removeEventListener('click', showRegisterForm);

    const signup = document.querySelector('.signup');
    const main = document.querySelector('main');
    const mainLeft = document.querySelector('.mainLeft');
    const mainRight = document.querySelector('.mainRight');
    signup.style.display = 'flex';
    main.style.minHeight = '300px';
    mainLeft.style.display = 'none';
    mainRight.style.marginLeft = '0px';

    //creo e inserisco immagine
    let imageContainer = document.createElement('div');
    imageContainer.classList.add('imageContainer');
    let image = document.createElement('img');
    image.classList.add('imageContainerImg');
    image.src = 'https://i1.wp.com/www.mipiacelathailandia.it/wp-content/uploads/2017/01/Qatar-Airways-01.jpg?fit=1272%2C795&ssl=1';
    imageContainer.appendChild(image);
    let body = document.querySelector('body');
    imageContainer = body.insertBefore(imageContainer, signup);

    event.currentTarget.textContent = 'Nascondi form di registrazione';

    event.currentTarget.addEventListener('click', hideRegisterForm);
}

const createAccount = document.querySelector('#createAccount');
createAccount.addEventListener('click', showRegisterForm);
