function setRecipeName(name) {
	let form = document.getElementById("form");
	form.name.value = name;
}

function addIngredient() {
	let form = document.getElementById("form");
	let newForm = document.getElementById("new-form");
	let list = document.getElementById("list");

	let ing = form.ingredient;
	let amount = form.amount;
	let unity = form.unity;
	let txtArea = newForm.recipe;

	if (ing.value != "" && parseInt(amount.value) > 0) {
		let u = unity[unity.selectedIndex].value;
		let aux = amount.value + " ";
		let plural = (u.indexOf("y") != -1 ? u.substring(0, u.length-1) + "ies" : u + "s");
		aux += parseInt(amount.value) > 1 ? plural : u;

		let v = aux;
		v += " of " + ing.value;
		list.innerHTML += "<li>" + v + "</li>";
		txtArea.innerHTML += v + "<br>";
	}

	newForm.style.display = list.childNodes.length > 0 ? "block" : "none";

	amount.value = 1;
	unity.selectedIndex = 0;
	ing.value = "";
	ing.focus();

	return false;
}