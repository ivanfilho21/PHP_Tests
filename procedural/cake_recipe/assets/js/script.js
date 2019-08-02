var form = document.getElementById("form");
var newForm = document.getElementById("new-form");

function setRecipeName(name) {
    // let form = document.getElementById("new-form");
    newForm.getElementsByTagName("input")[0].value = name;
}

function getPlural(word) {
    return word.indexOf("y") != -1 ? word.substring(0, word.length - 1) + "ies" : word + "s";
}

function addIngredient() {
    // let form = document.getElementById("form");
    // let newForm = document.getElementById("new-form");
    let list = document.getElementById("ingredient-list");

    let ing = form.ingredient;
    let amount = form.amount;
    let unity = form.unity;
    let txtArea = newForm.recipe;

    if (ing.value != "" && parseInt(amount.value) > 0) {
        let u = unity[unity.selectedIndex].value;
        let aux = amount.value + " ";
        let plural = getPlural(u);
        aux += parseInt(amount.value) > 1 ? plural : u;

        let v = aux;
        v += " of " + (parseInt(amount.value) > 1 ? getPlural(ing.value) : ing.value);

        let tr = document.createElement("tr");
        let tdIng = document.createElement("td");
        let tdBut = document.createElement("td");
        let clearButton = document.createElement("button");

        clearButton.innerHTML = "<img src='assets/img/eraser.svg' alt='Remove'><span>Erase</span>";
        clearButton.setAttribute("class", "remove-ingredient");
        clearButton.addEventListener("click", function() {
            clearIngredient(v);
        });
        tdIng.innerHTML = v;
        tdBut.appendChild(clearButton);

        tr.appendChild(tdIng);
        tr.appendChild(tdBut);
        list.tBodies[0].appendChild(tr);

        txtArea.innerHTML += v + "<br>";
    }

    newForm.style.display = list.childNodes.length > 0 ? "block" : "none";

    amount.value = 1;
    unity.selectedIndex = 0;
    ing.value = "";
    ing.focus();

    return false;
}

function clearIngredient(name) {
    let tr = document.getElementById("ingredient-list").tBodies[0].rows;
    console.log(tr.length);

    // let form = document.getElementById("new-form");
    let ta = newForm.recipe;
    let text = name;
    let regex = new RegExp(text, "gi");

    // Remove name from textarea
    if (ta.innerHTML.match(regex)) {
        ta.innerHTML = ta.innerHTML.replace(regex, "");
    }

    // Remove name from table list
    for (let i = 0; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td")[0];
        let v = td.textContent || td.innerText;

        if (v.toUpperCase() == name.toUpperCase()) {
            tr[i].parentNode.removeChild(tr[i]);
        }
    }
}

// List

var getList = function(response) {
    let list = document.getElementById("recipe-list");
    let data = response != "" ? JSON.parse(response) : [];
    
    console.log("Response from the Server:");
    console.log(data);

    for (let key in data) {
        console.log(key, data[key]);
    }

    for (let i = 0; i < Object.keys(data).length; i++) {
        let id = data[i]["id"];
        let name = data[i]["recipe_name"];
        let url = "view-recipe.html?id=" + id;
        name = name == null ? "Untitled Recipe" : name;

        let rcp = "<span>" + data[i]["recipe"] + "</span>";
        let li = "<li class='recipe col-sm'><a href='" + url + "'>" + name + "<br>" + rcp + "</a></li>";

        list.innerHTML += (i % 2 == 0 ? "<li class='w-100'></li>" : "") + li;
    }
};

// Get
var getRecipe = function(response) {
    let data = response != "" ? JSON.parse(response) : [];
    let name = data["recipe_name"];
    let main = document.getElementById("main");
    name = name == null ? "Untitled Recipe" : name;
    console.log(response);

    let h1 = document.createElement("h1");
    let p = document.createElement("p");

    h1.innerHTML = name;
    p.innerHTML = data["recipe"];

    main.appendChild(h1);
    main.appendChild(p);
};

// Extract GET from URL
function getFromUrl(url) {
    let get = url.substring(url.indexOf("?") + 1);
    get = get.split("&");

    let list = [];
    for (let i = 0; i < get.length; i++) {
        if (get.length > 1 && i == get.length -1) break;
        if (i % 2 == 0) {
            let aux = get[i].split("=");
            list[aux[0]] = aux[1];
        }
    }

    return list;
}

// Validation
function validateFields() {
    let res = true;

    if (newForm.name.value == "") {
        res = false;
        document.getElementById("error-name").innerHTML = "Enter the name of the recipe.";
    }

    return res;
}

// Ajax
function ajax(url, callback, method = "GET", form = "") {
    var processResponseFunction = function() {
        if (this.readyState == 4 && this.status == 200) {
            callback(this.responseText);
        }
    };

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = processResponseFunction;

    if (form != "") {
        let formData = new FormData(form);
        // let formData = JSON.stringify(form).serializeArray();
        // let formData = JSON.stringify(formData).serializeArray();
        
        var object = {};
        
        formData.forEach(function(value, key) {
            object[key] = value;
        });
        var json = JSON.stringify(object);
        // alert(json);

        xmlhttp.open(form.method, form.action, true);
        xmlhttp.send(json);
    } else {
        xmlhttp.open(method, url, true);
        xmlhttp.send();
    }
}