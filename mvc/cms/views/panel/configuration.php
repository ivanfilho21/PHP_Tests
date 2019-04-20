<div class="container form-wrapper">
	<h1>Site Configuration</h1>
	<form method="POST">
		<label>Site Name</label>
		<input type="hidden" name="id" value="<?php echo $sc['id']; ?>">

		<div class="input-group">
			<input type="text" name="title" placeholder="Site Name" value="<?php echo (! empty($sc['title'])) ? $sc['title'] : ''; ?>">
		</div>
		<?php if (! empty($error["title"])) : ?>
			<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["title"]; ?></span>
		<?php endif; ?>

		<label>Template</label>
		<div class="input-group">
			<select name="template">
				<option <?php echo (! empty($sc["template"]) && $sc["template"] == "default") ? "selected" : ""; ?>>Default</option>
				<option <?php echo (! empty($sc["template"]) && $sc["template"] == "blank") ? "selected" : ""; ?>>Blank</option>
			</select>
		</div>

		<input class="btn" type="submit" name="save" value="Save">
	</form>
</div>