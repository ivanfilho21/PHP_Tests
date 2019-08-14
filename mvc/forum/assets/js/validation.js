var form, inputs = [], ajaxSent = false, validationUrl = "";
var categories, boards, submit;

function initInputs() {
    form = document.getElementById("form");
    inputs["category-title"] = form["topic-title"];
    inputs["category-content"] = form["topic-content"];

    categories = form["category"];
    boards = form["board"];
    submit = form.submit;

    validationUrl = form.getAttribute("data-validation-url");
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
                showErrorMessage(response[key], inputs[key].parentNode);

                inputs[key].setAttribute("class", response[key] == "1" ? "success" : "error");
                if (response[key] == "0") inputs[key].removeAttribute("class");
            }
        }

        if (! all) return;

        if (response["finished"]) {
            alert("Validation is finished");
            // window.location.replace(URL + "dashboard");
        }
    }

    ajaxSent = true;
    submit.setAttribute("class", "disabled");
    ajax(generateURL(all), callback);

    return false;
}

function showErrorMessage(res, parent) {
    let icon = parent.getElementsByClassName("error-icon")[0];
    let msg = parent.getElementsByClassName("error-msg")[0];
    
    if (res == "0" || res == "1") {
        if (typeof icon != typeof undefined) icon.remove();
        if (typeof msg != typeof undefined) msg.remove();
        return;
    }

    icon = (typeof icon != typeof undefined) ? icon : document.createElement("span");
    icon.setAttribute("class", "error-icon");
    icon.innerHTML = "<i class='fa fa-exclamation-circle'></i>";
    parent.appendChild(icon);

    msg = (typeof msg != typeof undefined) ? msg : document.createElement("span");
    msg.setAttribute("class", "error-msg");
    msg.innerHTML = res == "2" ? "Preencha este campo." : res;

    // CLONE
    let clone = document.createElement("span");
    clone.innerHTML = res;
    clone.style.position = "absolute";
    clone.style.visibility = "hidden";
    clone.style.opacity = "0";
    document.body.appendChild(clone);

    let msgWidth = clone.offsetWidth;
    let msgHeight = clone.offsetHeight;
    let msgMargin = 26;
    let msgLeft = icon.offsetLeft + icon.offsetWidth + msgMargin;
    let msgRight = icon.offsetLeft + icon.offsetWidth - msgMargin - msgWidth;
    let msgTop = icon.offsetTop - icon.offsetHeight - msgMargin - msgHeight;
    let msgBottom = icon.offsetTop + icon.offsetHeight + msgMargin;

    document.body.removeChild(clone);

    msg.style.top = msgTop + "px";
    msg.style.left = icon.offsetLeft + icon.offsetWidth - (msgWidth <= 250 ? 250 : msgWidth) + "px";
    
    parent.appendChild(msg);
}

function generateURL(all) {
    let url = validationUrl + "?";
    url += all ? "all=true&" : "";
    
    for (let key in inputs) {
        // console.log(inputs[key].name);
        let value = inputs[key].value || inputs[key].selectedIndex;
        // console.log(value);
        value = typeof value != typeof undefined ? value : "";

        url += key + "=" + value + "&";
    }
    url = url.substring(0, url.length - 1);

    return url;
}