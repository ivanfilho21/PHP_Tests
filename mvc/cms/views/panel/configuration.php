<div class="container form-wrapper">
	<h1>Site Configuration</h1>
	<form method="POST" enctype="multipart/form-data">
		<label>Site Name</label>
		<input type="hidden" name="id" value="<?php echo $sc['id']; ?>">

		<div class="input-group">
			<input type="text" name="title" placeholder="Site Name" value="<?php echo (! empty($sc['title'])) ? $sc['title'] : ''; ?>">
		</div>
		<?php if (! empty($error["title"])) : ?>
			<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["title"]; ?></span>
		<?php endif; ?>

		<label>Banner Image</label>
		<?php if (! empty($sc["home_banner"])) : ?>
		<div class="gallery card-style">
			<img src="<?php echo BASE_URL; ?>assets/img/banner/<?php echo $sc['home_banner']; ?>">
		</div>
		<?php endif; ?>
		
		<div class="input-group">
			<input type="file" name="banner">
		</div>
		

		<label>Welcome Message</label>
		<div class="input-group">
			<input type="text" name="welcome" placeholder="Welcome Message" value="<?php echo (! empty($sc['home_welcome'])) ? $sc['home_welcome'] : ''; ?>">
		</div>

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

<script>
	document.getElementById("delete-banner").onclick = function() {

	};
</script>