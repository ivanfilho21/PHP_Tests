<div class="form-wrapper">
	<h1><?php echo $this->title; ?></h1>

	<form method="POST">
		<input type="hidden" name="id" value="<?php echo(! empty($page['id'])) ? $page['id'] : ''; ?>">
		<div class="input-group">
			<input type="text" name="title" placeholder="Title" value="<?php echo(! empty($page['title'])) ? $page['title'] : ''; ?>">
		</div>
		<?php if (! empty($error["title"])) : ?>
			<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["title"]; ?></span>
		<?php endif; ?>

		<div class="input-group">
			<input type="text" name="url" placeholder="Url" value="<?php echo(! empty($page['url'])) ? $page['url'] : ''; ?>">
		</div>
		<?php if (! empty($error["url"])) : ?>
			<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["url"]; ?></span>
		<?php endif; ?>

		<input class="btn" type="submit" name="<?php echo(isset($page)) ? 'edit' : 'create';?>" value="<?php echo(isset($page)) ? 'Edit' : 'Create';?>">
	</form>
</div>