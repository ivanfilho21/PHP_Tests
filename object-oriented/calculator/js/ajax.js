function requestCalculation() {
    var result = document.getElementById("result");
    var inputs = document.getElementsByTagName("input");
    var n1 = inputs[0].value;
    var n2 = inputs[1].value;

    var selects = document.getElementsByTagName("select");
    var i = selects[0].selectedIndex;
    var operation = selects[0].options[i].value;


    n1 = (n1 == "") ? 0 : n1;
    n2 = (n2 == "") ? ((operation == "Multiply" || operation == "Divide") ? 1 : 0) : n2;

    var xmlhttp = new XMLHttpRequest();
    // Full path to script in server http:// 
    // xmlhttp.open("GET", "submit.php?q=" + password, true);
    // xmlhttp.open("GET", "http://localhost/dev/php-tests/object-oriented/calculator/submit.php?n1=" + n1 + "&n2=" + n2 + "&op=" + operation, true);
    var url = "?n1=" + n1 + "&n2=" + n2 + "&op=" + operation;
    xmlhttp.open("GET", "submit.php" + url, true);
    xmlhttp.send(null);

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            result.innerHTML = this.responseText;
            // alert(this.responseText);
        }
    };
}