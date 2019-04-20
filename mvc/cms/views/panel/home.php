<div class="container form-wrapper">
	<h1><?php echo $this->title; ?></h1>

	<form method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo(! empty($home['id'])) ? $home['id'] : ''; ?>">
		
		<label>Title</label>
		<div class="input-group">
			<input autofocus type="text" name="title" placeholder="Title" value="<?php echo(! empty($home['title'])) ? $home['title'] : ''; ?>">
		</div>
		<?php if (! empty($error["title"])) : ?>
			<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["title"]; ?></span>
		<?php endif; ?>

		<label>Banner Image</label>
		<?php if (! empty($home["banner"])) : ?>
		<div class="gallery card-style">
			<img src="<?php echo BASE_URL; ?>assets/img/banner/<?php echo $home['banner']; ?>">
		</div>
		<?php endif; ?>
		
		<div class="input-group">
			<input type="file" name="banner">
		</div>

		<label>Welcome Message</label>
		<div class="input-group">
			<input type="text" name="welcome" placeholder="Welcome Message" value="<?php echo (! empty($home['welcome'])) ? $home['welcome'] : ''; ?>">
		</div>

		<label>Content</label>
		<textarea class="ckeditor" name="body" id="page-body">
			<?php echo (! empty($home["body"])) ? $home["body"] : ""; ?>
		</textarea>
		
		<input class="btn" type="submit" name="edit" value="Edit Home">
	</form>
</div>
<script src="<?php echo BASE_URL; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo BASE_URL; ?>ckeditor/sample/js/sample.js"></script>