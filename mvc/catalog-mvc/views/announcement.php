<section class="card">
	<h1 class="form-title">
		<?php echo ($createMode) ? 'New Announcement' : 'Edit Announcement'; ?>
	</h1>

	<?php if ($created) : ?>
		<div class="alert alert-success">
			Your announcement was created successfully.<br><br>
			<a href="<?php echo BASE_URL; ?>announcements">Back to your announcements</a>
		</div>
	<?php else : ?>
		<form method="POST" enctype="multipart/form-data">

			<?php if (count($util->getErrorMessageArray()) > 0) : ?>
				<div class="alert alert-warning">
					<?php foreach ($util->getErrorMessageArray() as $error) : ?>
						<?php echo $error; ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<input type="hidden" name="id" value="<?php echo $id; ?>">
			
			<label>Category</label>
			<select name="categoryId">
				<?php foreach ($categories->getAll() as $category) : ?>
					<option value="<?php echo $category['id']; ?>" <?php echo (isset($categoryId) && $categoryId == $category["id"]) ? "selected" : ""; ?>><?php echo $category["name"]; ?></option>
				<?php endforeach; ?>
			</select>

			<label>Title</label>
			<input type="text" name="title" placeholder="My Awesome Product" value="<?php echo (isset($title)) ? $title : ''; ?>">

			<label>Price</label>
			<input type="text" name="price" placeholder="1.00" value="<?php echo (isset($price)) ? $price : ''; ?>">

			<fieldset>
				<legend>Product Information</legend>

				<div class="panel">
					<h4>Pictures</h4>

					<input type="file" name="pictures[]" multiple>

					<?php if (isset($announcement["pictures"]) && count($announcement["pictures"]) > 0) : ?>
						<?php foreach ($pictures as $picture) : ?>
							<div class="picture-item">
								<img class="thumb" src="<?php echo BASE_URL .ANNOUNCEMENT_PICTURES_DIR .'/' .$picture['url']; ?>" alt="Announcement Picture" border="0">

								<a href="<?php echo BASE_URL; ?>announcements/deletePicture/<?php echo $picture['id']; ?>" class="btn btn-danger">Delete</a>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				
				<label>Product Condition</label>
				<select name="condition">
					<option value="0" <?php echo (isset($condition) && $condition == 0) ? "selected" : ""; ?>>New</option>
					<option value="1" <?php echo (isset($condition) && $condition == 1) ? "selected" : ""; ?>>Used</option>
				</select>
				
				<label>Description</label>
				<textarea name="description" placeholder="Describe your product" rows="6"><?php echo (isset($description)) ? $description : ""; ?></textarea>
			</fieldset>

			<input type="submit" name="<?php echo ($createMode) ? 'create' : 'edit'; ?>" value="<?php echo ($createMode) ? 'Create Announcement' : 'Edit Announcement'; ?>" class="btn btn-success">
		</form>
	<?php endif; ?>

	
</section>