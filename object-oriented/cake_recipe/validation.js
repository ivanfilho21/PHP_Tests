function validateFields() {
    let res = true;
    let form = document.getElementById("new-form");

    if (form.name.value == "") {
        res = false;
        document.getElementById("error-name").innerHTML = "Enter the name of the recipe.";
    }

    return res;
}