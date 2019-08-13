var form, inputs = [], submit;
var ajaxSent = false;


function initInputs() {
    alert("Init");
    form = document.getElementById("category-form");
    submit = form.submit;
    inputs["name"] = form.categoryname;
}

function validation() {
    if (ajaxSent) return false;
    alert("Validação de Categoria");

    let callback = function(response) {
        response = JSON.parse(response);
        console.log(response);

        ajaxSent = false;

        for (let key in response) {
            if (inputs[key]) {
                console.log("Error msg:", response[key]);
                // showErrorMessage(response[key], inputs[key].parentNode);

                inputs[key].setAttribute("class", response[key] == "1" ? "success" : "error");
                if (response[key] == "0") inputs[key].removeAttribute("class");
            }
        }

        // if (! all) return;

        if (response["finished"]) {
            alert("finished");
            // window.location.replace(URL + "dashboard");
        }
    };

    ajaxSent = true;
    submit.setAttribute("class", "disabled");

    // ajax
    return false;
}

window.onload = function() {
    initInputs();
}