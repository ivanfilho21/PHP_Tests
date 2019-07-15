var colors = [
    "white", "lightgray", "gray", "lightgreen", "green", "darkslategray",
    "lightblue", "blue", "red", "gold", "crimson", "darkseagreen",
    "pink", "orange", "dodgerblue", "purple", "violet"
];

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

function start() {
    setInterval(addBall, 1000);
}