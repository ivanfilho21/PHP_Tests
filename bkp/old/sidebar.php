<h4>User: <?php echo $user["username"]; ?></h4>
<ul class="optionsList">
	<li><a href="">Table Operations</a></li>
	<ul>
		<li id="listTable"><a href="?list_tables"><img width="20" src="icon/menu.svg">List</a></li>
		<li id="createTable"><a href="create.php"><img width="20" src="icon/add.svg">Create</a></li>
		<li id="deleteTable"><a href=""><img width="20" src="icon/garbage.svg">Remove</a></li>
		<li id="updateTable"><a href=""><img width="20" src="icon/edit.svg">Update</a></li>
	</ul>
	<li><a href="">My Profile</a></li>
	<li><a href="?list_me">Sign out</a></li>
</ul>