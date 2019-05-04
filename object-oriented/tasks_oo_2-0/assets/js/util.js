function updatePreview() {
    let files = this.files;
    let attachments = document.getElementById("attachment");

    if (! files) return;

    for (let i = 0; i < files.length; i++) {
        if (! files[i]) continue;

        let n = files[i].name;
        // console.log("File name: ", n);
        n = n.split(".");
        n = (n.length > 0) ? n[n.length -1] : "";
        // console.log("Extension: ", n);
        
        // Add icon depending on the type, except when it is image
        let src = "";
        if (n == "") {
            src = "../assets/img/no-ext-file.svg";
        } else if (n == "jpeg" || n == "jpg" || n == "png" || n == "gif" || n == "svg" || n == "bmp") {
            src = "";
        } else if (n == "zip" || n == "7zip" || n == "rar" || n == "tar" || n == "tar.xz") {
            src = "../assets/img/zip.svg";
        } else {
            src = "../assets/img/file.svg";
        }

        let obj = new FileReader();
        obj.onload = function(data) {
            // console.log(data.target.result);

            let item = document.createElement("div");
            item.setAttribute("class", "item");
            let image = document.createElement("img");
            image.src = (src == "") ? data.target.result : src;
            item.appendChild(image);
            
            attachments.innerHTML = "";
            attachments.appendChild(item);
        };
        obj.readAsDataURL(files[i]);
    }
}

function goToUrlOnConfirm(msg, url) {
    if (confirm(msg)) window.location.href = url;
}

function deleteTask() {
    if (! this) return false;
    let msg = "Delete \"" + this.getAttribute("data-task-name") + "\"?";
    goToUrlOnConfirm(msg, this.href);
}

function duplicateTask() {
    if (! this) return false;
    let msg = "Duplicate \"" + this.getAttribute("data-task-name") + "\"?";
    goToUrlOnConfirm(msg, this.href);
}

function markCheckedTasksAsFinished() {
    let rows = document.getElementById("tasks-table").tBodies[0].rows;
    let msg = "Mark all tasks as Finished?";
    let url = "scripts/set-finished-all.php?";

    for (var i = 0; i < rows.length; i++) {
        let id = rows[i].getElementsByClassName("td-task-id")[0].value;
        url += "id" + i + "=" + id + "&";
    }
    url = url.substring(0, url.length - 1);
    goToUrlOnConfirm(msg, url);
}

function deleteCheckedTasks() {}

function setCheckedRows(value) {
    let rows = document.getElementById("tasks-table").tBodies[0].rows;

    for (var i = 0; i < rows.length; i++) {
        if (value) rows[i].getElementsByClassName("checkbox")[0].setAttribute("checked", "checked");
        else rows[i].getElementsByClassName("checkbox")[0].removeAttribute("checked");
    }
}

function checkRows() {
    if (! this) return false;
    let v = this.getAttribute("data-value") == "true" ? true : false;
    setCheckedRows(v);

    document.getElementsByClassName("table-options")[0].style.display = v ? "block" : "none"; 
    this.setAttribute("data-value", !v);
}