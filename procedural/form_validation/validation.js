var nameRegex = /^[a-z0-9_-]{4,12}$/;
var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var passRegex = /^[A-Za-z0-9]{6,}$/;

function validation() {
    let form = document.getElementById("form");
    let name = form.username;
    let email = form.email;
    let pass = form.password;
    let res = true;

    // Username
    if (name.value.length < 4 || name.value.length > 12) {
        res = false;
    }
    else if (! (nameRegex.test(name.value))) {
        res = false;
        console.log("Not a valid username");
    }

    // Email
    if (! (emailRegex.test(email.value))) {
        res = false;
        console.log("Not a valid Email");
    }

    // Password
    if (pass.value.length < 6) {
        res = false;
    } else if (pass.value == name.value) {
        res = false;
    } else if (! (passRegex.test(pass.value))) {
        res = false;
        console.log("Not a valid password");
    }

    return res;
}