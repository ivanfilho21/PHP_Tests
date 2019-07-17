function setRecipeName(name) {
	let form = document.getElementById("form");
	form.name.value = name;
}

function getPlural(word) {
	return word.indexOf("y") != -1 ? word.substring(0, word.length - 1) + "ies" : word + "s";
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
		let plural = getPlural(u);
		aux += parseInt(amount.value) > 1 ? plural : u;

		let v = aux;
		v += " of " + (parseInt(amount.value) > 1 ? getPlural(ing.value) : ing.value);
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