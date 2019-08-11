function openModal(url) {
    let modalBox = document.getElementById("modal-bg");
    let modal = document.getElementById("modal");
    let callback = function(response) {
        modalBox.style.display = "block";
        modal.innerHTML = response;
    };
    ajax(url, callback);
}

function closeModal() {
    event.preventDefault();
    let modalBox = document.getElementById("modal-bg");
    modalBox.style.display = "none";
}