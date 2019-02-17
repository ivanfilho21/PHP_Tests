<aside class="sidebar">
	<?php
	
	$sidebarTables = array();

	if (isset($_POST["list-tables"]))
	{
		/*
		if (count($tables) > 0)
		{
			foreach ($tables as $t) {
				foreach ($t as $name) {
					$sidebarTables[] = $name;
				}
			}
		}*/
		header("Location:index.php");
	}
	else if (isset($_POST["create-table"]))
		header("Location:create-table.php");
	else if (isset($_POST["delete-table"]))
		header("Location:index.php");
	?>
	<form action="" method="post" class="form-as-ul">
		<input type="submit" name="table-operations" value="Table Operations" class="button-as-li list-section">

		<div>
			<img src="icon/menu.svg" width="18px">
			<input type="submit" name="list-tables" value="List" class="button-as-li">

			<!--
			<ul style="margin: .5em 2.5em;">
				<?php foreach ($sidebarTables as $value) : ?>
					<li><a href="view-table.php?table[<?php echo $value; ?>]"><?php echo $value; ?></a></li>
				<?php endforeach; ?>
			</ul> -->
		</div>
		
		<div>
			<img src="icon/add.svg" width="18px">
			<input type="submit" name="create-table" value="Create" class="button-as-li">
		</div>
		
		<div>
			<img src="icon/garbage.svg" width="18px">
			<input type="submit" name="delete-table" value="Delete" class="button-as-li">
		</div>
		
		<div>
			<img src="icon/edit.svg" width="18px">
			<input type="submit" name="update-table" value="Update" class="button-as-li">	
		</div>
		
		<!--
		<ul>
			<li class="list-section"><a href="">Table Operations</a></li>
			<li id="listTable"><a href="?list_tables"><img width="20" src="icon/menu.svg">List</a></li>
			<li id="createTable"><a href="create-table.php"><img width="20" src="icon/add.svg">Create</a></li>
			<li id="deleteTable"><a href=""><img width="20" src="icon/garbage.svg">Remove</a></li>
			<li id="updateTable"><a href=""><img width="20" src="icon/edit.svg">Update</a></li>
		</ul>
		-->
	</form>
</aside>