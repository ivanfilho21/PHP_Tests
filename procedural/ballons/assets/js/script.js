var colors = [];
var score = 0;

function addBall() {
    let score = document.getElementById("score");

    let ball = document.createElement("div");
    ball.setAttribute("class", "ball");

    let rx = Math.floor(Math.random() * window.innerWidth);
    let ry = Math.floor(Math.random() * 400) + score.offsetHeight;
    let ri = Math.floor(Math.random() * colors.length);
    let color = colors[ri];
    console.log(rx, ry);

    ball.setAttribute("style", "position: absolute; left:" + rx + "px; top:" + ry + "px; background-color: " + color + ";");
    ball.setAttribute("onclick", "burst(this)");
    document.body.appendChild(ball);
}

function burst(ball) {
    score++;
    document.getElementById("score").innerHTML = "Pontuação: " + score;
    document.body.removeChild(ball);
}

function createBalls() {
    setInterval(addBall, 1000);
}

function start() {
    let url = "script.php";
    let callback = function(response) {
        colors = JSON.parse(response);
        console.log(colors);
        createBalls();
    };
    ajax(url, callback);
}

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