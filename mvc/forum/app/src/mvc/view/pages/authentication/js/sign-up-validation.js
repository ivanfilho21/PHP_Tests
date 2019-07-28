var form, cb, submit;
var inputs = [];
var ajaxSent = false;
var validationUrl = "scripts/auth-sign-up.php";

//
// TODO: MOSTRAR MENSAGEM DE ERRO EM BALÃO OU AO PASSAR O MOUSE

function initInputs() {
    form = document.getElementById("sign-up-form");
    inputs["name"] = form.name;
    inputs["username"] = form.username;
    inputs["email"] = form.email;
    inputs["pass"] = form.pass;
    inputs["pass2"] = form.pass2;
    cb = document.getElementById("user-terms");
    submit = document.getElementById("sign-up-form").save;
}

function validation(all = false) {
    if (ajaxSent) return false;

    let callback = function(response) {
        // console.log(response);
        response = JSON.parse(response);
        console.log(response);
        ajaxSent = false;
        submit.removeAttribute("class");

        for (let key in response) {
            inputs[key].setAttribute("class", response[key] == "1" ? "success" : "error");
            if (response[key] == "0") inputs[key].removeAttribute("class");
        }

        if (! all) return;

        // Check validated
        let valid = false;
        for (let key in response) {
            valid = response[key] == "1";
            // console.log("v: ", valid);
        }

        // console.log("Validation ", valid);

        if (valid) {
            form.submit();
        }
    }

    let url = validationUrl + "?";
    url += all ? "all=true&" : "";
    
    for (let key in inputs) {
        if (inputs[key].value.length <= 0) continue;

        let value = inputs[key].value;
        url += key + "=" + value + "&";
    }
    url = url.substring(0, url.length - 1);

    ajaxSent = true;
    submit.setAttribute("class", "disabled");
    ajax(url, callback);

    return false;
}

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