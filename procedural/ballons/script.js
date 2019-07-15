var colors = [
    "white", "lightgray", "gray", "lightgreen", "green", "darkslategray",
    "lightblue", "blue", "red", "gold", "crimson", "darkseagreen",
    "pink", "orange", "dodgerblue", "purple", "violet"
];

function addBall() {
    let ball = document.createElement("div");
    ball.setAttribute("class", "ball");

    let rx = Math.floor(Math.random() * 500);
    let ry = Math.floor(Math.random() * 400);
    let ri = Math.floor(Math.random() * colors.length);
    let color = colors[ri];
    console.log(rx, ry);

    ball.setAttribute("style", "position: absolute; left:" + rx + "px; top:" + ry + "px; background-color: " + color + ";");
    ball.setAttribute("onclick", "burst(this)");
    document.body.appendChild(ball);
}

function burst(ball) {
    document.body.removeChild(ball);
}