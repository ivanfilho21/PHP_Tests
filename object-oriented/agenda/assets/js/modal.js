function openModal() {
	var modalBox = document.getElementById("modal-bg");
	var modal = document.getElementById("modal");

	modalBox.style.display = "block";
}

function closeModal() {
	var modalBox = document.getElementById("modal-bg");
	modalBox.style.display = "none";
}

function getContentViaAjax(link) {
	var processResponseFunction = function() {

		if (this.readyState == 4 && this.status == 200) {
			var modal = document.getElementById("modal");
			modal.innerHTML = this.responseText;
		}
	};

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = processResponseFunction;
	xmlhttp.open("GET", link, true);
	xmlhttp.send();
}