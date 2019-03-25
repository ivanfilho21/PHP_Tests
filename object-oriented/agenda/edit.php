<?php require "Contact.php"; ?>
<?php $contacts = new Contact(); ?>
<?php $contact = array(); ?>
<?php require "edit-script.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Agenda - Edit Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/form.css">
</head>
<body>
    <section class="main-wrapper">
        <div class="form-wrapper">
            <h1 class="title">Edit Contact</h1>

            <form method="post" action="edit-submit.php">
                <input type="hidden" name="id" value="<?php echo (isset($contact['id'])) ? $contact['id'] : ''; ?>">
                <input type="text" name="name" placeholder="Name" value="<?php echo (isset($contact['name'])) ? $contact['name'] : ''; ?>">
                <input type="email" name="email" placeholder="E-mail" value="<?php echo (isset($contact['email'])) ? $contact['email'] : ''; ?>">

                <input class="save-btn" type="submit" name="create" value="Edit">
            </form>
        </div>

        <!-- <br><br>
        <a href="index.php">[ GO BACK ]</a> -->
    </section>
</body>
</html>