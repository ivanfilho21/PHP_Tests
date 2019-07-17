function setRecipeName(name) {
	let form = document.getElementById("form");
	form.name.value = name;
}

function addIngredient() {
	let amount = document.getElementById("amount");
	let ing = document.getElementById("ingredient");
	let list = document.getElementById("list");

	let form = document.getElementById("form");
	let txtArea = form.recipe;
	txtArea.innerHTML = "";

	if (ing.value != "" && parseInt(amount.value) > 0) {
		let v = amount.value + " " + ing.value;
		list.innerHTML += "<li>" + v + "</li>";
		txtArea.innerHTML += v + "<br>";
	}

	if (list.childNodes.length > 0) { form.style.display = "block"; }
	else { form.style.display = "none"; }

	resetInputs();
	return false;
}

function resetInputs() {
	let amount = document.getElementById("amount");
	let ing = document.getElementById("ingredient");

	amount.value = 1;
	ing.value = "";
	ing.focus();
}