<div class="container">
	<!-- <?php #$this->loadCrudTable("Pages", "pages", $pages, $columns); ?> -->
	<h1>Your Pages</h1>

	<div class="preview-pages">
		<a class="page-preview" href="<?php echo BASE_URL; ?>panel/create/pages" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1em;"><i class="fas fa-plus" style="font-size: 1.5em;"></i></a>
	<?php if ($pages !== false) : ?>
	<?php foreach ($pages as $p) : ?>
		<div class="page-preview">
			<a class="content" href="<?php echo BASE_URL .$p['url']; ?>" target="_blank">
				<div>
					<h1 class="page-title"><?php echo $p["title"]; ?></h1>
					<span class="page-body" style="display: none;">
						<?php echo htmlspecialchars_decode($p["body"]); ?>
					</span>
				</div>
			</a>
			<div class="options">
				<a class="btn" href="<?php echo BASE_URL; ?>panel/edit/pages/<?php echo $p['id']; ?>"><i class="fas fa-pen"></i></a>
				<a class="btn" href="<?php echo BASE_URL; ?>panel/delete/pages/<?php echo $p['id']; ?>"><i class="fas fa-trash"></i></a>
			</div>
		</div>
		
	<?php endforeach; ?>
	<?php endif; ?>
	</div>
</div>