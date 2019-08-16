function ajax(url, callback, form="") {
    let processResponseFunction = function() {
        if (this.readyState == 4 && this.status == 200) {
            callback(this.responseText);
        }
    };

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = processResponseFunction;

    if (form != "") {
        let formData = new FormData(form);
        let method = form.method;
        // xmlhttp.open("POST", url, true);
        xmlhttp.open(method, url, true);
        xmlhttp.send(formData);
    } else {
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
}