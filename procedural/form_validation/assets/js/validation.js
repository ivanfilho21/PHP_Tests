var nameRegex = /^[a-z0-9_-]{4,12}$/;
var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
// var passRegex = /^[A-Za-z0-9]{6,}$/;

function validation() {
    let form = document.getElementById("form");
    let name = form.username;
    let email = form.email;
    let pass = form.password;
    let res = true;

    let errName = document.getElementById("error-name");
    let errEmail = document.getElementById("error-email");
    let errPass = document.getElementById("error-pass");

    // Username
    if (name.value.length < 4 || name.value.length > 12) {
        res = false;
        errName.innerHTML = "Your username must be at least 4 characters long.";
    }
    else if (! (nameRegex.test(name.value))) {
        res = false;
        errName.innerHTML = "Enter a valid Username.";
        console.log("Not a valid username");
    }

    // Email
    if (! (emailRegex.test(email.value))) {
        res = false;
        errEmail.innerHTML = "Enter a valid E-mail.";
        console.log("Not a valid Email");
    }

    // Password
    if (pass.value.length < 6) {
        res = false;
        errPass.innerHTML = "Your Password must be at least 6 characters long.";
    } else if (pass.value.indexOf(name.value) != -1) {
        res = false;
        errPass.innerHTML = "Don't include your name in your password.";
    }

    if (res) {
        alert("Alright!");
    }

    return res;
}