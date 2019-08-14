tinymce.init({
    selector: "#txtarea",
    language: "pt_BR",
    toolbar: "formatselect | bold italic forecolor strikethrough backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment"
});

window.onload = function() {
    initInputs();
}