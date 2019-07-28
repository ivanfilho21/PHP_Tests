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
    inputs["cb"] = document.getElementById("user-terms");
    submit = document.getElementById("sign-up-form").save;
}

function validation(all = false) {
    if (ajaxSent) return false;

    let callback = function(response) {
        response = JSON.parse(response);
        console.log(response);

        ajaxSent = false;
        submit.removeAttribute("class");

        for (let key in response) {
            if (inputs[key]) {
                // Checkbox
                if (key == "cb") {
                    let cm = document.getElementsByClassName("cb-wrapper")[0].
                        getElementsByClassName("checkmark")[0];

                    if (response[key] == "2")
                        cm.setAttribute("class", cm.getAttribute("class") + " " + "error");
                    else
                        cm.setAttribute("class", "checkmark");

                    continue;
                }

                inputs[key].setAttribute("class", response[key] == "1" ? "success" : "error");
                if (response[key] == "0") inputs[key].removeAttribute("class");
            }
        }

        if (! all) return;

        if (response["valid"]) {
            form.submit();
        }
    }

    ajaxSent = true;
    submit.setAttribute("class", "disabled");
    ajax(generateURL(all), callback);

    return false;
}

function generateURL(all) {
    let url = validationUrl + "?";
    url += all ? "all=true&" : "";
    
    for (let key in inputs) {
        let value = key == "cb" ? inputs[key].checked : inputs[key].value;
        if (! value) continue;

        url += key + "=" + value + "&";
    }
    url = url.substring(0, url.length - 1);

    return url;
}

window.onload = function() { initInputs(); }