var mode;
var form, cb, submit;
var inputs = [];
var ajaxSent = false;
var validationUrl = "scripts/auth-sign-in.php";

function initInputs() {
    form = document.getElementById("sign-in-form");
    inputs["username"] = form.username;
    inputs["pass"] = form.pass;
    inputs["cb"] = form.session;
    submit = form.submit;
}

function validation() {
    if (ajaxSent) return false;

    let callback = function(response) {
        response = JSON.parse(response);
        console.log(response);

        ajaxSent = false;
        submit.removeAttribute("class");

        if (response["finished"]) {
            window.location.replace(URL + "home");
        } else {
            let error = document.body.getElementsByClassName("alert-danger")[0];
            error = ! error ? document.createElement("div") : error;
            error.setAttribute("class", "alert alert-danger text-align-center");
            error.innerHTML = "Nome de usuário ou Senha incorretos.";

            form.appendChild(error);
            inputs["username"].focus();
        }
    }

    ajaxSent = true;
    submit.setAttribute("class", "disabled");
    ajax(generateURL(), callback);

    return false;
}

function generateURL() {
    let url = validationUrl + "?";
    
    for (let key in inputs) {
        let value = key == "cb" ? inputs[key].checked : inputs[key].value;
        if (! value) continue;

        url += key + "=" + value + "&";
    }
    url = url.substring(0, url.length - 1);

    return url;
}