<?php require "Contact.php"; $contacts = new Contact(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Agenda - Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/table.css">
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
    <section class="main-wrapper">
        <h1 class="title">My Agenda - Contacts</h1>

        <?php #print_r($contacts->getAll()); ?>

        <a class="option modal-option" href="create.php">[ CREATE ]</a>
        <br><br>

        <?php if (count($contacts->getAll()) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($contacts->getAll() as $contact) : ?>
                    <tr>
                        <td class="td-id">
                            <?php echo $contact["id"]; ?>
                        </td>
                        <td>
                            <?php echo $contact["name"]; ?>
                        </td>
                        <td>
                            <?php echo $contact["email"]; ?>
                        </td>

                        <td class="td-action">
                            <a class="option modal-option" href="edit.php?id=<?php echo $contact["id"]; ?>">[ EDIT ]</a>
                            <a class="option" href="delete.php?id=<?php echo $contact["id"]; ?>">[ DELETE ]</a>
                        </td>               
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>

    <div id="modal-bg">
        <a id="close-modal" href="#" onclick="closeModal()">x</a>

        <div id="modal">
            <p style="text-align: center; margin-top: 3em;">Loading...</p>
        </div>
    </div>

    <script>
        var links = document.getElementsByClassName("modal-option");

        var clickLinkFunction = function(event) {
            event.preventDefault(); // default link won't open.
            openModal();
            var link = this.href;
            getContentViaAjax(link);
        };

        for (var i = 0; i < links.length; i++) {
            links[i].addEventListener("click", clickLinkFunction);
        }
    </script>

    <?php include "footer.html"; ?>
</body>
</html>