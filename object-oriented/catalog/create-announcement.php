<?php require "pages/header.php" ?>
<?php $categories = $database->getCategoriesTable(); ?>

<section class="card">
	<h1 class="form-title">New Announcement</h1>
	<form method="POST" enctype="multipart/form-data">
		<label>Category</label>
		<select name="categories">
			<?php foreach ($categories->getAll() as $category) : ?>
				<option><?php echo $category["name"]; ?></option>
			<?php endforeach; ?>
		</select>

		<label>Title</label>
		<input type="text" name="title" placeholder="My Awesome Product">

		<label>Price</label>
		<input type="text" name="price" placeholder="1.00">

		<label>Product Condition</label>
		<select name="condition">
			<option>New</option>
			<option>Used</option>
		</select>
		
		<label>Description</label>
		<textarea name="description" placeholder="Describe your product" rows="6"></textarea>

		<input type="submit" name="create" value="Create Announcement" class="btn btn-default">
	</form>
</section>

<?php require "pages/footer.php" ?>