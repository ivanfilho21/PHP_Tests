var nameRegex = /[a-z0-9-]{6,}/;
var emailRegex = /[a-zA-Z0-9-\.,]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,3}(\.[a-zA-Z0-9-]+)*/;
var passRegex = /[\w]{6,}/;

var inputName, inputEmail, inputPass1, inputPass2;

function initInputs() {
    inputName = document.getElementById("sign-up-form").username;
    inputEmail = document.getElementById("sign-up-form").email;
    inputPass1 = document.getElementById("sign-up-form").pass;
    inputPass2 = document.getElementById("sign-up-form").pass2;
}

function validation() {
    let res = true;
}

function validateFieldValue(value, regex) {
    return value && regex.test(value) ? true : false;
}

function validateName(name) {
    let error = document.getElementsByClassName("error-msg")[0];
    let c = "";
    if (name) {
        if (! nameRegex.test(name)) {
            c = "error";
            error.innerHTML = "O nome de usuário deve ter no mínimo 6 caracteres.";
        } else {
            c = "success";
            error.innerHTML = "";
        }
        inputName.setAttribute("class", c);
    }
    if (name.length == 0) {
        inputName.removeAttribute("class");
        error.innerHTML = "";
    }
    // console.log(emailRegex.test(name));
}

function validateEmail(email) {
    if (email && email.length >= 6) {
        inputEmail.setAttribute("class", ! emailRegex.test(email) ? "error" : "success");
        // console.log(emailRegex.test(email));
    } else {
        inputEmail.removeAttribute("class");
    }
}

function validatePassword(pass) {
    if (pass) {
        inputPass1.setAttribute("class", ! passRegex.test(pass) ? "error" : "success");
        // console.log(emailRegex.test(pass));
    }
    if (pass.length == 0) {
        inputPass1.removeAttribute("class");
    }
}

function validatePassword2(pass2) {
    if (pass2) {
        inputPass2.setAttribute("class", inputPass1.value != pass2 ? "error" : "success");
        // console.log(emailRegex.test(pass));
    }
    if (pass2.length == 0) {
        inputPass2.removeAttribute("class");
    }
}

window.onload = initInputs;