function ajax(url, callback, form="") {
    var processResponseFunction = function() {
        if (this.readyState == 4 && this.status == 200) {
            callback(this.responseText);
        }
    };

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = processResponseFunction;

    if (form != "") {
        let formData = new FormData(form);
        xmlhttp.open("POST", url, true);
        xmlhttp.send(formData);
    } else {
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
}