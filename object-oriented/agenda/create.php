<!DOCTYPE html>
<html>
<head>
    <title>Agenda - Create Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/form.css">
</head>
<body>
    <section class="main-wrapper">
        <div class="form-wrapper">
            <h1 class="title">New Contact</h1>

            <form method="post" action="create-submit.php">
                <input type="hidden" name="id" value="">
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="E-mail">

                <input class="save-btn" type="submit" name="create" value="Save">
            </form>
        </div>
        
        <!-- <br><br>
        <a href="index.php">[ GO BACK ]</a> -->
    </section>
</body>
</html>