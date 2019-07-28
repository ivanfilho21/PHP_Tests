var usernameRegex = /[a-z0-9-]{6,}/;
var emailRegex = /[a-zA-Z0-9-\.,]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,3}(\.[a-zA-Z0-9-]+)*/;
var passRegex = /[\w]{6,}/;
var inputName, inputUsername, inputEmail, inputPass1, inputPass2, cb, submit;
var validationUrl = "scripts/auth-sign-up.php";

var ajaxSent = false;
var inputs = [];

//
// TODO: Refazer tudo via ajax :c
// TODO: MOSTRAR MENSAGEM DE ERRO EM BALÃO OU AO PASSAR O MOUSE

function initInputs() {
    let form = document.getElementById("sign-up-form");
    inputs["name"] = form.name;
    inputs["username"] = form.username;
    inputs["email"] = form.email;
    inputs["pass"] = form.pass;
    inputs["pass2"] = form.pass2;
    // inputs["cb"] = document.getElementById("user-terms");

    /*inputName = document.getElementById("sign-up-form").name;
    inputUsername = document.getElementById("sign-up-form").username;
    inputEmail = document.getElementById("sign-up-form").email;
    inputPass1 = document.getElementById("sign-up-form").pass;
    inputPass2 = document.getElementById("sign-up-form").pass2;*/
    cb = document.getElementById("user-terms");
    submit = document.getElementById("sign-up-form").save;
}

function validation(input) {
    if (ajaxSent) return false;

    let callback = function(response) {
        // console.log(response);
        response = JSON.parse(response);
        console.log(response);
        ajaxSent = false;
        submit.removeAttribute("class");

        if (input) {
            input.setAttribute("class", response[input.name] == "1" ? "success" : "error");
            if (response[input.name] == "0") input.removeAttribute("class");

            // if (input.name == "pass" && response["pass2"] != "0") {
                // alert("pass");
                // inputs["pass2"].setAttribute("class", response["pass2"] == "1" ? "success" : "error");
                // if (response[input.name] == "0") inputs["pass2"].removeAttribute("class");
            // }
            return;
        }

        for (let key in response) {
            inputs[key].setAttribute("class", response[key] == "1" ? "success" : "error");
            if (response[key] == "0") inputs[key].removeAttribute("class");
        }
    }

    let url = validationUrl + "?";
    if (input) {
        url += input.name + "=" + input.value;
    } else {
        for (let key in inputs) {
            let value = inputs[key].value;
            url += key + "=" + value + "&";
        }
        url = url.substring(0, url.length - 1);
    }

    ajax(url, callback);
    ajaxSent = true;
    submit.setAttribute("class", "disabled");

    return false;
}
/*
function validateName(name) {
    let callback = function(response) {
        input["name"].setAttribute("class", response == "1" ? "success" : "error");
        if (response == "0") input["name"].removeAttribute("class");
    };
    ajax(validationUrl + "?name=" + name, callback);
}

function validateUsername(username, checkEmpty = true) {
    let callback = function(response) {
        inputUsername.setAttribute("class", response == "1" ? "success" : "error");
        if (response == "0") inputUsername.removeAttribute("class");
    };
    ajax(validationUrl + "?username=" + username, callback);
}

function validateEmail(email, checkEmpty = true) {
    let callback = function(response) {
        console.log(response);
        inputEmail.setAttribute("class", response == "1" ? "success" : "error");
        if (response == "0") inputEmail.removeAttribute("class");
    };
    ajax(validationUrl + "?email=" + email, callback);
}

function validatePassword(pass, checkEmpty = true) {
    let callback = function(response) {
        console.log(response);
        inputPass1.setAttribute("class", response == "1" ? "success" : "error");
        if (response == "0") inputPass1.removeAttribute("class");
    };
    ajax(validationUrl + "?pass=" + pass + "&pass2=" + inputPass2.value, callback);
}

function validatePassword2(pass2, checkEmpty = true) {
    let callback = function(response) {
        console.log(response);
        inputPass2.setAttribute("class", response == "1" ? "success" : "error");
        if (response == "0") inputPass2.removeAttribute("class");
    };
    ajax(validationUrl + "?pass=" + inputPass1.value + "&pass2=" + pass2, callback);
}*/

function validateUserTerms(res, checkAlways = false) {
    let cm = document.getElementsByClassName("cb-wrapper")[0].
        getElementsByClassName("checkmark")[0];
    if (checkAlways) {
        if (! res)
            cm.setAttribute("class", cm.getAttribute("class") + " " + "error");
        else
            cm.setAttribute("class", "checkmark");
    }

    return res; 
}

window.onload = initInputs;