function validation() {
    let form = document.getElementById("form");
    let passRegex = /^[A-Za-z0-9]{6,}$/;

    if (! (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form.email.value))) {
        console.log("Not a valid Email");
    }

    if (form.password.value.length < 6) {

    } else if (form.password.value == form.username.value) {

    } else if (! (passRegex.test(form.password.value))) {
        console.log("Not a valid password");
    }
    
    return false;
}