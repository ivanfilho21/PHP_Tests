<div class="form-wrapper">
	<h1><?php echo $this->title; ?></h1>

	<form method="POST">
		<input type="hidden" name="id" value="<?php echo(! empty($menu['id'])) ? $menu['id'] : ''; ?>">
		<div class="input-group">
			<input type="text" name="name" placeholder="Name" value="<?php echo(! empty($menu['name'])) ? $menu['name'] : ''; ?>">
		</div>
		<?php if (! empty($error["name"])) : ?>
			<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["name"]; ?></span>
		<?php endif; ?>

		<div class="input-group">
			<input type="text" name="url" placeholder="Url" value="<?php echo(! empty($menu['url'])) ? $menu['url'] : ''; ?>">
		</div>
		<?php if (! empty($error["url"])) : ?>
			<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["url"]; ?></span>
		<?php endif; ?>

		<input class="btn" type="submit" name="<?php echo(isset($menu)) ? 'edit' : 'create';?>" value="<?php echo(isset($menu)) ? 'Edit' : 'Create';?>">
	</form>
</div>