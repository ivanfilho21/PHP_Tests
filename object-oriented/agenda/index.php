<?php require "Contact.php"; $contacts = new Contact(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Agenda - Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <section class="main-wrapper">
        <h1 class="title">My Agenda - Contacts</h1>

        <?php #print_r($contacts->getAll()); ?>

        <a href="create.php">[ CREATE ]</a>
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
                            <a class="option" href="edit.php?id=<?php echo $contact["id"]; ?>">[ EDIT ]</a>
                            <a class="option" href="delete.php?id=<?php echo $contact["id"]; ?>">[ DELETE ]</a>
                        </td>               
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>

    <?php include "footer.html"; ?>
</body>
</html>