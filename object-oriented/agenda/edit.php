<?php require "Contact.php"; ?>
<?php $contacts = new Contact(); ?>
<?php $contact = array(); ?>
<?php require "edit-script.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Agenda - Create Contact</title>
</head>
<body>
    <h1>New Contact</h1>

    <form method="post" action="edit-submit.php">
        <input type="hidden" name="id" value="<?php echo (isset($contact['id'])) ? $contact['id'] : ''; ?>">
        <input type="text" name="name" placeholder="Name" value="<?php echo (isset($contact['name'])) ? $contact['name'] : ''; ?>">
        <input type="email" name="email" placeholder="E-mail" value="<?php echo (isset($contact['email'])) ? $contact['email'] : ''; ?>">

        <input type="submit" name="create" value="Edit">
    </form>
    
    <br><br>
    <a href="index.php">[ GO BACK ]</a>
</body>
</html>