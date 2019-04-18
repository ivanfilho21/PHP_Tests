<div class="container">
	<nav class="navigation-bar">
		<ul class="breadcrumb">
			<li><a href="<?php echo BASE_URL; ?>panel/pages">Pages</a></li>
			<li><a class="active" href="<?php echo BASE_URL; ?>panel/create/pages">Create Page</a></li>
		</ul>
	</nav>
</div>
<div class="container form-wrapper">
	<style>
		.breadcrumb { list-style: none; margin: 1em 0; }
		.breadcrumb .active { pointer-events: none; color: black; }
		.breadcrumb li { display: inline-block; }
		.breadcrumb li+li:before {
		  padding: 8px;
		  color: black;
		  content: "/\00a0";
		}
	</style>

	<h1><?php echo $this->title; ?></h1>

	<form method="POST">
		<input type="hidden" name="id" value="<?php echo(! empty($page['id'])) ? $page['id'] : ''; ?>">
		
		<label>Title</label>
		<div class="input-group">
			<input autofocus type="text" name="title" placeholder="Title" value="<?php echo(! empty($page['title'])) ? $page['title'] : ''; ?>">
		</div>
		<?php if (! empty($error["title"])) : ?>
			<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["title"]; ?></span>
		<?php endif; ?>

		<label>Url</label>
		<div class="input-group">
			<input type="text" readonly placeholder="<?php echo BASE_URL; ?>">
			<input type="text" name="url" placeholder="Url" value="<?php echo(! empty($page['url'])) ? $page['url'] : ''; ?>">
		</div>

		<?php if (! empty($error["url"])) : ?>
			<span class="error"><i class="fas fa-exclamation-circle"></i><?php echo $error["url"]; ?></span>
		<?php endif; ?>

		<label>Content</label>
		<textarea class="ckeditor" name="body" id="page-body">
			<?php echo (! empty($page["body"])) ? $page["body"] : ""; ?>
		</textarea>
		
		<input class="btn" type="submit" name="<?php echo(isset($page)) ? 'edit' : 'create';?>" value="<?php echo(isset($page)) ? 'Edit Page' : 'Create Page';?>">
	</form>
</div>
<script src="<?php echo BASE_URL; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo BASE_URL; ?>ckeditor/sample/js/sample.js"></script>