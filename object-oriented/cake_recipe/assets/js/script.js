function setRecipeName(name) {
    let form = document.getElementById("new-form");
    form.name.value = name;
}

function getPlural(word) {
    return word.indexOf("y") != -1 ? word.substring(0, word.length - 1) + "ies" : word + "s";
} 

function addIngredient() {
    let form = document.getElementById("form");
    let newForm = document.getElementById("new-form");
    let list = document.getElementById("igredient-list");
    // let list = document.getElementById("list");

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

        clearButton.innerHTML = "Remove";
        clearButton.addEventListener("click", function() {
            clearIngredient(v);
        });
        tdIng.innerHTML = v;
        tdBut.appendChild(clearButton);

        tr.appendChild(tdIng);
        tr.appendChild(tdBut);
        list.tBodies[0].appendChild(tr);

        // list.innerHTML += "<li>" + v + "</li>";
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
    let tr = document.getElementById("igredient-list").tBodies[0].rows;
    console.log(tr.length);

    // TODO: delete from form (textarea) and from table.
    let form = document.getElementById("new-form");
    let ta = form.recipe;
    let text = name;
    let regex = new RegExp(text, "gi");

    // Remove name from textarea
    if (ta.innerHTML.match(regex)) {
        ta.innerHTML = ta.innerHTML.replace(regex, "");
    }

    // Remove name from table list
    for (var i = 0; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td")[0];
        let v = td.textContent || td.innerText;

        if (v.toUpperCase() == name.toUpperCase()) {
            tr[i].parentNode.removeChild(tr[i]);
        }
    }
}

// List
var getTableList = function updateTableList(response) {
    let table = document.getElementById("recipe-table");
    let data = response != "" ? JSON.parse(response) : [];
    
    console.log("Response from the Server:");
    console.log(data);
    // console.log(data["head"]);

    for (let j = 0; j < data["head"].length; j++) {
        let tr = table.tHead.getElementsByTagName("tr")[0];
        let th = document.createElement("th");
        th.innerHTML = "" + data["head"][j];
        tr.appendChild(th);
    }

    for (let i = 0; i < Object.keys(data).length -1; i++) {
        let tr = document.createElement("tr");

        let id = document.createElement("td");
        let name = document.createElement("td");
        let recipe = document.createElement("td");
        id.innerHTML = data[i]["id"];
        name.innerHTML = data[i]["recipe_name"];
        recipe.innerHTML = data[i]["recipe"];

        console.log(data[i]["id"]);
        console.log(data[i]["recipe_name"]);
        console.log(data[i]["recipe"]);

        tr.append(id);
        tr.append(name);
        tr.append(recipe);

        table.tBodies[0].append(tr);
    }
};

var getList = function(response) {
    let list = document.getElementById("recipe-list");
    let data = response != "" ? JSON.parse(response) : [];
    
    console.log("Response from the Server:");
    console.log(data);

    for (let i = 0; i < Object.keys(data).length -1; i++) {
        let id = data[i]["id"];
        let name = data[i]["recipe_name"];
        let url = "view-recipe.html?id=" + id;
        name = name == null ? "Untitled Recipe" : name;
        list.innerHTML += "<li class='recipe'><a href='" + url + "'>" + name + "</a></li>";
    }
};

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