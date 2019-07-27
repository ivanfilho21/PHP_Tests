var usernameRegex = /[a-z0-9-]{6,}/;
var emailRegex = /[a-zA-Z0-9-\.,]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,3}(\.[a-zA-Z0-9-]+)*/;
var passRegex = /[\w]{6,}/;
var inputName, inputUsername, inputEmail, inputPass1, inputPass2, cb;

function initInputs() {
    inputName = document.getElementById("sign-up-form").name;
    inputUsername = document.getElementById("sign-up-form").username;
    inputEmail = document.getElementById("sign-up-form").email;
    inputPass1 = document.getElementById("sign-up-form").pass;
    inputPass2 = document.getElementById("sign-up-form").pass2;
    cb = document.getElementById("user-terms");

    console.log(document.getElementById("sign-up-form").childNodes);
}

function validation() {
    let res = validateName(inputName.value) &
        validateUsername(inputUsername.value, false) &
        validateEmail(inputEmail.value, false) &
        validatePassword(inputPass1.value, false) &
        validatePassword2(inputPass2.value, false) &
        validateUserTerms(cb.checked, false) ? true : false;
    return res;
}

function validateName(name) {
    let res = true;

    if (name.length <= 0) {
        res = false;
    }

    inputName.setAttribute("class", res ? "success" : "error");
    return res;
}

function validateUsername(username, checkEmpty = true) {
    let res = true;

    if (! usernameRegex.test(username)) {
        res = false;
    }
    inputUsername.setAttribute("class", res ? "success" : "error");

    if (checkEmpty && username.length == 0) {
        inputUsername.removeAttribute("class");
        res = false;
    }

    return res;
}

function validateEmail(email, checkEmpty = true) {
    let res = true;

    if (! emailRegex.test(email)) {
        res = false;
    }
    inputEmail.setAttribute("class", res ? "success" : "error");

    if (checkEmpty && email.length == 0) {
        inputEmail.removeAttribute("class");
        res = false;
    }

    return res;
}

function validatePassword(pass, checkEmpty = true) {
    let res = true;

    if (! passRegex.test(pass)) {
        res = false;
    }
    inputPass1.setAttribute("class", res ? "success" : "error");

    if (checkEmpty && pass.length == 0) {
        inputPass1.removeAttribute("class");
        res = false;
    }

    return validatePassword2(inputPass2.value);
}

function validatePassword2(pass2, checkEmpty = true) {
    let res = false;

    if (inputPass1.value == pass2 && passRegex.test(pass2)) {
        res = true;
    }
    inputPass2.setAttribute("class", res ? "success" : "error");

    if (checkEmpty && pass2.length == 0) {
        inputPass2.removeAttribute("class");
        res = false;
    }

    return res;
}

function validateUserTerms(res) {
    let cm = document.getElementsByClassName("cb-wrapper")[0].
        getElementsByClassName("checkmark")[0];

    if (! res)
        cm.setAttribute("class", cm.getAttribute("class") + " " + "error");
    else
        cm.setAttribute("class", "checkmark");

    return res; 
}

window.onload = initInputs;