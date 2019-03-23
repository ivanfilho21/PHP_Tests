<?php ?>
<!DOCTYPE html>
<html>
<head>
    <title>Agenda - Create Contact</title>
</head>
<body>
    <h1>New Contact</h1>

    <form method="post" action="create-submit.php">
        <input type="hidden" name="id" value="">
        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="E-mail">

        <input type="submit" name="create" value="Save">
    </form>
    
    <br><br>
    <a href="index.php">[ GO BACK ]</a>
</body>
</html>