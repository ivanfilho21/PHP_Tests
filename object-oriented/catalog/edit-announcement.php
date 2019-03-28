<?php require "pages/header.php"; ?>
<?php require "edit-announcement-submit.php"; ?>

<section class="card">
	<h1 class="form-title">Edit Announcement</h1>

	<form method="POST" enctype="multipart/form-data">
		<?php if (count($util->getErrorMessageArray()) > 0) : ?>
			<div class="alert alert-warning">
				<?php foreach ($util->getErrorMessageArray() as $error) : ?>
					<?php echo $error; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		
		<label>Category</label>
		<select name="category">
			<?php foreach ($categories->getAll() as $category) : ?>
				<option value="<?php echo $category['id']; ?>" <?php echo (isset($categoryId) && $categoryId == $category["id"]) ? "selected" : ""; ?>><?php echo $category["name"]; ?></option>
			<?php endforeach; ?>
		</select>

		<label>Title</label>
		<input type="text" name="title" placeholder="My Awesome Product" value="<?php echo (isset($title)) ? $title : ''; ?>">

		<label>Price</label>
		<input type="text" name="price" placeholder="1.00" value="<?php echo (isset($price)) ? $price : ''; ?>">

		<label>Product Condition</label>
		<select name="condition">
			<option value="0" <?php echo (isset($condition) && $condition == 0) ? "selected" : ""; ?>>New</option>
			<option value="1" <?php echo (isset($condition) && $condition == 1) ? "selected" : ""; ?>>Used</option>
		</select>
		
		<label>Description</label>
		<textarea name="description" placeholder="Describe your product" rows="6"><?php echo (isset($description)) ? $description : ""; ?></textarea>

		<input type="submit" name="create" value="Save" class="btn btn-default">
	</form>
</section>


<?php require "pages/footer.php"; ?>