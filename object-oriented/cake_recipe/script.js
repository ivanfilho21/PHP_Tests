function addIngredient() {
	var amount = document.getElementById("amount");
	var ing = document.getElementById("ingredient");
	var list = document.getElementById("list");
	var old = list.innerHTML;
	var form = document.getElementById("form");

	if (ing.value != "" && parseInt(amount.value) > 0) {
		list.innerHTML = old + "<li>" + amount.value + " " + ing.value + "</li>";

		var a = document.createElement("input");
		var i = document.createElement("input");
		a.type = "hidden";
		a.value = amount.value;
		a.name = "amount";
		i.type = "hidden";
		i.value = ing.value;
		i.name = "ingredient";

		form.appendChild(a);
		form.appendChild(i);
	}

	if (list.childNodes.length > 0) { form.style.display = "block"; }
	else { form.style.display = "none"; }

	focus(ing);
}

function focus(element) {
	// element.selectionStart = 0;
	// element.selectionEnd = ing.value.length;
	element.value = "";
	element.focus();
}