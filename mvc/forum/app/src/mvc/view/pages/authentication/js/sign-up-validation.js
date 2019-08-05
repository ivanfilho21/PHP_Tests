var form, cb, submit;
var inputs = [];
var ajaxSent = false;
var validationUrl = "scripts/auth-sign-up.php";

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

                    if (response[key] != "1") {
                        cm.setAttribute("class", cm.getAttribute("class") + " " + "error");
                    }
                    else
                        cm.setAttribute("class", "checkmark");

                    continue;
                }

                showErrorMessage(response[key], inputs[key].parentNode);

                inputs[key].setAttribute("class", response[key] == "1" ? "success" : "error");
                if (response[key] == "0") inputs[key].removeAttribute("class");
            }
        }

        if (! all) return;

        if (response["finished"]) {
            alert("Usuário Cadastrado com Sucesso!");
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
    msg.innerHTML = res;

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

// Not using this function anymore
function showErrorMessageOLD(res, parent) {
    // Remove all messages first
    let msgs = document.getElementsByClassName("error-msg");
    for (let i; i < msgs.length; i++) {
        msgs[i].parentNode.removeChild(msgs[i]);
    }

    let icon = parent.getElementsByClassName("error-icon")[0];

    if (res == "0" || res == "1") {
        icon.style.display = "none";
        return;
    }

    icon.style.display = "block";
    
    let msg = document.createElement("span");
    msg.setAttribute("class", "error-msg");
    msg.innerHTML = res;

    let clone = document.createElement("span");
    clone.innerHTML = res;
    clone.style.position = "absolute";
    clone.style.visibility = "hidden";
    clone.style.opacity = "0";
    document.body.appendChild(clone);

    /*console.log("Client", msg.clientWidth);
    console.log("Scroll", msg.scrollWidth);
    console.log("Offset", msg.offsetWidth);*/

    let msgWidth = clone.offsetWidth;
    let msgHeight = clone.offsetHeight;
    let msgMargin = 26;
    let msgLeft = icon.offsetLeft + icon.offsetWidth + msgMargin;
    let msgRight = icon.offsetLeft + icon.offsetWidth - msgMargin - msgWidth;
    let msgTop = icon.offsetTop - icon.offsetHeight - msgMargin - msgHeight;
    let msgBottom = icon.offsetTop + icon.offsetHeight + msgMargin;

    console.log("Available Width: ", window.innerWidth);
    console.log("Left Icon + Msg", msgLeft + msgWidth);
    console.log("Available Height: ", window.scrollY);
    console.log("Top Icon + Msg", msgTop);

    document.body.removeChild(clone);

    // TODO: KEEP TESTING SCROLL AND FIX BUG of 2nd time

    msg.style.left = msgLeft + "px";

    if ((msgLeft + msgWidth) < window.innerWidth) {
        msg.style.top = icon.offsetTop - icon.offsetHeight/2 - 6 + "px";
        msg.style.left = msgLeft + "px";
    } else {
        if (msgTop > window.scrollY) {
            msg.style.top = msgTop + "px";
            msg.style.left = icon.offsetLeft + icon.offsetWidth - msgWidth/2 + "px";
        } else {
            msg.style.top = -99999 + "px";
        }
    }
    
    parent.appendChild(msg);
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
window.onresize = function() { validation(); }