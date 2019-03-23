<?php require "Contact.php"; $contacts = new Contact(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Agenda - Home Page</title>
</head>
<body>
	<h1>My Agenda - Contacts</h1>

	<?php #print_r($contacts->getAll()); ?>

	<a href="create.php">[ CREATE ]</a>
	<br><br>

	<?php if (count($contacts->getAll()) > 0) : ?>
    	<table border="1">
    		<tr>
    			<th>ID</th>
    			<th>Name</th>
    			<th>E-mail</th>
    			<th>Action</th>
    		</tr>

    		<?php foreach($contacts->getAll() as $contact) : ?>
    			<tr>
    				<td>
    					<?php echo $contact["id"]; ?>
    				</td>
    				<td>
    					<?php echo $contact["name"]; ?>
    				</td>
    				<td>
    					<?php echo $contact["email"]; ?>
    				</td>

    				<td>
    					<a href="update.php?email=<?php echo $contact["email"]; ?>">[ EDIT ]</a>
    					<a href="delete.php?email=<?php echo $contact["email"]; ?>">[ DELETE ]</a>
    				</td>    			
    			</tr>
    		<?php endforeach; ?>
    	</table>
	<?php endif; ?>
</body>
</html>